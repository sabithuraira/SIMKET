<div class="box box-info">
	<div class="mailbox-controls">
		<b>Kegiatan Mitra BPS</b>

		<?php if(Yii::app()->user->getLevel()<=2){ ?>

			<div class="pull-right">
				<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah Kegiatan", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
			</div>

		<?php } ?>
	</div>
		
	<div class="box-body">
		<?php $this->renderPartial('_search',array(
			'model'=>$model
		)); ?>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'kegiatan-mitra-grid',
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
		'columns'=>array(
			// array(
			// 	'name'		=>'induk_id',
			// 	'type'		=>'raw',
			// 	'value'		=> function($data){ return $data->induk->name; },
			// ),
			'nama',
			// array(
			// 	'name'		=>'simket_id',
			// 	'type'		=>'raw',
			// 	'value'		=> function($data){ return $data->simket_id!=null ? $data->simket->name : ""; },
			// ),
			array(
				'name'		=>'kab_id',
				'type'		=>'raw',
				'value'		=> function($data){ return $data->kab_id!=null ? $data->kab->name : ""; },
			),
			array(
				'class'=>'CButtonColumn',
				'template' => '{view} {update} {delete}',
				'htmlOptions' => array('width' => 20),
				'buttons'=>array(
					'update'=>array(
						'url'=>function($data){
								return Yii::app()->createUrl("kegiatan_mitra/update", array("id"=>$data->id));
						},
					),
					'view'=>array(
							'url'=>function($data){
								return Yii::app()->createUrl("kegiatan_mitra/view", array("id"=>$data->id));
						},
					),
					'delete'=>array(
						'url'=>function($data){
								return Yii::app()->createUrl("kegiatan_mitra/view", array("id"=>$data->id));
						},
						'label'=>'Hapus',
					),
				),
			),
		),
	)); ?>
	
	</div>
</div>
