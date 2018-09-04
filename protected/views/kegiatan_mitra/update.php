
	<div class="box box-info">
		<div class="mailbox-controls">
			<b>Update Kegiatan <?php echo $model->nama; ?></b>
			<div class="pull-right">
				<?php echo CHtml::link("<i class='fa fa-list'></i> Daftar Kegiatan Mitra BPS", array('index'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
				<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah Kegiatan Mitra BPS", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
			</div>
			<!-- /.pull-right -->
		</div>

		<div class="box-body">
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
	</div>