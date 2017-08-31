<?php
/* @var $this UnitkerjaController */
/* @var $model UnitKerja */

$this->breadcrumbs=array(
	'Unit Kerja'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Unit Kerja', 'url'=>array('index')),
	array('label'=>'Manage Unit Kerja', 'url'=>array('admin')),
);
?>

<h1>Tambah Unit Kerja</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>