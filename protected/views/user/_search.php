<div class="box-body">
	<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
	)); ?>

		<p class="note">Fields with <span class="required">*</span> are required.</p>

		<?php echo $form->errorSummary($model); ?>

		<div class="form-group">
			<?php echo $form->labelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username',array('size'=>45,'maxlength'=>45, 'class'=>"form-control")); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'unit_kerja'); ?>
			<?php echo $form->dropDownList($model,'unit_kerja',
					CHtml::listData(UnitKerja::model()->findAll(array('order'=>'jenis, code')),'id','name'),
					array('empty'=>'- Pilih Unit Kerja-', 'class'=>"form-control")); ?>
			<?php echo $form->error($model,'unit_kerja'); ?>
		</div>


		<div class="box-footer">
			<?php echo CHtml::submitButton('Search', array('class'=>"btn btn-info pull-right")); ?>
		</div>

	<?php $this->endWidget(); ?>

	</div>
</div>
