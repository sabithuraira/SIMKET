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

			'summaryText'=>Yii::t('penerjemah','Menampilkan {start}-{end} dari {count} hasil'),
			'pager'=>array(
				'header'=>Yii::t('penerjemah','Ke halaman : '),
				'prevPageLabel'=>Yii::t('penerjemah','Sebelumnya'),
				'nextPageLabel'=>Yii::t('penerjemah','Selanjutnya'),
				'firstPageLabel'=>Yii::t('penerjemah','Pertama'),
				'lastPageLabel'=>Yii::t('penerjemah','Terakhir'),
			),
			
			'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
			//'filter'=>$model,
			'columns'=>array(
				// 'id',
				'nama_kegiatan',
				array(
					'name' 		=>'Tanggal',
					'type'		=>'raw',
					'value'		=> function($data){ return $data->tanggal_mulai." sd ".$data->tanggal_berakhir; },
				),
				// 'tanggal_mulai',
				// 'tanggal_berakhir',
				array(
					'name' 	=>'pegawai_id',
					'type'		=>'raw',
					'value'		=> function($data){ return $data->pegawai_id." - ".$data->pegawai->nama; },
				),
				array(
					'name'	=>'Cetak',
					'type' 	=>'raw',

					'value'		=> function($data){ return "[".CHtml::link("Surat Tugas",array("review","id"=>$data->id))."]"; },
				),
				// 'penjelasan',
				/*
				'created_time',
				'updated_time',
				'created_by',
				'updated_by',
				*/

				array(
					'class'=>'CButtonColumn',
					'template' => '{view} {update} {delete}',
					'htmlOptions' => array('width' => 20),
					'buttons'=>array(
						'update'=>array(
							'url'=>function($data){
								return Yii::app()->createUrl("jadwalTugas/update", array("id"=>$data->id));
							},
						),
						'view'=>array(
							'url'=>function($data){
								return Yii::app()->createUrl("jadwalTugas/view", array("id"=>$data->id));
							},
						),
						'delete'=>array(
							'url'=>function($data){
								return Yii::app()->createUrl("jadwalTugas/delete", array("id"=>$data->id));
							},
							'label'=>'Hapus',
						),
					),
				),
			),
		)); ?>
	</div>
</div>
