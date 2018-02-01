<?php
/* @var $this MitrabpsController */
/* @var $model MitraBps */

$this->breadcrumbs=array(
	'Mitra Bps'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MitraBps', 'url'=>array('index')),
	array('label'=>'Create MitraBps', 'url'=>array('create')),
	array('label'=>'Update MitraBps', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MitraBps', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MitraBps', 'url'=>array('admin')),
);
?>

<h1>View MitraBps #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nama',
		'nomor_telepon',
		'alamat',
		'tanggal_lahir',
		'jk',
		'created_time',
		'updated_time',
		'created_by',
		'updated_by',
	),
)); ?>
