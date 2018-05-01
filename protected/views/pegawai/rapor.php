<div class="box box-info">
	<div class="mailbox-controls">
		Rapor Pegawai
	</div>


	<div class="box-body">
		<?php $this->renderPartial('_search',array(
			'model'=>$model
		)); ?>

		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'pegawai-grid',
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
			
			// 'filter'=>$model,
			'columns'=>array(
				'nip',
				'nama',
				array(
					'name'	=>'unit_kerja',
					'type'=>'raw',
					'value'		=> function($data){ return $data->unitKerja->name; },
				),
				array(
					'header'	=>'Jumlah Kegiatan',
					'type'=>'raw',
					'value'		=> function($data){ return $data->nilaiAndJumlah['jumlah']; },
				),
				array(
					'header'	=>'Rata Nilai',
					'type'=>'raw',
					'value'		=> function($data){ return round($data->nilaiAndJumlah['rata'],3); },
				),
				array(
					'type'		=>'raw',
					'value'		=> function($data){ return CHtml::link('Detail', array('detail','id'=>$data->nip)); },
				),
			),
		)); ?>
	</div>
</div>
