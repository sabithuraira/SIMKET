<?php
/* @var $this UnitkerjaController */
/* @var $model UnitKerja */

$this->breadcrumbs=array(
	'Unit Kerja'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Unit Kerja', 'url'=>array('index')),
	array('label'=>'Create Unit Kerja', 'url'=>array('create')),
	array('label'=>'Update Unit Kerja', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Unit Kerja', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Unit Kerja', 'url'=>array('admin')),
);
?>

<h1>View Unit Kerja #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'code',
		'name',
		'parent',
		'created_by',
		'created_time',
		'updated_by',
		'updated_time',
		'jenis',
	),
)); ?>
