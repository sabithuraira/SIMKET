<?php
/* @var $this IndukkegiatanController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Induk Kegiatans',
);

$this->menu=array(
	array('label'=>'Create IndukKegiatan', 'url'=>array('create')),
	array('label'=>'Manage IndukKegiatan', 'url'=>array('admin')),
);
?>

<h1>Induk Kegiatans</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
