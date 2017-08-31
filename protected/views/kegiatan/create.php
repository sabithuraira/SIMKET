<?php
/* @var $this KegiatanController */
/* @var $model Kegiatan */

$this->breadcrumbs=array(
	'Kegiatan'=>array('index'),
	'Tambah',
);

$this->menu=array(
	array('label'=>'<i class="icon-th-list"></i>  List Kegiatan', 'url'=>array('index')),
);
?>

<h1>Tambah Kegiatan</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>