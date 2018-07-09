<?php

class Kegiatan_mitraController extends Controller
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
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create', 'update', 'mitra',
					'insert_petugas', 'delete_petugas',
					'get_list_mitra',
					'nilai', 'resume', 'get_list_wilayah',
					'delete_wilayah', 'add_single_wilayah', 'form'),
				'expression'=> function($user){
					return $user->getLevel()<=1;
				},
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'expression'=> function($user){
					return $user->getLevel()<=1;
				},
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionDelete_petugas($id)
	{
		$satu=array();

		$petugas = KegiatanMitraPetugas::model()->findByPk($id);
		$id_kegiatan = $petugas->id_kegiatan;
		$petugas->delete();

		echo CJSON::encode(array
		(
			'satu'=>$id_kegiatan,
		));
		Yii::app()->end();
	}

	public function actionAdd_single_wilayah($id) //kegiatan_id
	{
		$satu='';
		
		if(strlen($_POST['nks'])>0 && strlen($_POST['bs'])>0 && strlen($_POST['kmp_id'])>0){
			$m_wils = new KegiatanMitraWilayah;
			$m_wils->kmp_id = $_POST['kmp_id'];
			$m_wils->kegiatan_id = $id;
			$m_wils->mitra_id = $_POST['mitra_id'];
			
			$m_wils->nks = $_POST['nks'];
			$m_wils->bs = $_POST['bs'];
			$m_wils->save();
						
			$satu= $id;
		}
		
		echo CJSON::encode(array
		(
				'satu'=>$satu,
		));
		Yii::app()->end();
	}

	public function actionDelete_wilayah($id)
	{
		$satu=array();

		$wil = KegiatanMitraWilayah::model()->findByPk($id);
		$wil->delete();

		echo CJSON::encode(array
		(
			'satu'=>$id,
		));
		Yii::app()->end();
	}

	public function actionGet_list_wilayah($id)
	{
		$satu=array();

		$wils = KegiatanMitraWilayah::model()->findAllByAttributes(array(
			'kmp_id'	=>$id
		));

		foreach($wils as $key => $value){
			$satu[] = array(
				'id'	=>$value->id,
				'nks'	=>$value->nks,
				'bs'	=>$value->bs,
				'kegiatan_id'	=>$value->kegiatan_id,
				'mitra_id'		=>$value->mitra_id
			);
		}

		echo CJSON::encode(array
		(
			'satu'=>$satu,
		));
		Yii::app()->end();
	}

	public function actionGet_list_mitra($id)
	{
		$satu='';

		if(strlen($_POST['mitra_from'])>0){
			if($_POST['mitra_from']==1){
				//pegawai
				$data=Pegawai::model()->findAllByAttributes(array('unit_kerja'=>$id));
				$data=CHtml::listData($data,'nip','nama');
			
				foreach($data as $value=>$name)
				{
					$satu.= CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
				}
			}
			else{
				//mitra
				$data=MitraBps::model()->findAllByAttributes(array('kab_id'=>$id));
				$data=CHtml::listData($data,'id','nama');

				foreach($data as $value=>$name)
				{
					$satu.= CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
				}
			}
			
		}

		echo CJSON::encode(array
		(
			'satu'=>$satu,
		));
		Yii::app()->end();
	}

	public function actionInsert_petugas($id)
	{
		$satu='';

		if(strlen($_POST['mitra_id'])>0 && strlen($_POST['mitra_from'])>0 && strlen($_POST['mitra_status'])>0){
			$model=KegiatanMitraPetugas::model()->findByAttributes(array(
				'id_kegiatan'=>$id, 
				'flag_mitra'=>$_POST['mitra_from'],
				'id_mitra'	=>$_POST['mitra_id']
			));
			
			if($model==null){
				$model=new KegiatanMitraPetugas;
				$model->id_kegiatan = $id;
				$model->flag_mitra  = $_POST['mitra_from'];
				$model->id_mitra	= $_POST['mitra_id'];
				$model->status 		= $_POST['mitra_status'];
				$model->nilai 		= 0;
				
				if($model->save())
				{
					if($model->status!=1){
						$total_wil = count($_POST['mitra_wils']);
						if($total_wil>0){
							for($i=0;$i<$total_wil;++$i){
								$m_wils = new KegiatanMitraWilayah;
								$m_wils->kmp_id = $model->id;
								$m_wils->kegiatan_id = $model->id_kegiatan;
								$m_wils->mitra_id = $model->id_mitra;
								
								$m_wils->nks = $_POST['mitra_wils'][$i]['nks'];
								$m_wils->bs = $_POST['mitra_wils'][$i]['bs'];
								$m_wils->save();
							}
						}
					}

					$satu= $id;
				}
			}
		}
		
		echo CJSON::encode(array
     	(
        	 'satu'=>$satu,
        ));
        Yii::app()->end();
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
		$model=new KegiatanMitra;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['KegiatanMitra']))
		{
			$model->attributes=$_POST['KegiatanMitra'];
			$model->kab_id = 22;
			$model->induk_id = 15;
			if($model->save())
				$this->redirect(array('mitra', 'id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionForm($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['par_post'])){
			$all_pertanyaan = MitraPertanyaan::model()->findAll();
			
			foreach($all_pertanyaan as $key=>$value){
				if(isset($_POST['form'.$value['id']])){
					///
					$new_soal = new KegiatanMitraPertanyaan;
					$new_soal->kegiatan_mitra_id = $id;
					$new_soal->mitra_pertanyaan_id =  $value['id'];
					if(isset($_POST['wil'.$value['id']]))
						$new_soal->is_per_wilayah = 1;
					$new_soal->save();
					//
				}
			}

			$model->is_set_form = 1;
			$model->save();
		}

		$this->render('form',array(
			'model'		=>$model
		));
	}

	public function actionMitra($id)
	{
		$model=$this->loadModel($id);
		$list_mitra = $model->listMitra();

		$this->render('mitra',array(
			'model'		=>$model,
			'list_mitra'=>$list_mitra
		));
	}

	public function actionResume($id){
		$model=$this->loadModel($id);
		$list_mitra = $model->listMitra();

		$this->render('resume',array(
			'model'		=>$model,
			'list_mitra'=>$list_mitra
		));
	}

	public function actionNilai($id)
	{
		$is_simpan = false;
		$model=$this->loadModelPetugas($id);
		$questions = KegiatanMitraPertanyaan::model()->findAllByAttributes(array(
			'kegiatan_mitra_id'	=>$model->id_kegiatan,
		));

		// $questions = MitraPertanyaan::model()->findAll(
		// 	'teruntuk=:t1 OR teruntuk=:t2', array(':t1'=>$model->status, ':t2'=>3)
		// );

		if(isset($_POST))
		{
			foreach ($questions as $kkey => $kvalue)
			{
				$value = MitraPertanyaan::model()->find(
					'id=:t0 AND (teruntuk=:t1 OR teruntuk=:t2)', array(':t0'=>$kvalue->mitra_pertanyaan_id ,':t1'=>$model->status, ':t2'=>3)
				);


				if($value!==null){
					if($kvalue->is_per_wilayah==1){
						$wilayah = KegiatanMitraWilayah::model()->findAllByAttributes(array(
							'kmp_id'	=>$model->id //this field refer to id_mitra in kegiatan NOT ID PEGAWAI/MITRA MASTER
						));
						foreach ($wilayah as $key_wil => $value_wil)
						{
							if(isset($_POST['opts'.$value['id'].'_'.$value_wil['id']])){
								$nilai = MitraNilai::model()->findByAttributes(
									array(
										'mitra_id'		=>$id, //this field refer to id_mitra in kegiatan NOT ID PEGAWAI/MITRA MASTER
										'pertanyaan_id'	=>$value['id'],
										'wilayah_id'	=>$value_wil['id']
									)
								);
			
								if($nilai==null){
									$nilai = new MitraNilai;
									$nilai->mitra_id = $id;
									$nilai->kegiatan_id = $model->id_kegiatan;
									$nilai->pertanyaan_id = $value['id'];
									$nilai->nilai = $_POST['opts'.$value['id'].'_'.$value_wil['id']];
									$nilai->wilayah_id = $value_wil['id'];
									$nilai->save();
			
									$is_simpan = true;
								}
								else{
									$nilai->nilai = $_POST['opts'.$value['id'].'_'.$value_wil['id']];
									$nilai->save();
									$is_simpan = true;
								}
							}
						}
					}
					else{
						if(isset($_POST['opts'.$value['id']])){
							$nilai = MitraNilai::model()->findByAttributes(
								array(
									'mitra_id'		=>$id, //this field refer to id_mitra in kegiatan NOT ID PEGAWAI/MITRA MASTER
									'pertanyaan_id'	=>$value['id']
								)
							);
		
							if($nilai==null){
								$nilai = new MitraNilai;
								$nilai->mitra_id = $id;
								$nilai->kegiatan_id = $model->id_kegiatan;
								$nilai->pertanyaan_id = $value['id'];
								$nilai->nilai = $_POST['opts'.$value['id']];
								$nilai->save();
		
								$is_simpan = true;
							}
							else{
								$nilai->nilai = $_POST['opts'.$value['id']];
								$nilai->save();
								$is_simpan = true;
							}
						}
					}
				}
			}

			if($model->totalPertanyaan==0 || $model->totalNilai==0)
				$model->nilai = 0;
			else
				$model->nilai = ($model->totalNilai/$model->totalPertanyaan);
			
			$model->save();
		}

		$this->render('nilai',array(
			'model'		=>$model,
			'questions'	=>$questions,
			'is_simpan'	=>$is_simpan
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

		if(isset($_POST['KegiatanMitra']))
		{
			$model->attributes=$_POST['KegiatanMitra'];
			if($model->save())
				$this->redirect(array('mitra','id'=>$model->id));
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
		$model=new KegiatanMitra('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['KegiatanMitra']))
			$model->attributes=$_GET['KegiatanMitra'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return KegiatanMitra the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=KegiatanMitra::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	public function loadModelPetugas($id)
	{
		$model=KegiatanMitraPetugas::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param KegiatanMitra $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='kegiatan-mitra-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
