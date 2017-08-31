<?php
/* @var $this PsatkerController */
/* @var $model PaguSatker */

$this->breadcrumbs=array(
	'Pagu Satkers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PaguSatker', 'url'=>array('index')),
	array('label'=>'Create PaguSatker', 'url'=>array('create')),
	array('label'=>'Update PaguSatker', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PaguSatker', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PaguSatker', 'url'=>array('admin')),
);
?>

<h1>View PaguSatker #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'm_induk',
		'unit_kerja',
		'jumlah',
		'bulan',
		'tahun',
		'created_by',
		'created_time',
		'updated_by',
		'updated_time',
	),
)); ?>
