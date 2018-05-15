<div class="box box-info">
	<div class="mailbox-controls">
		Mitra BPS
	</div>
		 
	
	<div class="box-body">
		<?php $this->renderPartial('_search',array(
			'model'=>$model
		)); ?>

		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'mitra-bps-grid',
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
				array(
					'name'	=>'',
					'type'	=>'raw',
					'cssClassExpression' => '"bps" . $data->nilaiAndJumlah["jumlah"]',
				),
				'nama',
				array(
					'name'	=>'kab_id',
					'type'=>'raw',
					'value'		=> function($data){ return $data->kabupaten->name; },
					// 'filter' => CHtml::listData(UnitKerja::model()->findAllByAttributes(array('jenis'=>2)), 'id', 'name')
				),
				array(
					'header'	=>'Jumlah Kegiatan',
					'type'=>'raw',
					'value'		=> function($data){ return $data->nilaiAndJumlah['jumlah']; },
				),
				array(
					'header'	=>'Rata Nilai',
					'type'=>'raw',
					'value'		=> function($data){ return round($data->nilaiAndJumlah['rata'],3)." (".$data->nilaiAndJumlah['labelRata'].")"; },
				),
				array(
					'type'		=>'raw',
					'value'		=> function($data){ return CHtml::link('Detail', array('detail','id'=>$data->id)); },
				),
			),
		)); ?>
	</div>
</div>
