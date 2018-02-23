<?php
/* @var $this K_anggaranController */
/* @var $model KegiatanForAnggaran */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kegiatan-for-anggaran-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'id_induk'); ?>
		<?php echo $form->dropDownList($model,'id_induk',
				CHtml::listData(IndukKegiatan::model()->findAll(),'id','name'),
				array('empty'=>'- Pilih Induk Kegiatan -', 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'id_induk'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tahun'); ?>
		<?php echo $form->dropDownList($model,'tahun',
				HelpMe::getYearForFilter(),
				array('empty'=>'- Pilih Tahun -', 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'tahun'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'jenis'); ?>
		<?php echo $form->dropDownList($model,'jenis',
				HelpMe::getJenisData(),
				array('empty'=>'- Pilih Jenis Kegiatan -', 'class'=>"form-control")); ?>
		
		<?php echo $form->error($model,'jenis'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'keterangan'); ?>
        <small><i>(contoh: Subround II, TW III, Bulan Januari, dll )</i></small>
		<?php echo $form->textArea($model,'keterangan',array('form-groups'=>6, 'cols'=>50, 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'keterangan'); ?>
	</div>

	<div class="box-footer">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->