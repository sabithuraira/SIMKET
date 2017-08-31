<?php
/* @var $this KegiatanController */
/* @var $model Kegiatan */

$this->breadcrumbs=array(
	'Kegiatan'=>array('index'),
	$model->kegiatan,
);

$this->menu=array(
	array('label'=>'List Kegiatan', 'url'=>array('index')),
	array('label'=>'Create Kegiatan', 'url'=>array('create')),
	array('label'=>'Update Kegiatan', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Kegiatan', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Kegiatan', 'url'=>array('admin')),
);
?>

<h1>View Kegiatan <?php echo $model->kegiatan; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'kegiatan',
		'unit_kerja',
		'start_date',
		'end_date',
		'created_time',
		'created_by',
		'updated_time',
		'updated_by',
	),
)); ?>
