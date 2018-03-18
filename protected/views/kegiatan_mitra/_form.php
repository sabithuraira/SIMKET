<?php
/* @var $this KegiatanController */
/* @var $model Kegiatan */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kegiatan-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

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
		<?php echo $form->labelEx($model,'simket_id'); ?>
		<?php 
			echo $form->dropDownList($model,'simket_id',
					CHtml::listData(Kegiatan::model()->findAll(), 'id', 'kegiatan'),
					array('empty'=>'- Pilih Induk Kegiatan-', 'class'=>"form-control")); 
		?>
		<?php echo $form->error($model,'simket_id'); ?>
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
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>


<?php $this->endWidget(); ?>