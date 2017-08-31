<?php
/* @var $this PaguController */
/* @var $model Pagu */

$this->breadcrumbs=array(
	'PAGU AWAL'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pagu-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Kelola Data PAGU Awal</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pagu-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'m_output',
		array(
			'name'	=>'m_output',
			'type'	=>'raw',
			'value'	=>'$data->mOutput->label',
			'filter'=>CHtml::listData(MOutput::model()->findAll(),"id","label"),
		),
		array(
			'name'	=>'unit_kerja',
			'type'	=>'raw',
			'value'	=>'$data->unitKerja->name',
			'filter'=>CHtml::listData(UnitKerja::model()->findAllByAttributes(array('parent'=>1)),"id","name"),
		),
		//'unit_kerja',
		array(
			'name'	=>'jumlah',
			'filter'=>'',
		),
		array(
			'name'	=>'tahun',
			'filter'=>'',
		),array(
			'name'	=>'revisi',
			'filter'=>'',
		),array(
			'name'	=>'tw1',
			'filter'=>'',
		),array(
			'name'	=>'tw2',
			'filter'=>'',
		),array(
			'name'	=>'tw3',
			'filter'=>'',
		),array(
			'name'	=>'tw4',
			'filter'=>'',
		),
		//'created_by',
		/*
		'created_time',
		'updated_by',
		'updated_time',
		'm_induk',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}'
		),
	),
)); ?>
