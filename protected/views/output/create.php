<div class="box box-info">
	<div class="mailbox-controls">
		<b>Tambah Output</b>
		<div class="pull-right">
			<?php echo CHtml::link("<i class='fa fa-list'></i> Daftar Output", array('index'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
		</div>
	</div>

	<div class="box-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>