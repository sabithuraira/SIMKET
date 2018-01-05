<?php

Yii::import("application.vendor.mpdf.*");
require_once("mpdf.php");
class KegiatanController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','insert_progress',
						'insert_pengiriman','activecalendar'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('progress'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','pdfinfo','delete','admin'),
				// 'users'=>array('@'),
				'expression'=>'$user->isKabupaten()==0',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionPdfinfo($id)
	{
 		$model=Kegiatan::model()->findByPk($id);
        
        $mpdf=new mPDF();
        $html= $this->renderPartial('pdf_info',array(
            'model'     =>$model
            ), true,true);

        $mpdf->WriteHTML($html);
        $mpdf->Output('report_'.$id.'.pdf','D');
	}


    public function actionActivecalendar()
    {
        $result=array();
        $activedata=Kegiatan::model()->getAll();
        foreach ($activedata->data as $key => $value) 
        {
            $event_array = array();
            $event_array['id'] = $value->id;
            $event_array['title'] = $value->kegiatan;
            $event_array['start'] = $value->start_date;
            $event_array['end'] = $value->end_date;
            $event_array['url'] = Yii::app()->createUrl('kegiatan/progress',array('id'=>$value->id));
            $result[]=$event_array;
        }

      

        echo json_encode($result);
    }

	public function actionInsert_progress()
	{
		$satu='';
		
		$model=new ValueKegiatan;
		
		if(strlen($_POST['vid'])>0)
			$model=ValueKegiatan::model()->findByPk($_POST['vid']);

		$model->kegiatan=$_POST['idnya'];
		$model->unit_kerja = $_POST['unitkerja'];
		$model->tanggal_pengumpulan = $_POST['tanggal'];
		$model->jumlah = $_POST['jumlah'];
		$model->jenis=1;
		
		if($model->save())
		{
        	$satu=$this->createUrl('progress',array('id'=>$model->kegiatan));
		}

		
		echo CJSON::encode(array
     	(
        	 'satu'=>$satu,
        ));
        Yii::app()->end();
	}

	public function actionInsert_pengiriman()
	{
		$satu='';
		
		$model=new ValueKegiatan;
		if(strlen($_POST['vid'])>0)
			$model=ValueKegiatan::model()->findByPk($_POST['vid']);

		$model->kegiatan=$_POST['idnya'];
		$model->unit_kerja = $_POST['unitkerja'];
		$model->tanggal_pengumpulan = $_POST['tanggal'];
		$model->jumlah = $_POST['jumlah'];
		$model->ketarangan = $_POST['via'];
		$model->jenis=2;
		
		if($model->save())
		{
        	$satu=$this->createUrl('progress',array('id'=>$model->kegiatan));
		}

		
		echo CJSON::encode(array
     	(
        	 'satu'=>$satu,
        ));
        Yii::app()->end();
		/*
		$satu='';
		
		$model=new ValueKegiatan;
		$model->unit_kerja = $_POST['unitkerja'];
		$model->kegiatan = $_POST['idnya'];
		$model->tanggal_pengumpulan = $_POST['tanggal'];
		$model->jumlah = $_POST['jumlah'];
		$model->ketarangan = $_POST['via'];
		$model->jenis=2;
		
		if($model->save())
		{
        	$satu=$this->createUrl('site/kabupaten',array('id'=>$model->unit_kerja));
		}
		
		
		echo CJSON::encode(array
     	(
        	 'satu'=>$satu,
        ));
        Yii::app()->end();
        */
	}

	public function actionProgress($id)
	{
		$this->layout='//layouts/column1';
		$this->render('progress',array(
			'model'=>$this->loadModel($id),
		));	
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Kegiatan;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Kegiatan']))
		{
			$model->attributes=$_POST['Kegiatan'];
			if($model->save())
			{
				foreach (UnitKerja::model()->findAllByAttributes(array('jenis'=>'2')) as $key => $value)
				{
					if(isset($_POST['target_'.$value['id']]) && strlen($_POST['target_'.$value['id']])>0)
					{
						$participant=new Participant;
						$participant->kegiatan=$model->primaryKey;
						$participant->unitkerja=$value['id'];
						$participant->target=$_POST['target_'.$value['id']];
						$participant->target_anggaran=$_POST['anggaran_'.$value['id']];
						$participant->save();
					}
				}

				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Kegiatan']))
		{
			$model->attributes=$_POST['Kegiatan'];
			
			foreach (UnitKerja::model()->findAllByAttributes(array('jenis'=>'2')) as $key => $value)
			{
				if(isset($_POST['target_'.$value['id']]))
				{
					$modelpart=Participant::model()->findByAttributes(array(
						'kegiatan'		=>$id,
						'unitkerja'		=>$value['id']
					));

					if($modelpart==null)
						$modelpart=new Participant;

					$modelpart->kegiatan 	=$id;
					$modelpart->unitkerja 	=$value['id'];
					$modelpart->target 		=$_POST['target_'.$value['id']];
					$modelpart->save();
				}
			}
			if($model->save())
			{
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model=$this->loadModel($id);

		if(HelpMe::isAuthorizeUnitKerja($model->unit_kerja))
		{	
			$model->delete();
			$this->redirect(array('index'));
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			//if(!isset($_GET['ajax']))
			//	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
		{
			$this->redirect(array('index'));
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Kegiatan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Kegiatan']))
			$model->attributes=$_GET['Kegiatan'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Kegiatan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Kegiatan']))
			$model->attributes=$_GET['Kegiatan'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Kegiatan the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Kegiatan::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Kegiatan $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='kegiatan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
