<?php
/* @var $this PegawaiController */
/* @var $model Pegawai */

$this->breadcrumbs=array(
	'Pegawais'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pegawai-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>





<div class="box box-info">
	<div class="mailbox-controls">
		Pegawai
		<div class="pull-right">
			<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah Pegawai", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
		</div>
		<!-- /.pull-right -->
	</div>
		  
	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'pegawai-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			'nip',
			'nama',
			'unit_kerja',
			'golongan',
			'jabatan',
			// 'created_time',
			/*
			'updated_time',
			*/
			array(
				'class'=>'CButtonColumn',
			),
		),
	)); ?>
</div>
