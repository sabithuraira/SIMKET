<div class="box box-info">
	<div class="mailbox-controls">
		Mitra HITAM
	</div>
		 
	<div class="box-body">
		<?php $this->renderPartial('_search',array(
			'model'=>$model
		)); ?>

		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'mitra-bps-grid',
			'dataProvider'=>$model->search(true),

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
					'value'		=> function($data){ 
						$ket_nilai = '<div class="pull-right">
							<span class="username">Mengikuti '.$data->total_menjadi_mitra.' kegiatan, nilai: '.round($data->nilai_menjadi_mitra,2).' ('.$data->predikatLabel.')</span>
						</div>';

						if(Yii::app()->user->name=='guess'){
							$ket_nilai = '<div class="pull-right">
								<span class="username">Mengikuti '.$data->total_menjadi_mitra.' kegiatan</span>
							</div>';
						}

						return '<div class="user-block"> 
						'.$ket_nilai.'
						<img class="img-circle" src="'.$data->fotoImage.'" alt="User Image">
						<span class="comment">'.$data->kabupaten->name.'</span>
						<span class="username"><a href="'.Yii::app()->createUrl("mitrabps/view", array("id"=>$data->id)).'">'.$data->nama.'</a></span>
						<span class="description">'.$jk = ($data->jk==1 ? "Laki-laki" : "Perempuan").', Alamat: '.$data->alamat.'</span>
					  </div>
					  '; },
					// 'filter' => CHtml::listData(UnitKerja::model()->findAll(), 'id', 'name')
				),
			),
		)); ?>
	</div>
</div>