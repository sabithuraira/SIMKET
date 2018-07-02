<div class="box-body">
	<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'GET',
	)); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nama'); ?>
		<?php echo $form->textField($model,'nama',array('size'=>60,'maxlength'=>255, 'class'=>"form-control")); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'unit_kerja'); ?>
		<?php echo $form->dropDownList($model,'unit_kerja', HelpMe::getKabKotaList(),array('class'=>"form-control", 'empty'=>'- Semua Kabupaten/Kota -')); ?>
	</div>


	<div class="box-footer">
		<?php echo CHtml::submitButton('Search', array('class'=>"btn btn-info pull-right")); ?>
	</div>

	<?php $this->endWidget(); ?>

	</div>
</div>
