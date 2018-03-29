<div class="box-body">
	<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'POST',
	)); ?>

		<div class="form-group">
			<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45, 'placeholder'=>'Nama komponen anggaran', 'class'=>"form-control")); ?>
		</div>



		<div class="form-group">
			<?php echo $form->dropDownList($model,'tahun',
					HelpMe::getYearForFilter(),
					array('empty'=>'- Pilih Tahun Komponen -', 'class'=>"form-control")); ?>
		</div>

		<div class="box-footer">
			<?php echo CHtml::submitButton('Search', array('class'=>"btn btn-info pull-right")); ?>
		</div>

	<?php $this->endWidget(); ?>

	</div>
</div>
