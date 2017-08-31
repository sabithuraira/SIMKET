<?php
/* @var $this PsatkerController */
/* @var $model PaguSatker */

$this->breadcrumbs=array(
	'Rencana Penarikan'=>array('index'),
	'Kelola',
);

$this->menu=array(
	array('label'=>'Tambah Rencana Penarikan', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pagu-satker-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Rencana Penarikan</h1>


<?php 
/*
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pagu-satker-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'m_induk',
		array(
			'name'	=>'m_induk',
			'type'	=>'raw',
			'value'	=>'$data->mInduk->label',
			'filter'=>CHtml::listData(MInduk::model()->findAll(),"id","label"),
		),
		array(
			'name'	=>'unit_kerja',
			'type'	=>'raw',
			'value'	=>'$data->unitKerja->name',
			'filter'=>CHtml::listData(UnitKerja::model()->findAllByAttributes(array('parent'=>1,'jenis'=>2)),"id","name"),
		),
		//'unit_kerja',
		'jumlah',
		'bulan',
		'tahun',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); 
*/
?>