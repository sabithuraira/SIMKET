<?php
/* @var $this IndukController */
/* @var $model MInduk */

$this->breadcrumbs=array(
	'Minduks'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MInduk', 'url'=>array('index')),
	array('label'=>'Create MInduk', 'url'=>array('create')),
	array('label'=>'View MInduk', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MInduk', 'url'=>array('admin')),
);
?>

<h1>Update MInduk <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>