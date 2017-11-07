<?php
/* @var $this JadwalTugasController */
/* @var $model JadwalTugas */

$this->breadcrumbs=array(
	'Jadwal Tugases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List JadwalTugas', 'url'=>array('index')),
	array('label'=>'Create JadwalTugas', 'url'=>array('create')),
	array('label'=>'View JadwalTugas', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage JadwalTugas', 'url'=>array('admin')),
);
?>

<h1>Update JadwalTugas <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>