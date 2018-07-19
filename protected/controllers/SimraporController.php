<?php

class SimraporController extends Controller
{
	public $layout='//layouts/column2';
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionCalendar()
	{
		$bidang=1;

		$this->render('calendar',array(
			'bidang'=>$bidang
		));
	}

	public function actionTagihan(){

		$tahun=date('Y');
		$kegiatan=Kegiatan::model()->getTop5();
		$model=new Kegiatan;

		if(isset($_POST['tahun']))
			$tahun=$_POST['tahun'];

		$this->render('tagihan',array(
			'kegiatan'		=>$kegiatan,
			'model'			=>$model,
			'tahun'			=>$tahun,
		));
	}

	public function actionBidang($id)
	{
		$this->layout='//layouts/column1';

		$tahun=date('Y');
		
		if(isset($_POST['tahun']))
			$tahun=$_POST['tahun'];

		$model=$this->loadModelKab($id);
		$this->render('bidang',array(
			'model'		=>$model,
			'tahun'			=>$tahun,
		));
	}

	public function loadModelKab($id)
	{
		$model=UnitKerja::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}