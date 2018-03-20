<?php
/* @var $this PertanyaanController */
/* @var $model MitraPertanyaan */

$this->breadcrumbs=array(
	'Mitra Pertanyaans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MitraPertanyaan', 'url'=>array('index')),
	array('label'=>'Manage MitraPertanyaan', 'url'=>array('admin')),
);
?>

<h1>Create MitraPertanyaan</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>