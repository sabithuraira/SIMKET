<?php
/* @var $this PaguController */
/* @var $model Pagu */

$this->breadcrumbs=array(
	'Pagus'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pagu', 'url'=>array('index')),
	array('label'=>'Manage Pagu', 'url'=>array('admin')),
);
?>

<h1>Create Pagu</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>