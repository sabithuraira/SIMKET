<?php

class PertanyaanController extends Controller
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
				'actions'=>array('index','view'),
				'expression'=> function($user){
					return $user->getLevel()<=1;
				},
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'expression'=> function($user){
					return $user->getLevel()<=1;
				},
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
				'expression'=> function($user){
					return $user->getLevel()<=1;
				},
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

	public function actionCreate()
	{
		$model=new MitraPertanyaan;

		if(isset($_POST['MitraPertanyaan']))
		{
			$model->attributes=$_POST['MitraPertanyaan'];
			$model->description = $_POST['MitraPertanyaan']['description'];
			if($model->save()){
				for($i=1;$i<=4;++$i){
					$option= new MitraOption;
					$option->id_pertanyaan 	= $model->id;
					$option->description 	= $_POST['MitraPertanyaan']['option'.$i];
					$option->skala 			= $i;
					$option->save();
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
		for($i=1;$i<=4;++$i){
			$opt = MitraOption::model()->findByAttributes(
				array(
					'id_pertanyaan'=>$model->id, 
					'skala'=>$i)
			);

			if($opt!=null)
				$model['option'.$i] = $opt->description;
			else
				$model['option'.$i] = '';
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['MitraPertanyaan']))
		{
			$model->attributes=$_POST['MitraPertanyaan'];
			$model->description = $_POST['MitraPertanyaan']['description'];
			if($model->save()){
				for($i=1;$i<=4;++$i){
					$opt = MitraOption::model()->findByAttributes(
						array(
							'id_pertanyaan'=>$model->id, 
							'skala'=>$i)
					);

					if($opt==null){
						$option= new MitraOption;
						$option->id_pertanyaan 	= $model->id;
						$option->description 	= $_POST['MitraPertanyaan']['option'.$i];
						$option->skala 			= $i;
						$option->save();
					}
					else{
						$option = MitraOption::model()->findByAttributes(
							array(
								'id_pertanyaan'=>$model->id, 
								'skala'=>$i)
						);
						$option->description 	= $_POST['MitraPertanyaan']['option'.$i];
						$option->save(false);	
					}
				}

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
		$model=new MitraPertanyaan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MitraPertanyaan']))
			$model->attributes=$_GET['MitraPertanyaan'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return MitraPertanyaan the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=MitraPertanyaan::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param MitraPertanyaan $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='mitra-pertanyaan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
