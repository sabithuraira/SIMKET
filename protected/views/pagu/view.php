<?php
/* @var $this PaguController */
/* @var $model Pagu */

$this->breadcrumbs=array(
	'Pagus'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Pagu', 'url'=>array('index')),
	array('label'=>'Update Pagu', 'url'=>array('update', 'id'=>$model->id)),
);
?>

<h1>View Pagu #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'm_output',
		'unit_kerja',
		'jumlah',
		'tahun',
		'created_by',
		'created_time',
		'updated_by',
		'updated_time',
		'm_induk',
	),
)); ?>
