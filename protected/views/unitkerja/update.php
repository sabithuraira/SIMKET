<?php
/* @var $this UnitkerjaController */
/* @var $model UnitKerja */

$this->breadcrumbs=array(
	'Unit Kerja'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Unit Kerja', 'url'=>array('index')),
	array('label'=>'Create Unit Kerja', 'url'=>array('create')),
	array('label'=>'View Unit Kerja', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Unit Kerja', 'url'=>array('admin')),
);
?>

<h1>Update Unit Kerja <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>