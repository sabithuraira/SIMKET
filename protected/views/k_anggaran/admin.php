<?php
/* @var $this K_anggaranController */
/* @var $model KegiatanForAnggaran */

$this->breadcrumbs=array(
	'Kegiatan For Anggarans'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List KegiatanForAnggaran', 'url'=>array('index')),
	array('label'=>'Create KegiatanForAnggaran', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#kegiatan-for-anggaran-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Kegiatan For Anggarans</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'kegiatan-for-anggaran-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'id_induk',
		'tahun',
		'jenis',
		'keterangan',
		'created_by',
		/*
		'created_time',
		'updated_by',
		'updated_time',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
