<?php
/* @var $this MitrabpsController */
/* @var $model MitraBps */

$this->breadcrumbs=array(
	'Mitra Bps'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MitraBps', 'url'=>array('index')),
	array('label'=>'Manage MitraBps', 'url'=>array('admin')),
);
?>

<h1>Create MitraBps</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>