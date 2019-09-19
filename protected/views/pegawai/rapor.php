<div class="box box-info">
	<div class="mailbox-controls">
		Rapor Pegawai
	</div>


	<div class="box-body">
		<?php $this->renderPartial('_search',array(
			'model'=>$model
		)); ?>
		

		<?php 
			$arrayClass = array("1" => "bps1", "2" => "bps2", "3" => "bps3", "4" => "bps4");
		
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'pegawai-grid',
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
			'rowCssClassExpression'=> '"bps".$data->nilaiAndJumlah["strata"]',
			// 'filter'=>$model,
			'columns'=>array(
				// array(
				// 	'name'	=>'',
				// 	'type'	=>'raw',
				// 	// 'value'	=> function($data){ return '<div class="bps'.$data->nilaiAndJumlah["strata"].'"></div>'; },
				// 	// 'cssClassExpression' => '$arrayClass[$data->nilaiAndJumlah["strata"]]',
				// 	'cssClassExpression' => function($data){ return 'color'; } ,
				// ),
				array(
					'header'	=>'Pegawai',
					'type'=>'raw',
					'value'		=> function($data){ return '<div class="user-block">
						<div class="pull-right">
							<span class="username">Mengikuti '.$data->total_menjadi_mitra.' kegiatan, nilai: '.round($data->nilai_menjadi_mitra,2).' ('.$data->predikatLabel.')</span>
							
						</div>

						<img class="img-circle" src="'.$data->fotoImage.'" alt="User Image">
						<span class="comment">'.$data->jabatan.' - '.$data->unitKerja->name.'</span>
						<span class="username"><a href="'.Yii::app()->createUrl("pegawai/view", array("id"=>$data->nip)).'">'.$data->nama.'</a></span>
						<span class="username">'.(($data->is_active==1) ? "  <small class='label bg-green'>AKTIF</small>  "  : "  <small class='label bg-gray'>TIDAK AKTIF</small>  ").'</span>
						<span class="description">'.$data->nip.'</span>
					  </div>
					  '; },
					// 'filter' => CHtml::listData(UnitKerja::model()->findAll(), 'id', 'name')
				),
				// 'nip',
				// 'nama',
				// array(
				// 	'name'	=>'unit_kerja',
				// 	'type'=>'raw',
				// 	'value'		=> function($data){ return $data->unitKerja->name; },
				// ),
				// array(
				// 	'header'	=>'Jumlah Kegiatan',
				// 	'type'=>'raw',
				// 	'value'		=> function($data){ return $data->nilaiAndJumlah['jumlah']; },
				// ),
				// array(
				// 	'header'	=>'Rata Nilai',
				// 	'type'=>'raw',
				// 	'value'		=> function($data){ return round($data->nilaiAndJumlah['rata'],3)." (".$data->nilaiAndJumlah['labelRata'].")"; },
				// ),
				// array(
				// 	'type'		=>'raw',
				// 	'value'		=> function($data){ return CHtml::link('Detail', array('detail','id'=>$data->nip)); },
				// ),
			),
		)); ?>
	</div>
</div>
