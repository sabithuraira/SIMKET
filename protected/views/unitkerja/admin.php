<?php
/* @var $this UnitkerjaController */
/* @var $model UnitKerja */

$this->breadcrumbs=array(
	'Unit Kerja'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UnitK erja', 'url'=>array('index')),
	array('label'=>'Create Unit Kerja', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#unit-kerja-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Unit Kerja</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'unit-kerja-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	
'summaryText'=>Yii::t('penerjemah','Menampilkan {start}-{end} dari {count} hasil'),
				            'pager'=>array(
				                'header'=>Yii::t('penerjemah','Ke halaman : '),
				                'prevPageLabel'=>Yii::t('penerjemah','Sebelumnya'),
				                'nextPageLabel'=>Yii::t('penerjemah','Selanjutnya'),
				                'firstPageLabel'=>Yii::t('penerjemah','Pertama'),
				                'lastPageLabel'=>Yii::t('penerjemah','Terakhir'),
				                ),
	'columns'=>array(
		'id',
		'code',
		'name',
		'parent',
		'created_by',
		'created_time',
		/*
		'updated_by',
		'updated_time',
		'jenis',
		*/
		
		array(
			'header'	=>'',
			'type'		=>'raw',
			'value'		=> function($data){ return CHtml::link("Update",array("unitkerja/update","id"=>$data->id)); }
		),
	),
)); ?>
