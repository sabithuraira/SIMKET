<?php
/* @var $this AnggaranController */
/* @var $model Anggaran */

$this->breadcrumbs=array(
	'Anggarans'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Anggaran', 'url'=>array('index')),
	array('label'=>'Create Anggaran', 'url'=>array('create')),
	array('label'=>'View Anggaran', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Anggaran', 'url'=>array('admin')),
);
?>

<h1>Update Anggaran <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>