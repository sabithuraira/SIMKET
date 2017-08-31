<?php
/* @var $this PaguController */
/* @var $model Pagu */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pagu-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'m_output'); ?>
		<?php echo $form->dropDownList($model,'m_output',CHtml::listData(MOutput::model()->findAll(),"id","label"),array('empty'=>'- Pilih -')); ?>
		<?php echo $form->error($model,'m_output'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unit_kerja'); ?>
		<?php echo $form->dropDownList($model,'unit_kerja',
				CHtml::listData(UnitKerja::model()->findAllByAttributes(array('parent'=>1)),"id","name"),array('- Pilih -')); ?>
		<?php echo $form->error($model,'unit_kerja'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jumlah'); ?>
		<?php echo $form->textField($model,'jumlah',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'jumlah'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tahun'); ?>
		<?php echo $form->textField($model,'tahun'); ?>
		<?php echo $form->error($model,'tahun'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'revisi'); ?>
		<?php echo $form->textField($model,'revisi',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'revisi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tw1'); ?>
		<?php echo $form->textField($model,'tw1',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'tw1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tw2'); ?>
		<?php echo $form->textField($model,'tw2',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'tw2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tw3'); ?>
		<?php echo $form->textField($model,'tw3',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'tw3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tw4'); ?>
		<?php echo $form->textField($model,'tw4',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'tw4'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->