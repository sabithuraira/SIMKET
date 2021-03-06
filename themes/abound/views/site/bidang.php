<?php
/* @var $this KegiatanController */
/* @var $model Kegiatan */
/*
$this->breadcrumbs=array(
    'Bidang'=>array('index'),
    $model->name,
);
*/
?>

<h1><?php echo $model->name; ?></h1>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'kegiatan-form',
        'enableAjaxValidation'=>false,
    )); ?>
        <div class="center row">
            <?php echo "<b>Tampilkan Data Tahun : </b>"; ?>
            <?php echo CHtml::dropDownList('tahun',$tahun,HelpMe::getYearForFilter()); ?>
            <?php echo CHtml::submitButton('Tampilkan',array('class'=>'btn btn-success')); ?>
        </div>

    <?php $this->endWidget(); ?>
</div>

<table class="table table-hover table-bordered table-condensed">
    <tr>
        <th></th>
        <th>No. </th>
        <th>Kegiatan</th>
        <th>Tanggal Berakhir </th>
        <th>Target </th>
        <th>Pengiriman</th>
        <th>Penerimaan</th>
    </tr>
    <?php foreach (UnitKerja::model()->findAllByAttributes(array('parent'=>$model->id)) as $ukey => $uvalue) { ?>
        <tr><td colspan="7"><b><?php echo $uvalue->name; ?></b></td></tr>
        <?php
            $criteria = new CDbCriteria;
            $criteria->condition = "YEAR(end_date)={$tahun}";
            $criteria->order='end_date';
            foreach (Kegiatan::model()->findAllByAttributes(array('unit_kerja'=>$uvalue->id),$criteria) as $key => $value)
            {
                echo '<tr>';
                echo '<td class="'.$value->TabelClass().'"></td>';
                echo '<td>'.($key+1).'</td>';
                echo '<td>'.CHtml::link($value->kegiatan,array('kegiatan/progress','id'=>$value->id)).'</td>';
                echo '<td>'.date("d M Y",strtotime($value->end_date)).'</td>';
                echo '<td>'.$value->getTarget().'</td>';
                echo '<td>'.$value->getPercentageProgress(2).' </td>';
                echo '<td>'.$value->getPercentageProgress(1).' </td>';
                echo '</tr>';
                
            }
        ?>
    <?php } ?>
</table>