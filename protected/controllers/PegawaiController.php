<?php

class PegawaiController extends Controller
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
				'actions'=>array('view', 'index'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete',
					'rapor', 'detail'),
				'expression'=> function($user){
					return $user->getLevel()<=2;
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

	public function actionDetail($id)
	{
		$this->render('detail',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Pegawai;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pegawai']))
		{
			$model->attributes=$_POST['Pegawai'];
			if(Yii::app()->user->getLevel()==2){
				$model->unit_kerja = Yii::app()->user->getUnitKerja();	
			}

			$model->unit_kerja_kab=$_POST['Pegawai']['unit_kerja_kab'];

			$temp_file;
			$ext_name = array('', '');

			if(strlen(trim(CUploadedFile::getInstance($model,'foto'))) > 0)
			{
				$temp_file = CUploadedFile::getInstance($model,'foto');
				$ext_name = explode('.',basename($temp_file));
			}
			else{
				$model->foto = '';
			}

			if($model->save()){
				if(strlen($ext_name[1]) > 0)
				{
					$fname = $model->nip.'.'.$ext_name[1];
					if($temp_file->saveAs(Yii::app()->basePath.'/../upload/temp/pegawai/' . $fname)){
						$model->foto = $fname;
						$model->save(false);
					}
				}
				$this->redirect(array('view','id'=>$model->nip));
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

		if(isset($_POST['Pegawai']))
		{
			$old_foto = $model->foto;
			$model->attributes=$_POST['Pegawai'];
			if(Yii::app()->user->getLevel()==2){
				$model->unit_kerja = Yii::app()->user->getUnitKerja();	
			}
			$model->unit_kerja_kab = $_POST['Pegawai']['unit_kerja_kab'];

			$temp_file;
			$ext_name = array('', '');

			if(strlen(trim(CUploadedFile::getInstance($model,'foto'))) > 0)
			{
				$temp_file = CUploadedFile::getInstance($model,'foto');
				$ext_name = explode('.',basename($temp_file));
			}

			if($model->save()){
				if(strlen($ext_name[1]) > 0)
				{
					$fname = $model->nip.'.'.$ext_name[1];
					if($temp_file->saveAs(Yii::app()->basePath.'/../upload/temp/pegawai/' . $fname)){
						$model->foto = $fname;
						$model->save(false);
					}
				}
				else{
					$model->foto = $old_foto;
					$model->save(false);
				}

				$this->redirect(array('view','id'=>$model->nip));
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
		$model = $this->loadModel($id);

		if($model->is_active==1)
			$model->is_active = 0;
		else
			$model->is_active = 1;
			
		$model->save(false);

		echo CJSON::encode(array
		(
				'satu'=>'',
		));
		Yii::app()->end();
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Pegawai('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pegawai']))
			$model->attributes=$_GET['Pegawai'];

		// $model->unit_kerja = 22;
		// $model->is_active = 1;

		if(Yii::app()->user->isKabupaten()==1){
			$model->unit_kerja = Yii::app()->user->unitKerja;
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionRapor()
	{
		$model=new Pegawai('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pegawai']))
			$model->attributes=$_GET['Pegawai'];
		// $model->unit_kerja = 22;

		if(Yii::app()->user->isKabupaten()==1){
			$model->unit_kerja = Yii::app()->user->unitKerja;
		}

		$this->render('rapor',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Pegawai the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Pegawai::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Pegawai $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pegawai-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
