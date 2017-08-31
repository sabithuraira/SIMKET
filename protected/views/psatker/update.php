<?php
/* @var $this PsatkerController */
/* @var $model PaguSatker */

$this->breadcrumbs=array(
	'Pagu Satkers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PaguSatker', 'url'=>array('index')),
	array('label'=>'Create PaguSatker', 'url'=>array('create')),
	array('label'=>'View PaguSatker', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PaguSatker', 'url'=>array('admin')),
);
?>

<h1>Update PaguSatker <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>