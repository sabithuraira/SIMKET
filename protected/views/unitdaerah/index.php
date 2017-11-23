<?php
/* @var $this UnitdaerahController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Unit Kerja Daerahs',
);

$this->menu=array(
	array('label'=>'Create UnitKerjaDaerah', 'url'=>array('create')),
	array('label'=>'Manage UnitKerjaDaerah', 'url'=>array('admin')),
);
?>

<h1>Unit Kerja Daerahs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
