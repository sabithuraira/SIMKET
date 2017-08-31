<?php
/* @var $this AnggaranController */
/* @var $model Anggaran */

$this->breadcrumbs=array(
	'Anggarans'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Anggaran', 'url'=>array('index')),
	array('label'=>'Create Anggaran', 'url'=>array('create')),
	array('label'=>'Update Anggaran', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Anggaran', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Anggaran', 'url'=>array('admin')),
);
?>

<h1>View Anggaran #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'unit_kerja',
		'jumlah',
		'm_o_from',
		'm_o_to',
		'ket',
		'jenis',
		'created_by',
		'created_time',
		'updated_by',
		'updated_time',
	),
)); ?>
