<?php
/* @var $this PaguController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pagus',
);

$this->menu=array(
	array('label'=>'Create Pagu', 'url'=>array('create')),
	array('label'=>'Manage Pagu', 'url'=>array('admin')),
);
?>

<h1>Pagus</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
