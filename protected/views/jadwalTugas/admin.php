<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#jadwal-tugas-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="box box-info">
	<div class="mailbox-controls">
		<b>Kelola Jadwal Tugas</b>
		<div class="pull-right">
			<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah Jadwal Tugas", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
		</div>
		<!-- /.pull-right -->
	</div>

	<div class="box-body">
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'jadwal-tugas-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
				// 'id',
				'nama_kegiatan',
				'tanggal_mulai',
				'tanggal_berakhir',
				'pegawai_id',
				'penjelasan',
				/*
				'created_time',
				'updated_time',
				'created_by',
				'updated_by',
				*/
				array(
					'class'=>'CButtonColumn',
				),
			),
		)); ?>
	</div>
</div>
