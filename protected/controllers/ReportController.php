<?php

class ReportController extends Controller
{
    public $layout='//layouts/column1';

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
                'actions'=>array('index','kabupaten','rekap', 'api_report_kabupaten'),
                'users'=>array('*'),
            ),
          
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $bidang=2;

        $tahun=date('Y');

        if(isset($_POST['tahun']))
            $tahun=$_POST['tahun'];

        if(isset($_POST['bidang']))
            $bidang=$_POST['bidang'];

        $this->render('index',array(
            'bidang'=>$bidang,
            'tahun'=>$tahun,
        ));        
    }

    public function actionRekap()
    {
        $bidang=2;

        $tahun=date('Y');

        if(isset($_POST['tahun']))
            $tahun=$_POST['tahun'];
        
        if(isset($_POST['bidang']))
            $bidang=$_POST['bidang'];
        $this->render('rekap',array(
            'bidang'=>$bidang,
            'tahun'=>$tahun,
        ));        
    }

    public function actionKabupaten($id)
    {
        $tahun=date('Y');

        if(isset($_GET['tahun']))
            $tahun=$_GET['tahun'];

        $data=ReportMe::KegiatanKabupaten($id,$tahun);
        $model=UnitKerja::model()->findByPk($id);

        $this->render('kabupaten',array(
            'data'          =>$data,
            'model'         =>$model,
            'tahun'         =>$tahun,
        ));
    }

    public function actionApi_report_kabupaten($tahun){
        $dataprogress=ReportMe::KabupatenPerMonth($id,$tahun);

		echo CJSON::encode(array
		(
			'dataprogress'=>$dataprogress
		));

		Yii::app()->end();
	}
}
