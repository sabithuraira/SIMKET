<?php
/* @var $this IndukkegiatanController */
/* @var $model IndukKegiatan */

$this->breadcrumbs=array(
	'Induk Kegiatans'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List IndukKegiatan', 'url'=>array('index')),
	array('label'=>'Create IndukKegiatan', 'url'=>array('create')),
	array('label'=>'Update IndukKegiatan', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete IndukKegiatan', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage IndukKegiatan', 'url'=>array('admin')),
);
?>

<h1>View IndukKegiatan #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'created_by',
		'created_time',
		'updated_by',
		'updated_time',
	),
)); ?>
