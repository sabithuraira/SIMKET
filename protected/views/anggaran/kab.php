<?php
/* @var $this AnggaranController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Anggarans',
);

$this->menu=array(
    array('label'=>'Create Anggaran', 'url'=>array('create')),
    array('label'=>'Manage Anggaran', 'url'=>array('admin')),
);
?>

<h1>PAGU AWAL</h1>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'kegiatan-form',
        'enableAjaxValidation'=>false,
    )); ?>
        <div class="center row">
            <?php echo CHtml::dropDownList('tahun',$tahun,HelpMe::getYearForFilter()); ?>
            <?php echo CHtml::submitButton('Tampilkan',array('class'=>'btn btn-success')); ?>
        </div>
    <?php $this->endWidget(); ?>
</div>
                          
<table id="initabel" class="table table-hover table-bordered table-condensed">
    <?php 
        $januari=0;
        $februari=0;
        $maret=0;
        $april=0;
        $mei=0;
        $juni=0;
        $juli=0;
        $agustus=0;
        $september=0;
        $oktober=0;
        $november=0;
        $desember=0;
        $jumlah=0;
    ?>
    <tr>
        <th>Kode</th>
        <th>Uraian Satker</th>
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
        <th>Jumlah</th>
    </tr>
    <?php foreach (ReportMe::PaguTargetSatker($tahun, $id) as $key => $value) {
        $kode="054.01.01.2886";
        $label="Dukungan Manajemen & Pelaksanaan Tugas Teknis Lainnya BPS Provinsi (DMPTTL)";
        if($key==1)
        {
            $kode="054.01.02.2891";
            $label="Peningkatan Sarana dan Prasarana Aparatur Negara BPS Provinsi (PSPA)";
        }
        else if($key==2){
            $kode="054.01.06.2895";
            $label="Penyediaan dan Pelayanan Informasi Statistik BPS Provinsi (PPIS)";
        }

        echo "
        <tr>
            <td>$kode</td>
            <td>$label</td>";

        $januari+=$value['bl1'];
        $februari+=$value['bl2'];
        $maret+=$value['bl3'];
        $april+=$value['bl4'];
        $mei+=$value['bl5'];
        $juni+=$value['bl6'];
        $juli+=$value['bl7'];
        $agustus+=$value['bl8'];
        $september+=$value['bl9'];
        $oktober+=$value['bl10'];
        $november+=$value['bl11'];
        $desember+=$value['bl12'];
        $jumlah+=$value['bltotal'];

        for ($i=1;$i<=12;++$i){
            echo "<td>".$value["bl$i"]."</td>";
        }
        echo "<td>".$value["bltotal"]."</td>";
        echo "</tr>";
    } 
    
    echo "<td colspan='2'><b>JUMLAH</b></td>";
    echo "<td><b>$januari</b></td>";
    echo "<td><b>$februari</b></td>";
    echo "<td><b>$maret</b></td>";
    echo "<td><b>$april</b></td>";
    echo "<td><b>$mei</b></td>";
    echo "<td><b>$juni</b></td>";
    echo "<td><b>$juli</b></td>";
    echo "<td><b>$agustus</b></td>";
    echo "<td><b>$september</b></td>";
    echo "<td><b>$oktober</b></td>";
    echo "<td><b>$november</b></td>";
    echo "<td><b>$desember</b></td>";
    echo "<td><b>$jumlah</b></td>";
    
    echo "</tr>";
    ?>
</table>