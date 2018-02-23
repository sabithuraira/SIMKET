<div class="box-body">
	<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
	)); ?>

		<div class="form-group">
			<?php echo $form->labelEx($model,'id_induk'); ?>
			<?php echo $form->dropDownList($model,'id_induk',
					CHtml::listData(IndukKegiatan::model()->findAll(),'id','name'),
					array('empty'=>'- Pilih Induk Kegiatan -', 'class'=>"form-control")); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'tahun'); ?>
			<?php echo $form->dropDownList($model,'tahun',
					HelpMe::getYearForFilter(),
					array('empty'=>'- Pilih Tahun -', 'class'=>"form-control")); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'jenis'); ?>
			<?php echo $form->dropDownList($model,'jenis',
					HelpMe::getJenisData(),
					array('empty'=>'- Pilih Jenis Kegiatan -', 'class'=>"form-control")); ?>
		</div>

		<div class="box-footer">
			<?php echo CHtml::submitButton('Search', array('class'=>"btn btn-info pull-right")); ?>
		</div>

	<?php $this->endWidget(); ?>

	</div>
</div>