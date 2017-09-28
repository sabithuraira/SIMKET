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

<h2><?php echo "Peringkat Kabupaten/Kota hingga saat ini"; ?></h2>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'kegiatan-form',
    'enableAjaxValidation'=>false,
)); ?>


    <div class="center row">
        <?php echo CHtml::dropDownList('bidang',$bidang,HelpMe::getBidangBosList()); ?>
        <?php echo CHtml::dropDownList('tahun',$tahun,HelpMe::getYearForFilter()); ?>
        <?php echo CHtml::submitButton('Tampilkan',array('class'=>'btn btn-success')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<div class="alert alert-info">
    <strong>Point maksimal = 5</strong>
</div>
<table class="table table-hover table-striped table-bordered table-condensed">
    <tr>
        <th>No. </th>
        <th>Kabupaten/Kota</th>
        <th>Jumlah Kegiatan</th>
        <th>Jumlah Target</th>
        <th>Point</th>
    </tr>
    <?php foreach ($data as $key => $value) { ?>
        <?php
                echo '<tr>';

                echo '<td>'.($key+1).'</td>';
                echo '<td>'.CHtml::link($value['name'],array('report/kabupaten','id'=>$value['unitkerja'])).'</td>';
                echo '<td>'.$value['jumlah_kegiatan'].'</td>';
                echo '<td>'.$value['jumlah_target'].' </td>';
                echo '<td>'.$value['point'].' </td>';
                echo '</tr>';
        ?>
    <?php } ?>
</table>


<div class="alert alert-danger">
  Daftar lengkap peringkat kabupaten/kota dapat dilihat oleh admin, pastikan unit kerja anda ada pada daftar di atas...
</div>