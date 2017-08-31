<?php
/* @var $this AnggaranController */
/* @var $model Anggaran */

$this->breadcrumbs=array(
	'Anggarans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Anggaran', 'url'=>array('index')),
	array('label'=>'Manage Anggaran', 'url'=>array('admin')),
);
?>

<h1>Create Anggaran</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>