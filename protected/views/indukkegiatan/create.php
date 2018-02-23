<?php
/* @var $this IndukkegiatanController */
/* @var $model IndukKegiatan */

$this->breadcrumbs=array(
	'Induk Kegiatans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List IndukKegiatan', 'url'=>array('index')),
	array('label'=>'Manage IndukKegiatan', 'url'=>array('admin')),
);
?>

<h1>Create IndukKegiatan</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>