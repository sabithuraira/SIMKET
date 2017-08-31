<?php
/* @var $this KabupatenController */
/* @var $model MKab */

$this->breadcrumbs=array(
    'PAGU'=>array('index'),
    'Import',
);

$this->menu=array(
    array('label'=>'Import Pagu Provinsi Awal', 'url'=>array('import','id'=>1)),
    array('label'=>'Import Pagu Kabupaten/Kota Awal', 'url'=>array('import','id'=>2)),
    array('label'=>'Import Rencana Penarikan Kabupaten/Kota', 'url'=>array('importkab')),
);
?>

<?php 
    if($id==1)
        echo "<h1>Import Pagu Provinsi Awal</h1>";
    else if($id==2)
        echo "<h1>Import Pagu Kabupaten/Kota Awal</h1>";
    else if($id==0)
        echo "<h1>Import Rencana Penarikan Kabupaten/Kota</h1>";
?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'mkab-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
      'enctype'=>'multipart/form-data',
    ),
)); ?>

    <p class="note">Pastikan data yang anda import sudah sesuai dengan format yang ditetapkan.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->fileField($model,'filename'); ?>
        <?php echo $form->error($model,'filename'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Import'); ?>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->