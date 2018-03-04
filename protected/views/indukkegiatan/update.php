<div class="box box-info">
	<div class="mailbox-controls">
		<b>Update Komponen</b>
		<div class="pull-right">
			<?php echo CHtml::link("<i class='fa fa-list'></i> Daftar Komponen", array('index'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
			<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
			<?php echo CHtml::link("<i class='fa fa-search'></i> Detail", array('view', "id"=>$model->id), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
		</div>
	</div>

	<div class="box-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>