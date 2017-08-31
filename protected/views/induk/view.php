<?php
/* @var $this IndukController */
/* @var $model MInduk */

$this->breadcrumbs=array(
	'Induk'=>array('index'),
	$model->label,
);

$this->menu=array(
	array('label'=>'List Induk', 'url'=>array('index')),
	array('label'=>'Create Induk', 'url'=>array('create')),
	array('label'=>'Update Induk', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Induk', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'label',
		'created_by',
		'created_time',
		'updated_by',
		'updated_time',
	),
)); ?>
