<div class="box-body">
	<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'POST',
	)); ?>

		<div class="form-group">
			<?php echo $form->labelEx($model,'induk_id'); ?>
			<?php 
				echo $form->dropDownList($model,'induk_id',
						CHtml::listData(IndukKegiatan::model()->findAll(), 'id', 'name'),
						array('empty'=>'- Pilih Induk Kegiatan-', 'class'=>"form-control")); 
			?>
			<?php echo $form->error($model,'induk_id'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'nama'); ?>
			<?php echo $form->textField($model,'nama',array('size'=>60,'maxlength'=>255, 'class'=>"form-control")); ?>
			<?php echo $form->error($model,'nama'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'kab_id'); ?>
			<?php 
				echo $form->dropDownList($model,'kab_id',
						HelpMe::ListAuthorizeUnitKerja(),
						array('empty'=>'- Pilih Kabupaten/Kota-', 'class'=>"form-control")); 
			?>
			<?php echo $form->error($model,'kab_id'); ?>
		</div>

		<div class="box-footer">
			<?php echo CHtml::submitButton('Search', array('class'=>"btn btn-info pull-right")); ?>
		</div>
		<?php $this->endWidget(); ?>
	
	</div>
</div>
	