<?php
/* @var $this PsatkerController */
/* @var $model PaguSatker */

$this->breadcrumbs=array(
	'Pagu Satkers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PaguSatker', 'url'=>array('index')),
	array('label'=>'Manage PaguSatker', 'url'=>array('admin')),
);
?>

<h1>Create PaguSatker</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>