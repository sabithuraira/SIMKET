<?php
/* @var $this PertanyaanController */
/* @var $model MitraPertanyaan */

$this->breadcrumbs=array(
	'Mitra Pertanyaans'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MitraPertanyaan', 'url'=>array('index')),
	array('label'=>'Create MitraPertanyaan', 'url'=>array('create')),
	array('label'=>'Update MitraPertanyaan', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MitraPertanyaan', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MitraPertanyaan', 'url'=>array('admin')),
);
?>

<h1>View MitraPertanyaan #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'pertanyaan',
		'description',
		'teruntuk',
		'created_time',
		'created_by',
		'updated_time',
		'updated_by',
	),
)); ?>
