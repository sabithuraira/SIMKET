<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<link rel="stylesheet" href="<?php echo $baseUrl;?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<?php
/* @var $this JadwalTugasController */
/* @var $model JadwalTugas */
/* @var $form CActiveForm */
?>

<div class="form" id="jadwal_tag">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jadwal-tugas-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255, 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tahun'); ?>
		<?php echo $form->dropDownList($model,'tahun',
				HelpMe::getYearForFilter(),
				array('empty'=>'- Pilih Tahun -', 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'tahun'); ?>
	</div>

	<div class="box-footer">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>"btn btn-info pull-right")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->