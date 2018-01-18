<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
              <span class="box-title"><?php echo $model->kegiatan; ?></span>
				<div class="pull-right">
					<?php 
						echo CHtml::link("<i class='fa fa-list'></i> Daftar Kegiatan", array('index'), array('class'=>'btn btn-default btn-sm toggle-event'));
						echo CHtml::link("<i class='fa fa-plus'></i> Tambah", array('create'), array('class'=>'btn btn-default btn-sm toggle-event'));
						echo CHtml::link("<i class='fa fa-pencil'></i> Perbaharui", array('update', 'id'=>$model->id), array('class'=>'btn btn-default btn-sm toggle-event'));
						echo CHtml::link("<i class='fa fa-trash'></i> Hapus", "#", array("submit"=>array('delete', 'id'=>$model->id), 'confirm' => 'Anda yakin ingin menghapus data ini?', 'class'=>'btn btn-default btn-sm toggle-event'));
					?>
				</div>
			</div>
            
            <div class="box-body">
				<h1>Detail Kegiatan</h1>
				<?php $this->widget('zii.widgets.CDetailView', array(
					'data'=>$model,
					'attributes'=>array(
						'kegiatan',
						'unit_kerja',
						'start_date',
						'end_date',
						'created_time',
						'created_by',
						'updated_time',
						'updated_by',
					),
				)); ?>
			</div>
        </div>
    </div>
</div>
