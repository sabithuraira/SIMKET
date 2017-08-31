<?php
/* @var $this PsatkerController */
/* @var $model PaguSatker */

$this->breadcrumbs=array(
    'Rencana Penarikan'=>array('index'),
    'Kelola',
);

$this->menu=array(
    array('label'=>'Tambah Rencana Penarikan', 'url'=>array('create')),
    array('label'=>'Perbaharui Rencana Penarikan', 'url'=>array('edit')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $('#pagu-satker-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Rencana Penarikan</h1>


<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'kegiatan-form',
        'method'=>'get',
    )); ?>
        <div class="center row">
            <?php echo "<b>Tampilkan Data Tahun : </b>"; ?>
            <?php echo CHtml::dropDownList('id',$id,HelpMe::getKabKotaList()); ?>
            <?php echo CHtml::dropDownList('tahun',$tahun,HelpMe::getYearForFilter()); ?>
            <?php echo CHtml::submitButton('Tampilkan',array('class'=>'btn btn-success')); ?>
        </div>

    <?php $this->endWidget(); ?>
</div>

<h2>Rencana Penarikan Dana & Perkiraan Penerimaan (Halaman III DIPA)</h2>

<table class="table table-hover table-bordered table-condensed">
    <tr>
        <th>Uraian</th>
        <th>Januari</th>
        <th>Februari</th>
        <th>Maret</th>
        <th>April</th>
        <th>Mei</th>
        <th>Juni</th>
        <th>Juli</th>
        <th>Agustus</th>
        <th>September</th>
        <th>Oktober</th>
        <th>November</th>
        <th>Desember</th>
    </tr>
    <?php 
        $second_table="";
        foreach ($model->report_me($id,$tahun) as $key=>$value) { 
            echo '<tr>';
            echo '<td>'.$value['label'].'</td>';
            echo '<td>'.$value['Jan'].'</td>';
            echo '<td>'.$value['Feb'].'</td>';
            echo '<td>'.$value['Mar'].'</td>';
            echo '<td>'.$value['Apr'].'</td>';
            echo '<td>'.$value['May'].'</td>';
            echo '<td>'.$value['Jun'].'</td>';
            echo '<td>'.$value['Jul'].'</td>';
            echo '<td>'.$value['Aug'].'</td>';
            echo '<td>'.$value['Sep'].'</td>';
            echo '<td>'.$value['Oct'].'</td>';
            echo '<td>'.$value['Nov'].'</td>';
            echo '<td>'.$value['Dec'].'</td>';
            echo '</tr>';

            $second_table.='<tr>
                    <td>'.$value['label'].'</td>
                    <td>'.$value['Janr'].'</td>
                    <td>'.$value['Febr'].'</td>
                    <td>'.$value['Marr'].'</td>
                    <td>'.$value['Aprr'].'</td>
                    <td>'.$value['Mayr'].'</td>
                    <td>'.$value['Junr'].'</td>
                    <td>'.$value['Julr'].'</td>
                    <td>'.$value['Augr'].'</td>
                    <td>'.$value['Sepr'].'</td>
                    <td>'.$value['Octr'].'</td>
                    <td>'.$value['Novr'].'</td>
                    <td>'.$value['Decr'].'</td>
                    </tr>';
        } 
    ?>
</table>


<h2>Realisasi Penyerapan Anggaran</h2>
<table class="table table-hover table-bordered table-condensed">
    <tr>
        <th>Uraian</th>
        <th>Januari</th>
        <th>Februari</th>
        <th>Maret</th>
        <th>April</th>
        <th>Mei</th>
        <th>Juni</th>
        <th>Juli</th>
        <th>Agustus</th>
        <th>September</th>
        <th>Oktober</th>
        <th>November</th>
        <th>Desember</th>
    </tr>
    <?php echo $second_table; ?>
</table>