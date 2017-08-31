<?php
/* @var $this AnggaranController */
/* @var $model Anggaran */

$this->breadcrumbs=array(
	'Anggaran'=>array('index'),
	'Kelola',
);

$this->menu=array(
	array('label'=>'Tambah Anggaran', 'url'=>array('create')),
	array('label'=>'Kelola Rencana Penarikan Kab/Kota', 'url'=>array('rp')),
	array('label'=>'Kelola PAGU AWAL', 'url'=>array('pa')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#anggaran-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Kelola Anggaran</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'anggaran-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'unit_kerja',
		'jenis',
		'jumlah',
		'm_o_from',
		'm_o_to',
		'ket',
		/*
		'created_by',
		'created_time',
		'updated_by',
		'updated_time',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
