
<style>
    @import url('<?php echo Yii::app()->theme->baseUrl.'/css/baru/jadwal.css';?>');
</style>
<?php
/* @var $this KegiatanController */
/* @var $model Kegiatan */
/*
$this->breadcrumbs=array(
    'Bidang'=>array('index'),
    $model->name,
);
*/
?>

<div class="row">

    <div class="col-md-12">

        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $model->name; ?></h3>
            </div>


            <div class="pad margin no-print">
                <div class="form">
                    <?php $form=$this->beginWidget('CActiveForm', array(
                        'method'=>'get',
                        'id'=>'kegiatan-form',
                        'enableAjaxValidation'=>false,
                    )); ?>
                        <div class="center">
                            <?php echo "<b>Tampilkan Data Tahun : </b>"; ?>
                            <?php echo CHtml::dropDownList('tahun',$tahun,HelpMe::getYearForFilter()); ?>
                            <?php echo CHtml::submitButton('Tampilkan',array('class'=>'btn btn-success')); ?>
                        </div>

                    <?php $this->endWidget(); ?>
                </div>
            </div>

            <div class="row-fluid">
            <div class="span12">
                <?php
                    $this->beginWidget('zii.widgets.CPortlet', array(
                        'title'=>"<i class='icon-check'></i> Performa Perbulan",
                    ));
                    
                ?>
                    <div class="kab-perform-chart" style="height: 150px;width:100%;margin-top:15px; margin-bottom:15px;"></div>
                <?php $this->endWidget();?>
            </div>
            </div>

            <div class="row-fluid">
                <?php foreach (UnitKerja::model()->findAllByAttributes(array('parent'=>1,'jenis'=>1)) as $key => $value) { ?> 
                <div class="span2 ">
                    <div class="stat-block">
                    <ul>
                        <li class="stat-count">
                            <span>
                                <?php echo ReportMe::ValuePerKabBidang($value->id,$model->id,$tahun) ?>
                            </span>
                            <span>
                                <?php echo $value->name; ?>
                            </span>
                        </li>
                    </ul>
                    </div>
                </div>
                <?php } ?>



            </div>


            <?php
            $this->widget('ext.groupgridview.GroupGridView', array(
                'id' => 'grid1',
                'dataProvider' => $data,
                'mergeColumns' => array('bulan'),  
                
            'summaryText'=>Yii::t('penerjemah','Menampilkan {start}-{end} dari {count} hasil'),
                                        'pager'=>array(
                                            'header'=>Yii::t('penerjemah','Ke halaman : '),
                                            'prevPageLabel'=>Yii::t('penerjemah','Sebelumnya'),
                                            'nextPageLabel'=>Yii::t('penerjemah','Selanjutnya'),
                                            'firstPageLabel'=>Yii::t('penerjemah','Pertama'),
                                            'lastPageLabel'=>Yii::t('penerjemah','Terakhir'),
                                            ),
                'columns' => array(
                    array(
                        'header'        =>'Bulan',
                        'name'          =>'bulan',
                    ),
                    array(
                        'header'        =>'Kegiatan',
                        'name'          =>'kegiatan',
                        'type'          =>'raw',
                        'value'         =>function($data) { return CHtml::link($data["kegiatan"],array("kegiatan/progress","id"=>$data["id"])); }
                    ),
                    array(
                        'header'        =>'Tanggal Berakhir',
                        'name'          =>'end_date',
                        'type'          =>'raw',
                        'value'         =>function($data){ return date("d M Y",strtotime($data["end_date"])); },
                    ),
                    array(
                        'header'        =>'Target',
                        'name'          =>'target',
                    ),
                    array(
                        'header'        =>'Nilai',
                        'name'          =>'timelines_point',
                    ),
                ),
                ));
            ?>


<script>
$(document).ready(function() {
    console.log("hai");
    
    var divElement = $('div'); //log all div elements

    if (divElement.hasClass('kab-perform-chart')) {
    $(function () {
        function gd(year, month, day) {
            return new Date(year, month, day).getTime();
        }
        //some data
        var d1=[];
        <?php 
            $tahun=date('Y');
            foreach ($dataprogress as $key => $value) { ?>
            d1[d1.length]=[gd(<?php echo $tahun; ?>,<?php echo $value['bulan']-1 ?>,1),<?php echo $value['nilai'] ?>];
        <?php } ?>
        //define placeholder class
        var placeholder = $(".kab-perform-chart");
        //graph options
        var options = {
                grid: {
                    show: true,
                    aboveData: true,
                    color: "#3f3f3f" ,
                    labelMargin: 5,
                    axisMargin: 0, 
                    borderWidth: 0,
                    borderColor:null,
                    minBorderMargin: 5 ,
                    clickable: true, 
                    hoverable: true,
                    autoHighlight: true,
                    mouseActiveRadius: 20
                },
                series: {
                    grow: {
                        active: false,
                        stepMode: "linear",
                        steps: 50,
                        stepDelay: true
                    },
                    lines: {
                        show: true,
                        fill: true,
                        lineWidth: 4,
                        steps: false
                        },
                    points: {
                        show:true,
                        radius: 5,
                        symbol: "circle",
                        fill: true,
                        borderColor: "#fff"
                    }
                },
                legend: { 
                    position: "ne", 
                    margin: [0,-25], 
                    noColumns: 0,
                    labelBoxBorderColor: null,
                    labelFormatter: function(label, series) {
                        // just add some space to labes
                        return label+'&nbsp;&nbsp;';
                     }
                },
                yaxis: { min: 0 },
                xaxis: {
                    mode: "time",
                    tickSize: [1, "month"],
                    tickLength: 0,
                    axisLabel: "2012",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Verdana, Arial',
                    axisLabelPadding: 10
                },
                colors: chartColours,
                shadowSize:1,
                tooltip: true, //activate tooltip
                tooltipOpts: {
                    content: "%s : %y.0",
                    shifts: {
                        x: -30,
                        y: -50
                    }
                }
            };   
    
            $.plot(placeholder, [ 

                {
                    label: "Nilai Perbulan", 
                    data: d1,
                    lines: {fillColor: "#f2f7f9"},
                    points: {fillColor: "#88bbc8"}
                }

            ], options);
            
    });
    }//end if

});
</script>