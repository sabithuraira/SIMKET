<?php

class IndukkegiatanController extends Controller
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
			array('allow',
				'actions'=>array('index','view', 'create','update','delete',
					'progress', 'progress_j'),
				'expression'=> function($user){
					return $user->getLevel()==1;
				},
			),
			array('allow',
				'actions'=>array('progress', 'detail_kab_kota',
					'detail_kegiatan',
					'insert_anggaran', 'insert_rpd',
					'detail_kab_kota_j','uk3'),
				'expression'=> function($user){
					return $user->getLevel()<=2;
				},
			),
			array('allow',
				'actions'=>array('dashboard', 'grafik',
					'detail_unit', 'detail_unit_kegiatan'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	public function actionDetail_kab_kota_j($id, $kab_id)
	{
		$model = IndukKegiatan::model()->findByPk($id);
		$data = $model->getByKabKota_j($kab_id);
		
		echo CJSON::encode(array
     	(
        	 'satu' => $data
        ));
        Yii::app()->end();
	}

	public function actionProgress_j($id){
		$this->render('progress_j',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionGrafik(){
		$data = IndukKegiatan::getByUnitKerjaAndKegiatan(0);
		$this->render('grafik',array(
			'data'	=>$data
		));
	}

	public function actionUk3($id){
		$data = IndukKegiatan::getAllAnggaranPerUnitKerja($id);
		$model = $this->loadModelUk($id);
		$this->render('uk3',array(
			'data'	=>$data,
			'model'	=>$model
		));
	}

	public function actionInsert_anggaran($id)
	{
		$satu='';

		if(strlen($_POST['unitkerja']) > 0){
			$model_target = ValueAnggaranTarget::model()->findByAttributes(
				array(
					'kegiatan'	=>$id,
					'unit_kerja'=>$_POST['unitkerja']
				),
				array('order'=>'created_time DESC')
			);

			if($model_target===null){
				$model=new ValueAnggaranTarget;
				$model->kegiatan=$id;
				$model->unit_kerja = $_POST['unitkerja'];
				$model->jumlah = $_POST['target'];
				$model->save();
			}
			else
			{
				if($model_target->jumlah!=$_POST['target']){
					$model=new ValueAnggaranTarget;
					$model->kegiatan=$id;
					$model->unit_kerja = $_POST['unitkerja'];
					$model->jumlah = $_POST['target'];
					$model->save();
				}				
			}

			for($i=1;$i<=12;++$i){
				$model_real = ValueAnggaran::model()->findByAttributes(
					array(
						'kegiatan'	=>$id,
						'unit_kerja'=>$_POST['unitkerja'],
						'bulan'		=>$i
					),
					array('order'=>'created_time DESC')
				);
	
				if($model_real===null){
					$model=new ValueAnggaran;
					$model->kegiatan=$id;
					$model->unit_kerja = $_POST['unitkerja'];
					$model->bulan = $i;
					$model->jumlah = $_POST['r'.$i];
					$model->save();
				}
				else
				{
					if($model_real->jumlah!=$_POST['r'.$i]){
						$model=new ValueAnggaran;
						$model->kegiatan=$id;
						$model->unit_kerja = $_POST['unitkerja'];
						$model->bulan = $i;
						$model->jumlah = $_POST['r'.$i];
						$model->save();
					}				
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


	public function actionInsert_rpd($id)
	{
		$satu='';

		if(strlen($_POST['unitkerja']) > 0){
			for($i=1;$i<=12;++$i){
				$model_real = ValueRpd::model()->findByAttributes(
					array(
						'kegiatan'	=>$id,
						'unit_kerja'=>$_POST['unitkerja'],
						'bulan'		=>$i
					),
					array('order'=>'created_time DESC')
				);
	
				if($model_real===null){
					$model=new ValueRpd;
					$model->kegiatan=$id;
					$model->unit_kerja = $_POST['unitkerja'];
					$model->bulan = $i;
					$model->jumlah = $_POST['rpd'.$i];
					$model->save();
				}
				else
				{
					if($model_real->jumlah!=$_POST['rpd'.$i]){
						$model=new ValueRpd;
						$model->kegiatan=$id;
						$model->unit_kerja = $_POST['unitkerja'];
						$model->bulan = $i;
						$model->jumlah = $_POST['rpd'.$i];
						$model->save();
					}				
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

	public function actionDetail_kab_kota($id, $kab_id)
	{
		$model = IndukKegiatan::model()->findByPk($id);
		$data = $model->getByKabKota($kab_id);
		
		echo CJSON::encode(array
     	(
        	 'satu' => $data
        ));
        Yii::app()->end();
	}

	public function actionDetail_kegiatan($id, $kab_id)
	{
		$data = null;
		if($kab_id==0){
			$data = IndukKegiatan::getByKegiatan($id);
		}
		else{
			$model = IndukKegiatan::model()->findByPk($id);
			$data = $model->getByKabKota($kab_id);
		}

		$result = array();

		$result['target'] = 100;

		$total_rpd=0;
		$total_r=0;
		for($i=1;$i<=12;++$i){
			if($data['target']>0){
				$total_rpd += $data["rpd$i"];
				$total_r += $data["r$i"];

				$result["rpd$i"] = $total_rpd/$data["target"]*100;
				$result["r$i"] = $total_r/$data["target"]*100;

				if($result["rpd$i"] > 100)
					$result["rpd$i"] = 100;

				if($result["r$i"] > 100)
					$result["r$i"] = 100;
			}
			else{
				$result["rpd$i"] = 0;
				$result["r$i"] = 0;
			}
		}

		
		echo CJSON::encode(array
     	(
        	 'satu' => $result
        ));
        Yii::app()->end();
	}

	public function actionDetail_unit($id)
	{
		$data = IndukKegiatan::getByUnitKerja($id);
		// if($kab_id==0){
		// 	$data = IndukKegiatan::getByKegiatan($id);
		// }
		// else{
		// 	$model = IndukKegiatan::model()->findByPk($id);
		// 	$data = $model->getByKabKota($kab_id);
		// }

		$result = array();

		$result['target'] = 100;

		$total_rpd=0;
		$total_r=0;
		for($i=1;$i<=12;++$i){
			if($data['target']>0){
				$total_rpd += $data["rpd$i"];
				$total_r += $data["r$i"];

				$result["rpd$i"] = $total_rpd/$data["target"]*100;
				$result["r$i"] = $total_r/$data["target"]*100;

				if($result["rpd$i"] > 100)
					$result["rpd$i"] = 100;

				if($result["r$i"] > 100)
					$result["r$i"] = 100;
			}
			else{
				$result["rpd$i"] = 0;
				$result["r$i"] = 0;
			}
		}

		
		echo CJSON::encode(array
     	(
        	 'satu' => $result
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
		$model=new IndukKegiatan;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['IndukKegiatan']))
		{
			$model->attributes=$_POST['IndukKegiatan'];
			$model->output_id = $_POST['IndukKegiatan']['output_id'];
			$model->unit_kerja_id = $_POST['IndukKegiatan']['unit_kerja_id'];
			if($model->save())
				$this->redirect(array('index'));
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

		if(isset($_POST['IndukKegiatan']))
		{
			$model->attributes=$_POST['IndukKegiatan'];
			$model->output_id = $_POST['IndukKegiatan']['output_id'];
			$model->unit_kerja_id = $_POST['IndukKegiatan']['unit_kerja_id'];
			if($model->save())
				$this->redirect(array('index'));
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
		$model=new IndukKegiatan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_POST['IndukKegiatan']))
			$model->attributes=$_POST['IndukKegiatan'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionDashboard()
	{
		$model=new IndukKegiatan('search');
		$model->unsetAttributes();
		if(isset($_POST['IndukKegiatan']))
			$model->attributes=$_POST['IndukKegiatan'];

		$this->render('dashboard',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return IndukKegiatan the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = IndukKegiatan::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelUk($id)
	{
		$model = UnitKerja::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param IndukKegiatan $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='induk-kegiatan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
