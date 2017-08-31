<?php
/* @var $this ContactController */
/* @var $model Contact */

$this->pageTitle=Yii::app()->name . ' - Import';
$this->breadcrumbs=array(
  'Import',
);
?>
<div class="page-header">
  <h1>Import Data <small>select data</small></h1>
</div>
<div class="row-fluid">
  
    <div class="span12">


    <p>Please select data from your excel file that you want to import :</p>
    
    <div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
      'htmlOptions'=>array(
        'enctype'=>'multipart/form-data',
        "class"=>"form-horizontal",
      ),
    )); ?>
    
       <?php if(strlen($naname)>1){ ?>
         <div class="control-group">
              <label class="control-label">Select Excel Sheet</label>
              <div class="controls">
                  <input type="hidden" name="naname" value=<?php echo $naname;?>>
                  <?php echo CHtml::dropDownList('listname','',CHtml::listData($model->getSheet($naname), 'id', 'label'),array('empty'=>'- Select Data -')); ?>
              </div>
         </div>
       <?php } ?>
    
        <div class="row buttons">
            <?php echo CHtml::submitButton('Submit',array('class'=>'btn btn btn-primary')); ?>
        </div>
    
    <?php $this->endWidget(); ?>
    </div><!-- form -->


    </div>
</div>