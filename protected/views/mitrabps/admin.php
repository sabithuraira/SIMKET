<div class="box box-info">
	<div class="mailbox-controls">
		Mitra BPS
		<div class="pull-right">
			<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah Mitra", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
		</div>
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
				'nama',
				array(
					'name'	=>'kab_id',
					'type'=>'raw',
					'value'		=> function($data){ return $data->kabupaten->name; },
					// 'filter' => CHtml::listData(UnitKerja::model()->findAllByAttributes(array('jenis'=>2)), 'id', 'name')
				),
				'nomor_telepon',
				'alamat',
				'tanggal_lahir',
				// 'jk',
				array(
					'name'	=>'jk',
					'type'=>'raw',
					'value'		=> function($data){ return $data->jk==1 ? "Laki-laki" : "Perempuan"; },
				),
				array(
					'class'=>'CButtonColumn',
					'template' => '{view} {update} {delete}',
					'htmlOptions' => array('width' => 20),
					'buttons'=>array(
						'update'=>array(
							'url'=>function($data){
								return Yii::app()->createUrl("mitrabps/update", array("id"=>$data->id));
							},
						),
						'view'=>array(
							'url'=>function($data){
								return Yii::app()->createUrl("mitrabps/view", array("id"=>$data->id));
							},
						),
						'delete'=>array(
							'url'=>function($data){
								return Yii::app()->createUrl("mitrabps/delete", array("id"=>$data->id));
							},
							'label'=>'Hapus',
						),
					),
				),
			),
		)); ?>
	</div>
</div>
