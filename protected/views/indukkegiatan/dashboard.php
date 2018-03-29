<div class="box box-info">
	<div class="mailbox-controls">
		<b>Kelola Komponen Anggaran</b>
		<div class="pull-right">
			<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah Kompnonen Anggaran", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
		</div>
	</div>

	<div class="box-body">

		<div class="box box-solid bg-blue">
			<div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Filter Data</h3>
            </div>

            <div class="box-footer text-black no-border">
				<?php $this->renderPartial('_search',array(
					'model'=>$model,
				)); ?>
			</div>
		</div>
		
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
					'name'	=>'output_id',
					'type'=>'raw',
					'value'		=> function($data){ 
						if($data->output_id == null || $data->output_id==0){
							return '';
						}
						else{
							return $data->output->name; 
						}
					},
				),
				array(
					'name'	=>'unit_kerja_id',
					'type'=>'raw',
					'value'		=> function($data){ 
						if($data->unit_kerja_id == null || $data->unit_kerja_id==0){
							return '';
						}
						else{
							return $data->unitKerja->name; 
						}
					},
				),
				array(
                    'header'	=>'',
                    'type'		=>'raw',
                    'cssClassExpression' => '"center uline"',
                    'value'		=> function($data){ return CHtml::link("Input Progress",array("indukkegiatan/progress","id"=>$data->id),array('class'=>'btn btn-sm btn-flat btn-default')); },
				),
				// array(
                //     'header'	=>'',
                //     'type'		=>'raw',
                //     'cssClassExpression' => '"center uline"',
                //     'value'		=> function($data){ return CHtml::link("Progress Per Jenis",array("indukkegiatan/progress_j","id"=>$data->id),array('class'=>'btn btn-sm btn-flat btn-default')); },
                // ),
			),
		)); ?>
	</div>
</div>