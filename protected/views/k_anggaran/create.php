<?php
/* @var $this K_anggaranController */
/* @var $model KegiatanForAnggaran */

$this->breadcrumbs=array(
	'Kegiatan For Anggarans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List KegiatanForAnggaran', 'url'=>array('index')),
	array('label'=>'Manage KegiatanForAnggaran', 'url'=>array('admin')),
);
?>

<h1>Create KegiatanForAnggaran</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>