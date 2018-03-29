<div class="box box-info">
	<div class="mailbox-controls">
		<b>Kelola Output</b>
		<div class="pull-right">
			<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah Output", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
		</div>
	</div>

	<div class="box-body">
		<?php $this->renderPartial('_search',array(
			'model'=>$model,
		)); ?>

		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'induk-kegiatan-grid',
			'dataProvider'=>$model->search(),
			// 'filter'=>$model,
			'summaryText'=>Yii::t('penerjemah','Menampilkan {start}-{end} dari {count} hasil'),
			'pager'=>array(
				'header'=>Yii::t('penerjemah','Ke halaman : '),
				'prevPageLabel'=>Yii::t('penerjemah','Sebelumnya'),
				'nextPageLabel'=>Yii::t('penerjemah','Selanjutnya'),
				'firstPageLabel'=>Yii::t('penerjemah','Pertama'),
				'lastPageLabel'=>Yii::t('penerjemah','Terakhir'),
			),
			'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
			'columns'=>array(
				'name',
				'tahun',
				array(
					'class'=>'CButtonColumn',
					'template' => '{update}',
					'htmlOptions' => array('width' => 20, 'class'=>'text-center'),
					'buttons'=>array(
						'update'=>array(
							'url'=>function($data){
									return Yii::app()->createUrl("output/update", array("id"=>$data->id));
							},
						),
						// 'view'=>array(
						// 		'url'=>function($data){
						// 			return Yii::app()->createUrl("output/view", array("id"=>$data->id));
						// 	},
						// ),
						// 'delete'=>array(
						// 	'url'=>function($data){
						// 			return Yii::app()->createUrl("output/delete", array("id"=>$data->id));
						// 	},
						// 	'label'=>'Hapus',
						// ),
					),
				),
			),
		)); ?>
	</div>
</div>