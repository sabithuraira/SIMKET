<?php
/* @var $this K_anggaranController */
/* @var $model KegiatanForAnggaran */

$this->breadcrumbs=array(
	'Kegiatan For Anggarans'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List KegiatanForAnggaran', 'url'=>array('index')),
	array('label'=>'Create KegiatanForAnggaran', 'url'=>array('create')),
	array('label'=>'View KegiatanForAnggaran', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage KegiatanForAnggaran', 'url'=>array('admin')),
);
?>

<h1>Update KegiatanForAnggaran <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>