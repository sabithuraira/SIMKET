<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mitra-bps-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nama'); ?>
		<?php echo $form->textField($model,'nama',array('size'=>60,'maxlength'=>255, 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'nama'); ?>
	</div>


	<div class="form-group">
		<?php echo $form->labelEx($model,'kab_id'); ?>
		<?php echo $form->dropDownList($model,'kab_id',
				CHtml::listData(UnitKerja::model()->findAllByAttributes(array('jenis'=>2)), 'id', 'name'),
				array('empty'=>'- Pilih Kabupaten -', 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'kab_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nomor_telepon'); ?>
		<?php echo $form->textField($model,'nomor_telepon',array('size'=>15,'maxlength'=>15, 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'nomor_telepon'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'alamat'); ?>
		<?php echo $form->textArea($model,'alamat',array('rows'=>6, 'cols'=>50, 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'alamat'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tanggal_lahir'); ?>
		<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', 
				array(
					'model'=>$model,
					'attribute'=>'tanggal_lahir',
					'options' => array(
						'dateFormat'=>'yy-mm-dd',
						'changeYear'=>true,
						'changeMonth'=>true,
					)
				)
			);
		?>
		<?php echo $form->error($model,'tanggal_lahir'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'jk'); ?>
		<?php echo $form->dropDownList($model,'jk',
				array(1=>'Laki-laki', 2=> 'Perempuan'),
				array('empty'=>'- Jenis Kelamin -', 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'jk'); ?>
	</div>


	<div class="form-group">
		<?php echo $form->labelEx($model,'pendidikan'); ?>
		<?php echo $form->dropDownList($model,'pendidikan',
				$model->pendidikanDropdown,
				array('empty'=>'- Pendidikan Terakhir -', 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'pendidikan'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'riwayat'); ?>
		<?php echo $form->textArea($model,'riwayat',array('rows'=>6, 'cols'=>50, 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'riwayat'); ?>
	</div>

	<div class="box-footer">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>"btn btn-info pull-right")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->