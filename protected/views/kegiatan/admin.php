<div class="alert alert-info">
  <strong>Ket :</strong> Tombol delete hanya ditampilkan untuk user yang memiliki hak
</div>

<div class="box box-info">
	<div class="mailbox-controls">
		<b>Kegiatan</b>

		<?php if(!HelpMe::isKabupaten()){ ?>

			<div class="pull-right">
				<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah Kegiatan", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
			</div>

		<?php } ?>
	</div>
		
	<div class="box-body">
		<?php $this->renderPartial('_search',array(
			'model'=>$model,
			'tahun'=>$tahun,
		)); ?>

		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'kegiatan-grid',
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
				//'id',
				'kegiatan',
				array(
					'name'		=>'unit_kerja',
												'type'=>'raw',
					'value'		=> function($data){ return $data->unitKerja->name; },
					//'$data->unitKerja->name',
					'filter'	=>CHtml::listData(UnitKerja::model()->findAllByAttributes(array('jenis'=>'1')),'id','name'),
				),
				array(
					'name'		=>'start_date',
					'type'      =>'raw',
					'value'		=> function($data){ return HelpMe::HrDate($data->start_date); },
		// 			'value'		=>'HelpMe::HrDate($data->start_date)',
					'filter'	=>'',
				),
				array(
					'name'		=>'end_date',
		// 			'value'		=>'HelpMe::HrDate($data->end_date)',
					'type'      =>'raw',
					'value'		=> function($data){ return HelpMe::HrDate($data->end_date); },
					'filter'	=>'',
				),
				//'created_time',
				/*
				'created_by',
				'updated_time',
				'updated_by',
				*/
				array(
					'header'	=>'Progress',
					'type'      =>'raw',
					'value'		=> function($data){ return $data->progressValue." %"; },
		// 			'value'		=>'$data->progressValue." %"',
				),
				array(
					'header'	=>'',
					'type'		=>'raw',
					'value'		=> function($data){ return CHtml::link("Progress",array("kegiatan/progress","id"=>$data->id)); },
		// 			'value'		=>'CHtml::link("Progress",array("kegiatan/progress","id"=>$data->id))',
				),
			array(
					'header'    =>'Delete',
					'type'      =>'raw',
					'value'		=> function($data){ return (HelpMe::isAuthorizeUnitKerja($data->unit_kerja)) ? CHtml::link( "Delete",array("kegiatan/delete","id"=>$data->id),array("confirm"=>"Anda yakin ingin menghapus kegiatan ini?")) : "Tidak berhak"; },
					// 'value'     =>'(HelpMe::isAuthorizeUnitKerja($data->unit_kerja)) ? CHtml::link( "Delete",array("kegiatan/delete","id"=>$data->id),array("confirm"=>"Anda yakin ingin menghapus kegiatan ini?")) : "Tidak berhak"', 
			),
				array(
					'class'=>'CButtonColumn',
					'template' => '{view} {update} {delete}',
					'htmlOptions' => array('width' => 20),
					// 'viewButtonImageUrl' => Yii::app()->baseUrl . '/css/gridViewStyle/images/' . 'gr-view.png',
					// 'updateButtonImageUrl' => Yii::app()->baseUrl . '/css/gridViewStyle/images/' . 'gr-update.png',
					// 'deleteButtonImageUrl' => Yii::app()->baseUrl . '/css/gridViewStyle/images/' . 'gr-delete.png',
					'buttons'=>array(
						'update'=>array(
							'url'=>function($data){
									return Yii::app()->createUrl("kegiatan/update", array("id"=>$data->id));
							},
						),
						'view'=>array(
								'url'=>function($data){
									return Yii::app()->createUrl("kegiatan/view", array("id"=>$data->id));
							},
						),
						'delete'=>array(
							'url'=>function($data){
									return Yii::app()->createUrl("kegiatan/view", array("id"=>$data->id));
							},
							// 'visible'=>function ($row, $data){
							// 		return $data->judul_ind == NULL AND $data->judul_eng == NULL;
							// },
							'label'=>'Hapus',
						),
					),
				),
			),
		)); ?>
	
	</div>
</div>