<?php

class PsatkerController extends Controller
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
				'actions'=>array('index','view','edit'),
				'expression'=>'$user->getUnitKerja()==1',
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'expression'=>'$user->getUnitKerja()==1',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'expression'=>'$user->getUnitKerja()==1',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
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
		$model=new PaguSatker;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PaguSatker']))
		{
			$model->attributes=$_POST['PaguSatker'];
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

		if(isset($_POST['PaguSatker']))
		{
			$model->attributes=$_POST['PaguSatker'];
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
	public function actionIndex($id=6)
	{
		/*
		$model=new PaguSatker('search');
		$model->unsetAttributes();  // clear any default values
		if
		$this->render('admin',array(
			'model'=>$model,
		));
		*/
		$tahun=date('Y');

		$model=new PaguSatker;

		if(isset($_GET['id']))
			$id=$_GET['id'];
		
		if(isset($_GET['tahun']))
			$tahun=$_GET['tahun'];

		$this->render('index',array(
			'model'=>$model,
			'id'	=>$id,
			'tahun'	=>$tahun,
		));
	}

	public function actionEdit($id=6)
	{
		$tahun=date('Y');
		$model=new PaguSatker;

		if(isset($_GET['id']))
			$id=$_GET['id'];
		
		if(isset($_GET['tahun']))
			$tahun=$_GET['tahun'];

		if(isset($_POST)){
			foreach ($model->report_me($id,$tahun) as $key=>$value) {
				for($i=1;$i<=12;++$i){
					/*
					$bulan="Jan";
					if($i==2) $bulan="Feb";
					else if($i==3) $bulan="Mar";
					else if($i==4) $bulan="Apr";
					else if($i==5) $bulan="May";
					else if($i==6) $bulan="Jun";
					else if($i==7) $bulan="Jul";
					else if($i==8) $bulan="Aug";
					else if($i==9) $bulan="Sep";
					else if($i==10) $bulan="Oct";
					else if($i==11) $bulan="Nov";
					else if($i==12) $bulan="Dec";
					*/
	        		if(isset($_POST[$id.'-'.$value['m_induk'].'-'.$i.'-'.$tahun]) && isset($_POST['r-'.$id.'-'.$value['m_induk'].'-'.$i.'-'.$tahun])){
	        			
	        			$rencana=$_POST[$id.'-'.$value['m_induk'].'-'.$i.'-'.$tahun];
	        			$realisasi=$_POST['r-'.$id.'-'.$value['m_induk'].'-'.$i.'-'.$tahun];
	        			$model->update_me($id,$value['m_induk'],$i,$tahun,$rencana,$realisasi);
	        		}

        		}
        	}
		}

		$this->render('edit',array(
			'model'=>$model,
			'id'	=>$id,
			'tahun'	=>$tahun,
		));
	}


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PaguSatker('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PaguSatker']))
			$model->attributes=$_GET['PaguSatker'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PaguSatker the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PaguSatker::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PaguSatker $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pagu-satker-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
