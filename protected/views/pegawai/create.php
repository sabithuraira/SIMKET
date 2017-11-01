<?php
/* @var $this PegawaiController */
/* @var $model Pegawai */

$this->breadcrumbs=array(
	'Pegawais'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pegawai', 'url'=>array('index')),
);
?>

<h1>Create Pegawai</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>