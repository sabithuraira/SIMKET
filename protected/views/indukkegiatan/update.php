<?php
/* @var $this IndukkegiatanController */
/* @var $model IndukKegiatan */

$this->breadcrumbs=array(
	'Induk Kegiatans'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List IndukKegiatan', 'url'=>array('index')),
	array('label'=>'Create IndukKegiatan', 'url'=>array('create')),
	array('label'=>'View IndukKegiatan', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage IndukKegiatan', 'url'=>array('admin')),
);
?>

<h1>Update IndukKegiatan <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>