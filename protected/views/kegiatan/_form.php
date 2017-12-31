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
		<?php echo $form->labelEx($model,'kegiatan'); ?>
		<?php echo $form->textField($model,'kegiatan',array('size'=>60,'maxlength'=>255, 'class'=>"form-control")); ?>
		<?php echo $form->error($model,'kegiatan'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'unit_kerja'); ?>
		<?php 
			echo $form->dropDownList($model,'unit_kerja',
					HelpMe::ListAuthorizeUnitKerja(),
					array('empty'=>'- Pilih Unit Kerja-', 'class'=>"form-control")); 
		?>
		<?php echo $form->error($model,'unit_kerja'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'jenis_kegiatan'); ?>
		<?php 
			echo $form->dropDownList($model,'jenis_kegiatan',
					HelpMe::getJenisData(),
					array('empty'=>'- Pilih Jenis Kegiatan -', 'class'=>"form-control")); 
		?>
		<?php echo $form->error($model,'unit_kerja'); ?>
	</div>


	<table class="table table-hover table-striped table-bordered">
		<tr>
			<th><?php echo $form->labelEx($model,'start_date'); ?></td>
			<th><?php echo $form->labelEx($model,'end_date'); ?></td>
		</tr>
		
		<tr>
			<td>
			<?php
				$this->widget('zii.widgets.jui.CJuiDatePicker', 
					array(
						'model'=>$model,
						'attribute'=>'start_date',
						'options' => array(
							'dateFormat'=>'yy-mm-dd',
							'changeYear'=>true,
							'changeMonth'=>true
						)
					)
				);
			?>
			</td>

			<td>

			<?php
				$this->widget('zii.widgets.jui.CJuiDatePicker', 
					array(
						'model'=>$model,
						'attribute'=>'end_date',
						'options' => array(
							'dateFormat'=>'yy-mm-dd',
							'changeYear'=>true,
							'changeMonth'=>true
						)
					)
				);
			?>
			</td>
		</tr>
	</table>

	<table class="table table-hover table-striped table-bordered table-condensed">
		<tr>
			<th>Kabupaten</th>
			<th>Target</th>
			<th>Anggaran</th>
		</tr>
		<?php
			foreach (UnitKerja::model()->findAllByAttributes(array('jenis'=>'2'),array('order'=>'code')) as $key => $value)
			{
				$modelpart=Participant::model()->findByAttributes(array(
						'kegiatan'		=>$model->id,
						'unitkerja'		=>$value['id']
					));
				//if($key%2==0)
					echo '<tr>';

				//echo '<td>'.CHtml::checkBox('id_'.$value['id']).'</td>';
				// echo '<td>'.CHtml::label($value['name'], 'id_'.$value['id']).'</td>';
				echo '<td>'.$value['name'].'</td>';
				echo '<td>'.CHtml::textField('target_'.$value['id'],($modelpart!==null ? $modelpart->target : '')).'</td>';
				echo '<td>'.CHtml::textField('anggaran_'.$value['id'],($modelpart!==null ? $modelpart->target : '')).'</td>';

				//if($key%2!==0)
					echo '</tr>';
				
			}
		?>
	</table>


	<div class="box-footer">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->