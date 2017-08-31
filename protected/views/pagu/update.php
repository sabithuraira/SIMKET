<?php
/* @var $this PaguController */
/* @var $model Pagu */

$this->breadcrumbs=array(
	'Pagus'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pagu', 'url'=>array('index')),
	array('label'=>'View Pagu', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Update Pagu</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>