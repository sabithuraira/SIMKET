<div class="box-body">
	<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'POST',
	)); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nama'); ?>
		<?php echo $form->textField($model,'nama',array('size'=>60,'maxlength'=>255, 'class'=>"form-control")); ?>
	</div>


	<div class="form-group">
		<?php echo $form->labelEx($model,'kab_id'); ?>
		<?php echo $form->dropDownList($model,'kab_id',
				CHtml::listData(UnitKerja::model()->findAllByAttributes(array('jenis'=>2)), 'id', 'name'),
				array('empty'=>'- Pilih Kabupaten -', 'class'=>"form-control")); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nomor_telepon'); ?>
		<?php echo $form->textField($model,'nomor_telepon',array('size'=>15,'maxlength'=>15, 'class'=>"form-control")); ?>
	</div>

	<div class="box-footer">
		<?php echo CHtml::submitButton('Search', array('class'=>"btn btn-info pull-right")); ?>
	</div>

	<?php $this->endWidget(); ?>

	</div>
</div>
