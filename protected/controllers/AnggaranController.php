<?php

class AnggaranController extends Controller
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
				'actions'=>array('index','view','satker'),
				'expression'=>'$user->getUnitKerja()==1',
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','import','selecttab',
					'importkab','selectkab','kab'),
				'expression'=>'$user->getUnitKerja()==1',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','fromto','validatefrom'),
				'expression'=>'$user->getUnitKerja()==1',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionValidatefrom()
	{
	    $satu='';
	    if(isset($_POST['idnya']))
	    {
	       $datanya=MOutput::model()->ValidateFrom($_POST['idnya']);
	       $list=CHtml::listData($datanya,'id','label');

	       foreach($list as $value=>$name)
	       {
	          $satu.=CHtml::tag('option',array('value'=>$value),CHtml::encode($name),true);
	       }
	    }

	    echo CJSON::encode(array
	    (
	       'satu'=>$satu,
	    ));
	    Yii::app()->end();
	 }

	public function actionFromto()
	{
	    $satu='';
	    if(isset($_POST['idnya']))
	    {
	       $datanya=MOutput::model()->OutputByUK($_POST['idnya']);
	       $list=CHtml::listData($datanya,'id','label');

	       	$satu.=CHtml::tag('option',array('value'=>null),CHtml::encode("- Pilih -"),true);
	       	foreach($list as $value=>$name)
	       	{
	          	$satu.=CHtml::tag('option',array('value'=>$value),CHtml::encode($name),true);
	       	}
	    }

	    echo CJSON::encode(array
	    (
	       'satu'=>$satu,
	    ));
	    Yii::app()->end();
	 }

	public function actionKab($id)
	{
		$tahun=date('Y');

        if(isset($_POST['tahun']))
            $tahun=$_POST['tahun'];
        
		$this->render('kab',array(
			'id'=>$id,
			'tahun'	=>$tahun,
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


	public function actionImport($id)
	{
		$model=new FileForm;

		if(isset($_POST['FileForm']))
		{
			$model->attributes=$_POST['FileForm'];
			
			if($_FILES)
			{
				$cUploadedFile=CUploadedFile::getInstance($model,'filename');
				if($cUploadedFile)
				{
					$naname=sha1(uniqid(mt_rand(), true));
					$fileName=$naname.'.'.$cUploadedFile->extensionName;
					if($cUploadedFile->saveAs(Yii::app()->basePath.'/../upload/temp/' . $fileName))
					{
						$this->redirect(array('selecttab','name'=>$naname,'id'=>$id));	
					}
				}
			}
			
		}

		$this->render('import',array(
			'model'=>$model,
			'id'=>$id,
		));
	}

	public function actionSelecttab($name,$id)
    {
        $model=new FileForm;
        if(isset($_POST['listname']))
        {
        	if($id==1)
            	$model->importPagu2($name,$_POST['listname']);
            else if($id==2)
            	$model->importPaguSatker($name,$_POST['listname']);
        }

        $this->render('select',array(
            'naname'=>$name,
            'model' =>$model,
        ));
    }


	public function actionImportkab()
	{
		$model=new FileForm;

		if(isset($_POST['FileForm']))
		{
			$model->attributes=$_POST['FileForm'];
			
			if($_FILES)
			{
				$cUploadedFile=CUploadedFile::getInstance($model,'filename');
				if($cUploadedFile)
				{
					$naname=sha1(uniqid(mt_rand(), true));
					$fileName=$naname.'.'.$cUploadedFile->extensionName;
					if($cUploadedFile->saveAs(Yii::app()->basePath.'/../upload/temp/' . $fileName))
					{
						$this->redirect(array('selectkab','name'=>$naname));	
					}
				}
			}
			
		}

		$this->render('import',array(
			'model'=>$model,
			'id'=>0,
		));
	}

	public function actionSelectkab($name)
    {
        $model=new FileForm;
        if(isset($_POST['listname'],$_POST['kabnya']))
        {
            $model->importKab($name,$_POST['listname'],$_POST['kabnya']);
        }

        $this->render('selectkab',array(
            'naname'=>$name,
            'model' =>$model,
        ));
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Anggaran;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Anggaran']))
		{
			$model->attributes=$_POST['Anggaran'];
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

		if(isset($_POST['Anggaran']))
		{
			$model->attributes=$_POST['Anggaran'];
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
		$tahun=date('Y');

        if(isset($_POST['tahun']))
            $tahun=$_POST['tahun'];

		$model=new Pagu;
		$this->render('index',array(
			'model'		=>$model,
			'tahun'		=>$tahun,
		));
	}

	public function actionSatker()
	{
		$tahun=date('Y');

        if(isset($_POST['tahun']))
            $tahun=$_POST['tahun'];

		$model=new Pagu;
		$this->render('satker',array(
			'model'		=>$model,
			'tahun'		=>$tahun,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Anggaran('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Anggaran']))
			$model->attributes=$_GET['Anggaran'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Anggaran the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Anggaran::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Anggaran $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='anggaran-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
