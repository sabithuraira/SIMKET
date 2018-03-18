<?php
/* @var $this Kegiatan_mitraController */
/* @var $model KegiatanMitra */

$this->breadcrumbs=array(
	'Kegiatan Mitras'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List KegiatanMitra', 'url'=>array('index')),
	array('label'=>'Create KegiatanMitra', 'url'=>array('create')),
	array('label'=>'Update KegiatanMitra', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete KegiatanMitra', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage KegiatanMitra', 'url'=>array('admin')),
);
?>

<h1>View KegiatanMitra #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'induk_id',
		'nama',
		'simket_id',
		'kab_id',
		'created_by',
		'created_time',
		'updated_by',
		'updated_time',
	),
)); ?>
