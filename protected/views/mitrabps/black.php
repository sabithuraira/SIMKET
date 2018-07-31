<div class="box box-info">
	<div class="mailbox-controls">
		<b>Update Mitra BPS <?php echo $model->nama; ?></b>
		<div class="pull-right">
			<?php echo CHtml::link("<i class='fa fa-list'></i> Daftar Mitra", array('index'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
			<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
			<?php echo CHtml::link("<i class='fa fa-search'></i> Detail", array('view', "id"=>$model->id), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
		</div>
	</div>

	<div class="box-body">

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
                    <?php echo $form->checkBox($model,'is_black'); ?>  Tandai sebagai mitra hitam
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'black_note'); ?>
                    <?php echo $form->textArea($model,'black_note',array('rows'=>6, 'cols'=>50, 'class'=>"form-control")); ?>
                    <?php echo $form->error($model,'black_note'); ?>
                </div>

                <div class="box-footer">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>"btn btn-info pull-right")); ?>
                </div>

            <?php $this->endWidget(); ?>
        </div>
	</div>
</div>