<?php
/* @var $this MitrabpsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mitra Bps',
);

$this->menu=array(
	array('label'=>'Create MitraBps', 'url'=>array('create')),
	array('label'=>'Manage MitraBps', 'url'=>array('admin')),
);
?>

<h1>Mitra Bps</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
