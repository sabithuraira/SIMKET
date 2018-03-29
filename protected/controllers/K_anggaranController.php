<?php

class K_anggaranController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index','create', 'update',
					'progress', 'insert_target', 'insert_realisasi'
					,'detail_kab_kota', 'dashboard'),
				'expression'=> function($user){
					return $user->getLevel()<=2;
				},
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
				'expression'=> function($user){
					return $user->getLevel()==1;
				},
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	// public function actionView($id)
	// {
	// 	$this->render('view',array(
	// 		'model'=>$this->loadModel($id),
	// 	));
	// }

	public function actionDetail_kab_kota($id, $kab_id)
	{
		$model = KegiatanForAnggaran::model()->findByPk($id);
		$data = $model->getByKabKota($kab_id);
		
		echo CJSON::encode(array
     	(
        	 'satu' => $data
        ));
        Yii::app()->end();
	}

	public function actionInsert_target($id)
	{
		$satu='';

		if(isset($_POST['unitkerja']) && strlen($_POST['unitkerja'])>0){
			for($i=1;$i<5;++$i){
				$model = ValueAnggaranTargetBos::model()->findByAttributes(array(
					'unit_kerja' 	=>$_POST['unitkerja'],
					'kegiatan'		=>$id,
					'jenis'			=>$i
				));

				if($model===null){
					$model=new ValueAnggaranTargetBos;
					$model->kegiatan=$id;
					$model->unit_kerja = $_POST['unitkerja'];
					$model->jenis = $i;
					$model->jumlah = $_POST['target'.$i];

					$model->save();
				}
				else{
					$model->jumlah = $_POST['target'.$i];
					$model->save();
				}
			}
			$satu = $id;
		}
		
		echo CJSON::encode(array
     	(
        	 'satu'=>$satu,
        ));
        Yii::app()->end();
	}

	public function actionInsert_realisasi($id)
	{
		$satu='';

		if(strlen($_POST['unitkerja']) > 0 && strlen($_POST['rincian']) > 0){
			$model=new ValueAnggaranBos;
			if(strlen($_POST['vid'])>0)
				$model=ValueAnggaranBos::model()->findByPk($_POST['vid']);
	
			$model->kegiatan=$id;
			$model->unit_kerja = $_POST['unitkerja'];
			$model->jenis = $_POST['rincian'];
			$model->tanggal_realisasi = $_POST['tanggal'];
			$model->jumlah = $_POST['jumlah'];
			$model->keterangan = $_POST['keterangan'];
			
			if($model->save()){
				$satu = $id;
			}
		}
		
		echo CJSON::encode(array
     	(
        	 'satu'=>$satu,
        ));
        Yii::app()->end();
	}

	public function actionProgress($id)
	{
		$this->render('progress',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new KegiatanForAnggaran;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['KegiatanForAnggaran']))
		{
			$model->attributes=$_POST['KegiatanForAnggaran'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['KegiatanForAnggaran']))
		{
			$model->attributes=$_POST['KegiatanForAnggaran'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new KegiatanForAnggaran('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['KegiatanForAnggaran']))
			$model->attributes=$_GET['KegiatanForAnggaran'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


	public function actionDashboard()
	{
		$model=new KegiatanForAnggaran('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['KegiatanForAnggaran']))
			$model->attributes=$_GET['KegiatanForAnggaran'];

		$this->render('dashboard',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return KegiatanForAnggaran the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=KegiatanForAnggaran::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param KegiatanForAnggaran $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='kegiatan-for-anggaran-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
