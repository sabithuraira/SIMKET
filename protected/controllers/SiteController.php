<?php

class SiteController extends Controller
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
		$this->render('calendar');
	}

	public function actionPeringkat()
	{
		$bidang=1;
		$tahun=date('Y');

		if(isset($_POST['tahun']))
			$tahun=$_POST['tahun'];

		if(isset($_POST['bidang']))
			$bidang=$_POST['bidang'];

		$data=ReportMe::WilayahThisYear($bidang,$tahun);
		$this->render('peringkat',array(
			'data'			=>$data,
			'bidang'		=>$bidang,
			'tahun'			=>$tahun,
		));	
	}

	public function actionSummary()
	{
		$kegiatan=Kegiatan::model()->getTop5();
		$model=new Kegiatan;
		$this->render('summary',array(
			'kegiatan'		=>$kegiatan,
			'model'			=>$model,
		));
	}	


	public function actionPeringkat_month()
	{
		$year=date('Y');
		$month=date('m');
		$bidang=1;

		if(isset($_POST['year']))
			$year=$_POST['year'];

		if(isset($_POST['month']))
			$month=$_POST['month'];

		if(isset($_POST['bidang']))
			$bidang=$_POST['bidang'];

		$data=ReportMe::WilayahTahunBulan($year,$month,$bidang);
		$this->render('peringkat_month',array(
			'data'			=>$data,
			'year'			=>$year,
			'month'			=>$month,
			'bidang'		=>$bidang,
		));	
	}	

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$peringkat1tahun=ReportMe::Peringkat1Tahunan(2016);
		$peringkat1bulan=ReportMe::Peringkat1Bulanan(2016,3);

		$this->render('index',array(
			'peringkat1tahun'	=>$peringkat1tahun,
			'peringkat1bulan'	=>$peringkat1bulan,
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

	public function actionKabupaten($id)
	{
		$this->layout='//layouts/column1';
		$model=$this->loadModelKab($id);
		$this->render('kabupaten',array(
			'model'		=>$model,
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

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->layout='//layouts/login';
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function loadModelKab($id)
	{
		$model=UnitKerja::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}