<?php
/* @var $this PegawaiController */
/* @var $model Pegawai */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pegawai-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nip'); ?>
		<?php echo $form->textField($model,'nip',array('size'=>18,'maxlength'=>18, 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'nip'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nama'); ?>
		<?php echo $form->textField($model,'nama',array('size'=>60,'maxlength'=>255, 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'nama'); ?>
	</div>

	<?php if(Yii::app()->user->getLevel()==1){ ?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'unit_kerja'); ?>
		<?php echo $form->dropDownList($model,'unit_kerja',
				CHtml::listData(UnitKerja::model()->findAll(),'id','name'),
				array('empty'=>'- Pilih Unit Kerja-', 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'unit_kerja'); ?>
	</div>
	<?php } ?>


	<div class="form-group">
		<?php echo $form->labelEx($model,'unit_kerja_kab'); ?>
		<?php echo $form->dropDownList($model,'unit_kerja_kab',
				CHtml::listData(UnitKerjaDaerah::model()->findAll(),'id','nama'),
				array('empty'=>'- Pilih Jabatan -', 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'unit_kerja'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'golongan'); ?>
		<?php echo $form->textField($model,'golongan',array('size'=>60,'maxlength'=>255, 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'golongan'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'jabatan'); ?>
		<?php echo $form->textField($model,'jabatan',array('size'=>60,'maxlength'=>255, 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'jabatan'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'foto'); ?>
		<?php echo $form->fileField($model,'foto',array('rows'=>6, 'cols'=>50, 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'foto'); ?>
		<?php 
			if(!$model->isNewRecord && strlen($model->foto)>0){
				echo '<br/><img width="100" src="'.$model->fotoImage.'" alt="User Image">';
			}
		?>
	</div>

	<div class="box-footer">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>"btn btn-info pull-right")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->