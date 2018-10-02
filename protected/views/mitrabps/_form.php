<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mitra-bps-form',
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
		<?php echo $form->labelEx($model,'nama'); ?>
		<?php echo $form->textField($model,'nama',array('size'=>60,'maxlength'=>255, 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'nama'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'unit_kerja_id'); ?>
		<?php echo $form->dropDownList($model,'unit_kerja_id',
				CHtml::listData(UnitKerjaDaerah::model()->findAll('id NOT IN(1,2)'), 'id', 'nama'),
				array('empty'=>'- Pilih Seksi/Subbagian -', 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'unit_kerja_id'); ?>
	</div>

	<?php if(Yii::app()->user->getLevel()==1){ ?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'kab_id'); ?>
		<?php echo $form->dropDownList($model,'kab_id',
				CHtml::listData(UnitKerja::model()->findAllByAttributes(array('jenis'=>2)), 'id', 'name'),
				array('empty'=>'- Pilih Kabupaten -', 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'kab_id'); ?>
	</div>
	<?php } ?>

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