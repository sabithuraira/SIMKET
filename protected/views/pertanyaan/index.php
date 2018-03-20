<?php
/* @var $this PertanyaanController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mitra Pertanyaans',
);

$this->menu=array(
	array('label'=>'Create MitraPertanyaan', 'url'=>array('create')),
	array('label'=>'Manage MitraPertanyaan', 'url'=>array('admin')),
);
?>

<h1>Mitra Pertanyaans</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
