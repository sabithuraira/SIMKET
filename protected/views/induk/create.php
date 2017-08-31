<?php
/* @var $this IndukController */
/* @var $model MInduk */

$this->breadcrumbs=array(
	'Induk'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Induk', 'url'=>array('index')),
);
?>

<h1>Create Induk</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>