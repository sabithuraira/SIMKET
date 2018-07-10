<div class="box box-info">
	<div class="mailbox-controls">
		Pegawai
		<div class="pull-right">
			<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah Pegawai", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
		</div>
	</div>
		  
	<?php
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


	<div class="box-body">
		<?php $this->renderPartial('_search',array(
			'model'=>$model
		)); ?>
		<?php $baseUrl = Yii::app()->theme->baseUrl; ?>

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
				// 'nip',
				// 'nama',
				array(
					'header'	=>'Pegawai',
					'type'=>'raw',
					'value'		=> function($data){ return '<div class="user-block">
						<div class="pull-right">
							<a href="'.Yii::app()->createUrl("pegawai/update", array("id"=>$data->nip)).'" class="btn"><i class="fa fa-edit"></i></a>
						</div>

						<img class="img-circle" src="'.$data->fotoImage.'" alt="User Image">
						<span class="comment">'.$data->jabatan.' - '.$data->unitKerja->name.'</span>
						<span class="username"><a href="'.Yii::app()->createUrl("pegawai/view", array("id"=>$data->nip)).'">'.$data->nama.'</a></span>
						<span class="description">'.$data->nip.'</span>
					  </div>
					  '; },
					// 'filter' => CHtml::listData(UnitKerja::model()->findAll(), 'id', 'name')
				),
				// 'golongan',
				// 'jabatan',
				// 'created_time',
				/*
				'updated_time',
				*/
				// array(
				// 	'header'	=>'',
				// 	'type' 	=>'raw',
				// 	'value'		=> function($data){ return "[".CHtml::link("Update",array("update","id"=>$data->nip))."] [".CHtml::link("Delete",array("delete","id"=>$data->nip))."]"; },
				// ),
				// array(
				// 	'class'=>'CButtonColumn',
				// 	'template' => '{update} {delete}',
				// 	'htmlOptions' => array('width' => 20),
				// 	'buttons'=>array(
				// 		'update'=>array(
				// 			'url'=>function($data){
				// 				return Yii::app()->createUrl("pegawai/update", array("id"=>$data->nip));
				// 			},
				// 		),
				// 		'delete'=>array(
				// 			'url'=>function($data){
				// 				return Yii::app()->createUrl("pegawai/delete", array("id"=>$data->nip));
				// 			},
				// 			'label'=>'Hapus',
				// 		),
				// 	),
				// ),
			),
		)); ?>
	</div>
</div>
