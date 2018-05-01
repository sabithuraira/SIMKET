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


	<div class="box-footer">
		<?php echo CHtml::submitButton('Search', array('class'=>"btn btn-info pull-right")); ?>
	</div>

	<?php $this->endWidget(); ?>

	</div>
</div>
