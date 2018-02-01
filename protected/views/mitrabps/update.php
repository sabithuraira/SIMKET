<?php
/* @var $this MitrabpsController */
/* @var $model MitraBps */

$this->breadcrumbs=array(
	'Mitra Bps'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MitraBps', 'url'=>array('index')),
	array('label'=>'Create MitraBps', 'url'=>array('create')),
	array('label'=>'View MitraBps', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MitraBps', 'url'=>array('admin')),
);
?>

<h1>Update MitraBps <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>