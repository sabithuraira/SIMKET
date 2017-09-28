<style>
    @import url('<?php echo Yii::app()->theme->baseUrl.'/css/baru/jadwal.css';?>');
</style>
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

<h2><?php echo "Kegiatan melewati batas waktu"; ?></h2>


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

<table class="table table-hover table-striped table-bordered table-condensed">
    <tr>
        <th>No. </th>
        <th>Kegiatan</th>
        <th>Target </th>
        <th>Pengiriman</th>
        <th>Penerimaan</th>
    </tr>
    <?php foreach (UnitKerja::model()->findAllByAttributes(array('jenis'=>1,'parent'=>1)) as $ukey => $uvalue) { ?>
        <tr><td colspan="7"><b><?php echo $uvalue->name; ?></b></td></tr>
        <?php
            foreach ($uvalue->BidangWarning($tahun) as $key => $value)
            {
                echo '<tr>';

                echo '<td>'.($key+1).'</td>';
                echo '<td>'.CHtml::link($value->kegiatan,array('kegiatan/progress','id'=>$value->id)).'</td>';
                echo '<td>'.$value->getTarget().'</td>';
              
                echo '<td>'.$value->getPercentageProgress(2).' </td>';
                echo '<td>'.$value->getPercentageProgress(1).' </td>';
                echo '</tr>';
            }

            if(count($uvalue->BidangWarning($tahun))==0)
            {
                echo '<tr>';
                echo '<td></td>';
                
                echo '<td colspan="6">';
                 $this->widget('CStarRating',array(
                            'name'  =>'kirim_'.$uvalue->id,
                            'value'=>10,
                            'minRating'=>1,
                            'maxRating'=>10,
                            'starCount'=>10,
                            'readOnly' =>true,
                        ));
                echo ' <b>  [ Terima kasih telah menyelesaikan pekerjaan tepat pada waktunya ]</b></td>';
                echo '</tr>';   
            }
        ?>
    <?php } ?>
</table>