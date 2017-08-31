<?php
/* @var $this IndukController */
/* @var $model MInduk */

$this->breadcrumbs=array(
	'Induk'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Induk', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#minduk-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Induk</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'minduk-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'label',
		'created_by',
		'created_time',
		'updated_by',
		'updated_time',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
