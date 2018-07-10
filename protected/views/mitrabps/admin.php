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
				array(
					'header'	=>'Mitra BPS',
					'type'=>'raw',
					'value'		=> function($data){ return '<div class="user-block">
						<div class="pull-right">
							<a href="'.Yii::app()->createUrl("mitrabps/update", array("id"=>$data->id)).'" class="btn"><i class="fa fa-edit"></i></a>
						</div>

						<img class="img-circle" src="'.$data->fotoImage.'" alt="User Image">
						<span class="comment">'.$data->kabupaten->name.'</span>
						<span class="username"><a href="'.Yii::app()->createUrl("mitrabps/view", array("id"=>$data->id)).'">'.$data->nama.'</a></span>
						<span class="description">'.$jk = ($data->jk==1 ? "Laki-laki" : "Perempuan").', Alamat: '.$data->alamat.'</span>
					  </div>
					  '; },
					// 'filter' => CHtml::listData(UnitKerja::model()->findAll(), 'id', 'name')
				),
				// 'nama',
				// array(
				// 	'name'	=>'kab_id',
				// 	'type'=>'raw',
				// 	'value'		=> function($data){ return $data->kabupaten->name; },
				// 	// 'filter' => CHtml::listData(UnitKerja::model()->findAllByAttributes(array('jenis'=>2)), 'id', 'name')
				// ),
				// 'nomor_telepon',
				// 'alamat',
				// 'tanggal_lahir',
				// // 'jk',
				// array(
				// 	'name'	=>'jk',
				// 	'type'=>'raw',
				// 	'value'		=> function($data){ return $data->jk==1 ? "Laki-laki" : "Perempuan"; },
				// ),
				// array(
				// 	'class'=>'CButtonColumn',
				// 	'template' => '{view} {update} {delete}',
				// 	'htmlOptions' => array('width' => 20),
				// 	'buttons'=>array(
				// 		'update'=>array(
				// 			'url'=>function($data){
				// 				return Yii::app()->createUrl("mitrabps/update", array("id"=>$data->id));
				// 			},
				// 		),
				// 		'view'=>array(
				// 			'url'=>function($data){
				// 				return Yii::app()->createUrl("mitrabps/view", array("id"=>$data->id));
				// 			},
				// 		),
				// 		'delete'=>array(
				// 			'url'=>function($data){
				// 				return Yii::app()->createUrl("mitrabps/delete", array("id"=>$data->id));
				// 			},
				// 			'label'=>'Hapus',
				// 		),
				// 	),
				// ),
			),
		)); ?>
	</div>
</div>
