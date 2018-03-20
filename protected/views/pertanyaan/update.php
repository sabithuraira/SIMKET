<?php
/* @var $this PertanyaanController */
/* @var $model MitraPertanyaan */

$this->breadcrumbs=array(
	'Mitra Pertanyaans'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MitraPertanyaan', 'url'=>array('index')),
	array('label'=>'Create MitraPertanyaan', 'url'=>array('create')),
	array('label'=>'View MitraPertanyaan', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MitraPertanyaan', 'url'=>array('admin')),
);
?>

<h1>Update MitraPertanyaan <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>