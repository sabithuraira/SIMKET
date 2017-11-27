<?php

class JadwalTugasController extends Controller
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
				'actions'=>array('view', 'calendar', 'single_calendar',
					'review'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','delete', 'stugas', 
					'api_pejabat', 'enter_surat', 'api_view'),
				'users'=>array('@'),
			),

			array('allow', // allow admin user to perform 'admin' and 'delete' actions
			'actions'=>array('jadwalpegawai', 'checkjadwal', 
				'listpegawai', 'listkegiatan'),
			'users'=>array('*'),
		),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionApi_view($id)
	{
	   	$model = $this->loadModel($id);

		echo CJSON::encode(array(
			'no_surat'=>$model->print_no,
			'nip_ttd'	=>$model->print_ttd_nip,
			'nama_ttd'	=>$model->print_ttd,
			'is_kepala'	=>$model->print_is_kepala
		));

		Yii::app()->end();
	}

	public function actionEnter_surat($id){
		$result = "false";
		if(isset($_POST['no_surat'], $_POST['nama_ttd'], $_POST['nip_ttd'], $_POST['is_kepala'])){
			$model = $this->loadModel($id);
			$model->print_no=$_POST['no_surat'];
			$model->print_ttd=$_POST['nama_ttd'];
			$model->print_ttd_nip=$_POST['nip_ttd'];
			$model->print_is_kepala=$_POST['is_kepala'];
			if($model->save()){
				$result="true";
			}
		}

		echo CJSON::encode($result);
		Yii::app()->end();
	}

	public function actionApi_pejabat($id)
	{
	   	$model = Pegawai::model()->findByAttributes(array(
			   'unit_kerja' =>Yii::app()->user->getUnitKerja(),
			   'unit_kerja_kab' =>$id
		   ));

		$seksi = UnitKerjaDaerah::model()->findByPk($id);

		$result=array();
		if($model==null){
			$result=array(
				'nama'=>'',
				'nip'	=>'',
				'seksi'	=>'',
			);
		}
		else{
			$result=array(
				'nama'=>$model->nama,
				'nip'	=>$model->nip,
				'seksi'	=>$seksi->kode,
			);
		}

		echo CJSON::encode($result);

		Yii::app()->end();
	}

	public function actionSingle_calendar(){
		$this->render('single_calendar');
	}

	public function actionCalendar(){
		$this->render('calendar');
	}

	public function actionListpegawai(){
		$datas = Pegawai::model()->findAll();
		$data = array();

		foreach($datas as $val){
			$data[] = array(
				'id'=>$val['nip'],
				'name'=>$val['nama']
			);
		}

		echo CJSON::encode(array
		(
			'data'=>$data
		));

		Yii::app()->end();
	}

	public function actionListkegiatan($id){
		$data = JadwalTugas::model()->listKegiatanByMonth($id);

		echo CJSON::encode(array
		(
			'data'=>$data
		));

		Yii::app()->end();
	}

	public function actionCheckjadwal($id, $tstart, $tend){
		$data = -1;
		// print_r($_POST);
		if(isset($tstart, $tend)){
			$data = JadwalTugas::model()->isAvailable($id, $tstart, $tend);
		}

		print_r($data);
		// die();

		return $data;
	}

	public function actionJadwalpegawai($id)
	{
	   	$models = JadwalTugas::model()->searchByPegawai($id);
		// print_r($models);die();

		$data = array();
		foreach($models as $value){
			// print_r($value);die();
			$data[] = array(
				'title'=> $value['nama_kegiatan'],
				'start'=> $value['tanggal_mulai'],
				'end'=> date('Y-m-d', strtotime($value['tanggal_berakhir'] . ' +1 day')),
				'backgroundColor'=> "#f56954",
				'borderColor' => "#f56954"
			);
		}

		echo CJSON::encode(array
		(
			'data'=>$data
		));

		Yii::app()->end();
	}


	public function actionStugas($id){
		$this->layout='//layouts/print';
		
		$this->render('cetak',array(
			'model'=>$this->loadModel($id),
		));
	}
	public function actionReview($id){
		$this->render('review',array(
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
		$model=new JadwalTugas;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['JadwalTugas']))
		{
			$model->attributes=$_POST['JadwalTugas'];
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

		if(isset($_POST['JadwalTugas']))
		{
			$model->attributes=$_POST['JadwalTugas'];
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
		$model=new JadwalTugas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['JadwalTugas']))
			$model->attributes=$_GET['JadwalTugas'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return JadwalTugas the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=JadwalTugas::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param JadwalTugas $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='jadwal-tugas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
