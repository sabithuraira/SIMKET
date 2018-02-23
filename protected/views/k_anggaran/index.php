<?php
/* @var $this K_anggaranController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Kegiatan For Anggarans',
);

$this->menu=array(
	array('label'=>'Create KegiatanForAnggaran', 'url'=>array('create')),
	array('label'=>'Manage KegiatanForAnggaran', 'url'=>array('admin')),
);
?>

<h1>Kegiatan For Anggarans</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
