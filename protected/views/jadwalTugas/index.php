<?php
/* @var $this JadwalTugasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Jadwal Tugases',
);

$this->menu=array(
	array('label'=>'Create JadwalTugas', 'url'=>array('create')),
	array('label'=>'Manage JadwalTugas', 'url'=>array('admin')),
);
?>

<h1>Jadwal Tugases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
