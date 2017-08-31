<?php
/* @var $this AnggaranController */
/* @var $model Anggaran */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'anggaran-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'unit_kerja'); ?>
		<?php echo $form->dropDownList($model,'unit_kerja',
			CHtml::listData(UnitKerja::model()->findAllByAttributes(array('parent'=>1),array('order'=>'jenis')),'id','name'),
			array('empty'=>'- Pilih Unit Kerja -',
				 'onChange' => CHtml::ajax(array(
                    'type'=>'POST',
                    'dataType'=>'json',
                    'url'=>array('anggaran/fromto'),
                    'data' => "js:{idnya:$(this).val()}",
                    'beforeSend' => 'function() {          
                    	myApp.showPleaseWait();
        			}',
                    'success'=>"function(data){
                        $('#Anggaran_m_o_from').html(data.satu);
                        $('#Anggaran_m_o_to').html(data.satu);
                        myApp.hidePleaseWait();
                     }",
                  )),
				)
			); 
		?>
		<?php echo $form->error($model,'unit_kerja'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jenis'); ?>
		<?php echo $form->dropDownList($model,'jenis',
				array(1=>'Revisi (Penambahan/Pemindahan)',2=>'Penyerapan'),
				array('empty'=>'- Pilih Jenis Anggaran -')
			);
		?>
		<?php echo $form->error($model,'jenis'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jumlah'); ?>
		<?php echo $form->textField($model,'jumlah',array('size'=>13,'maxlength'=>13)); ?>
		<?php echo $form->error($model,'jumlah'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'m_o_from'); ?>
		<?php echo $form->dropDownList($model,'m_o_from',
			/*CHtml::listData(MOutput::model()->findAll(),"id","label")*/ array(),
			array('empty'=>'- Asal Anggaran -',
			 'onChange' => CHtml::ajax(array(
                    'type'=>'POST',
                    'dataType'=>'json',
                    'url'=>array('anggaran/validatefrom'),
                    'data' => "js:{idnya:$(this).val()}",
                    'beforeSend' => 'function() {          
                    	myApp.showPleaseWait();
        			}',
                    'success'=>"function(data){
                        $('#Anggaran_m_o_to').html(data.satu);
                        myApp.hidePleaseWait();
                     }",
                  )),
             )); 
        ?>
		<?php echo $form->error($model,'m_o_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'m_o_to'); ?>
		<?php echo $form->dropDownList($model,'m_o_to',
			/*CHtml::listData(MOutput::model()->findAll(),"id","label")*/array(),
			array('empty'=>'- Tujuan Anggaran -')); ?>
		<?php echo $form->error($model,'m_o_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ket'); ?>
		<?php echo $form->textArea($model,'ket',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ket'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<div class="modal hide" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-header">
        <h1>Harap Tunggu...</h1>
    </div>
    <div class="modal-body">
        <div class="progress progress-striped active">
            <div class="bar" style="width: 100%;"></div>
        </div>
    </div>
</div>

<script>
var myApp;
myApp = myApp || (function () {
    var pleaseWaitDiv = $('<div class="modal hide" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false"><div class="modal-header"><h1>Processing...</h1></div><div class="modal-body"><div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div></div></div>');
    return {
        showPleaseWait: function() {
            pleaseWaitDiv.modal();
        },
        hidePleaseWait: function () {
            pleaseWaitDiv.modal('hide');
        },

    };
})();
</script>