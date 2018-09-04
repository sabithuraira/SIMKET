<div class="box box-info">
	<?php if(Yii::app()->user->getLevel()>1 && Yii::app()->user->getUnitKerja()!=$model->kab_id){ ?>
	<div class="alert alert-danger alert-dismissible">
              <h4><i class="icon fa fa-ban"></i> Error!</h4>Anda tidak berhak memperbaharui data ini</div>
	<?php
		}
		else{
	?>
		<div class="mailbox-controls">
			<b>Update Mitra BPS <?php echo $model->nama; ?></b>
			<div class="pull-right">
				<?php echo CHtml::link("<i class='fa fa-list'></i> Daftar Mitra", array('index'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
				<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
				<?php echo CHtml::link("<i class='fa fa-search'></i> Detail", array('view', "id"=>$model->id), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
			</div>
		</div>

		<div class="box-body">
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
	<?php } ?>
</div>