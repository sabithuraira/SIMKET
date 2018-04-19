<?php
	$baseUrl = Yii::app()->theme->baseUrl;
?>
<link rel="stylesheet" href="<?php echo $baseUrl;?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<div class="form">

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
			<?php echo $form->labelEx($model,'pertanyaan'); ?>
			<?php echo $form->textField($model,'pertanyaan',array('size'=>60,'maxlength'=>255, 'class'=>"form-control")); ?>
			<?php echo $form->error($model,'pertanyaan'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'description'); ?>
			<?php echo $form->textArea($model,'description',array('class'=>"textarea", 'style'=>"width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;")); ?>
			<?php echo $form->error($model,'description'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'teruntuk'); ?>
			<?php echo $form->dropDownList($model,'teruntuk',
					array(1 => 'PML', 2 => 'PCL', 3=> 'PCL dan PML'),
					array('empty'=>'- Pilih Output -', 'class'=>"form-control")); ?>
			<?php echo $form->error($model,'teruntuk'); ?>
		</div>

		<u>Masukkan Daftar Jawaban:</u>
		<p></p>
		<table class="table table-hover table-bordered table-condensed">
			<tr>
				<th class="text-center">Skala Nilai<br/>
				<small>(Besar kecil skala sesuai dengan nilai)</small>
				</th>
				<th>Option</th>
			</tr>
			<?php
				for($i=1;$i<=4;++$i)
				{
					echo '<tr class="text-center">';
						echo '<td>'.($i).'</td>';
						echo '<td>'.$form->textField($model,'option'.$i,array('size'=>60,'maxlength'=>255, 'class'=>"form-control")).'</td>';
				
					echo '</tr>';
				}
			?>
		</table>

		<div class="box-footer">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>"btn btn-info pull-right")); ?>
		</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->

<script src="<?php echo $baseUrl;?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
	$("#MitraPertanyaan_description").wysihtml5();
</script>