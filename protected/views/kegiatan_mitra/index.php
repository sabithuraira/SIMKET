<?php
/* @var $this Kegiatan_mitraController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Kegiatan Mitras',
);

$this->menu=array(
	array('label'=>'Create KegiatanMitra', 'url'=>array('create')),
	array('label'=>'Manage KegiatanMitra', 'url'=>array('admin')),
);
?>

<h1>Kegiatan Mitras</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
