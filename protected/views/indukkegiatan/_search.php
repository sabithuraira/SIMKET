<div class="box-body">
	<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'POST',
	)); ?>

		<div class="form-group">
			<?php echo $form->labelEx($model,'name'); ?>
			<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45, 'class'=>"form-control")); ?>
		</div>



		<div class="form-group">
			<?php echo $form->labelEx($model,'tahun'); ?>
			<?php echo $form->dropDownList($model,'tahun',
					HelpMe::getYearForFilter(),
					array('empty'=>'- Pilih Tahun -', 'class'=>"form-control")); ?>
		</div>

		<div class="box-footer">
			<?php echo CHtml::submitButton('Search', array('class'=>"btn btn-info pull-right")); ?>
		</div>

	<?php $this->endWidget(); ?>

	</div>
</div>
