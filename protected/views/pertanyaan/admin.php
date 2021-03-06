<div class="box box-info">
	<div class="mailbox-controls">
		<b>Pertanyaan</b>

		<?php if(Yii::app()->user->getLevel()<=2){ ?>

			<div class="pull-right">
				<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah Pertanyaan", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
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
			array(
				'name'	=>'teruntuk',
				'type'	=>'raw',	
				'value'		=> function($data){ return $data->fullContent; },
			),
			array(
				'name'	=>'description',
				'type'	=>'raw',	
				'value'	=> function($data){ return $data->description; },
			),
			array(
				'name'	=>'teruntuk',
				'type'	=>'raw',	
				'value'		=> function($data){ return $data->teruntuk==1 ? "PML" : "PCL"; },
			),
			array(
				'class'=>'CButtonColumn',
				'template' => '{view} {update} {delete}',
				'htmlOptions' => array('width' => 20),
				'buttons'=>array(
					'update'=>array(
						'url'=>function($data){
								return Yii::app()->createUrl("pertanyaan/update", array("id"=>$data->id));
						},
					),
					'view'=>array(
							'url'=>function($data){
								return Yii::app()->createUrl("pertanyaan/view", array("id"=>$data->id));
						},
					),
					'delete'=>array(
						'url'=>function($data){
								return Yii::app()->createUrl("pertanyaan/view", array("id"=>$data->id));
						},
						'label'=>'Hapus',
					),
				),
			),
		),
	)); ?>
	
	</div>
</div>