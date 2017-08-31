<?php
/* @var $this KegiatanController */
/* @var $model Kegiatan */

$this->breadcrumbs=array(
	'Kegiatan'=>array('index'),
	'Manage',
);

if(!HelpMe::isKabupaten())
{
    $this->menu=array(
        array('label'=>'<i class="icon-th-list"></i>  Tambah Kegiatan', 'url'=>array('create')),
    );
}

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#kegiatan-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Kegiatan</h1>
<div class="alert alert-info">
  <strong>Ket :</strong> Tombol delete hanya ditampilkan untuk user yang memiliki hak
</div>
<!--
<div id="calendar"></div>
-->
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'kegiatan-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,

'summaryText'=>Yii::t('penerjemah','Menampilkan {start}-{end} dari {count} hasil'),
				            'pager'=>array(
				                'header'=>Yii::t('penerjemah','Ke halaman : '),
				                'prevPageLabel'=>Yii::t('penerjemah','Sebelumnya'),
				                'nextPageLabel'=>Yii::t('penerjemah','Selanjutnya'),
				                'firstPageLabel'=>Yii::t('penerjemah','Pertama'),
				                'lastPageLabel'=>Yii::t('penerjemah','Terakhir'),
				                ),
				                
	'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	'columns'=>array(
		//'id',
		'kegiatan',
		array(
			'name'		=>'unit_kerja',
				                        'type'=>'raw',
			'value'		=> function($data){ return $data->unitKerja->name; },
			//'$data->unitKerja->name',
			'filter'	=>CHtml::listData(UnitKerja::model()->findAllByAttributes(array('jenis'=>'1')),'id','name'),
		),
		array(
			'name'		=>'start_date',
			'type'      =>'raw',
			'value'		=> function($data){ return HelpMe::HrDate($data->start_date); },
// 			'value'		=>'HelpMe::HrDate($data->start_date)',
			'filter'	=>'',
		),
		array(
			'name'		=>'end_date',
// 			'value'		=>'HelpMe::HrDate($data->end_date)',
			'type'      =>'raw',
			'value'		=> function($data){ return HelpMe::HrDate($data->end_date); },
			'filter'	=>'',
		),
		//'created_time',
		/*
		'created_by',
		'updated_time',
		'updated_by',
		*/
		array(
			'header'	=>'Progress',
			'type'      =>'raw',
			'value'		=> function($data){ return $data->progressValue." %"; },
// 			'value'		=>'$data->progressValue." %"',
		),
		array(
			'header'	=>'',
			'type'		=>'raw',
			'value'		=> function($data){ return CHtml::link("Progress",array("kegiatan/progress","id"=>$data->id)); },
// 			'value'		=>'CHtml::link("Progress",array("kegiatan/progress","id"=>$data->id))',
		),
      array(
            'header'    =>'Delete',
            'type'      =>'raw',
			'value'		=> function($data){ return (HelpMe::isAuthorizeUnitKerja($data->unit_kerja)) ? CHtml::link( "Delete",array("kegiatan/delete","id"=>$data->id),array("confirm"=>"Anda yakin ingin menghapus kegiatan ini?")) : "Tidak berhak"; },
            // 'value'     =>'(HelpMe::isAuthorizeUnitKerja($data->unit_kerja)) ? CHtml::link( "Delete",array("kegiatan/delete","id"=>$data->id),array("confirm"=>"Anda yakin ingin menghapus kegiatan ini?")) : "Tidak berhak"', 
      ),
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}',
		),
	),
)); ?>


<script>

  $(document).ready(function() {
  
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    
    $('#calendar').fullCalendar({
      height:300,
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      editable: true,
      events: {
            url: "<?php echo Yii::app()->createUrl('kegiatan/activecalendar'); ?>",
            type: 'POST', // Send post data
            error: function() {
                alert('There was an error while fetching events.'); // Error alert
            }
        },
    });
    
  });

</script>