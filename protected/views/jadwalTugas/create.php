<?php
/* @var $this JadwalTugasController */
/* @var $model JadwalTugas */

$this->breadcrumbs=array(
	'Jadwal Tugases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JadwalTugas', 'url'=>array('index')),
	array('label'=>'Manage JadwalTugas', 'url'=>array('admin')),
);
?>

<h1>Create JadwalTugas</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>