<?php
/* @var $this IndukController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Minduks',
);

$this->menu=array(
	array('label'=>'Create MInduk', 'url'=>array('create')),
	array('label'=>'Manage MInduk', 'url'=>array('admin')),
);
?>

<h1>Minduks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
