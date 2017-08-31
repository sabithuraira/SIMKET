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

<h1>Summary Anggaran BPS Provinsi Sumatera Selatan</h1>
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
      

<div class="alert alert-info">
    <strong>Dalam juta rupiah</strong>
</div>                    
<table id="initabel" class="table table-hover table-bordered table-condensed">
    <tr>
        <th rowspan="2" colspan="3">Indikator Tujuan Kinerja Sasaran</th>
        <th rowspan="2">Pagu Awal</th>
        <th rowspan="2">Revisi</th>
        <th colspan="4">Realisasi Anggaran</th>
    </tr>
    <tr>
        <th>TW1</th>
        <th>TW2</th>
        <th>TW3</th>
        <th>TW4</th>
    </tr>
    <tr>
        <td></th>
        <td></th>
        <td></th>
        <td><?php echo ($model->TotalPaguProv($tahun)/1000000); ?></th>
        <td><?php echo ($model->TotalPaguRevisiProv($tahun)/1000000); ?></th>
        <td><?php echo ($model->TotalPaguRealisasiProv($tahun,1)/1000000); ?></th>
        <td><?php echo ($model->TotalPaguRealisasiProv($tahun,2)/1000000); ?></th>
        <td><?php echo ($model->TotalPaguRealisasiProv($tahun,3)/1000000); ?></th>
        <td><?php echo ($model->TotalPaguRealisasiProv($tahun,4)/1000000); ?></th>
    </tr>
    <?php foreach(MInduk::model()->findAll() as $key=>$value){
        $label="";
        if($value->id==1)
            $label="PENINGKATAN KUALITAS DATA STATISTIK";
        else if($value->id==2)
            $label="PENINGKATAN PELAYANAN PRIMA HASIL KEGIATAN STATISTIK";
        else if($value->id==3)
            $label="PENINGKATAN BIROKRASI YANG AKUNTABEL";

        echo "<tr>
                <td>".$value->id."</th>
                <td colspan='2' >".$label/*$value->label*/."</th>
                <td>".($value->MyPagu($tahun)/1000000)."</th>
                <td>".($value->MyPaguRevisi($tahun)/1000000)."</th>
                <td>".($value->MyPaguRealisasi($tahun,1)/1000000)."</th>
                <td>".($value->MyPaguRealisasi($tahun,2)/1000000)."</th>
                <td>".($value->MyPaguRealisasi($tahun,3)/1000000)."</th>
                <td>".($value->MyPaguRealisasi($tahun,4)/1000000)."</th>
            </tr>";   

            $criteria2 = new CDbCriteria;
            $criteria2->condition = "m_induk={$value->id} AND parent IS NULL";
            $criteria2->order='no';

            foreach (MOutput::model()->findAllByAttributes(array(),$criteria2) as $key2 => $value2) {
                echo "<tr>
                    <td>".$value2->no."</td>
                    <td colspan='2' >".$value2->label."</td>
                    <td>".($value2->MyPagu($tahun)->jumlah/1000000)."</td>
                    <td>".($value2->MyPagu($tahun)->revisi/1000000)."</td>
                    <td>".(($value2->MyPagu($tahun)->tw1)/1000000)."</td>
                    <td>".(($value2->MyPagu($tahun)->tw2)/1000000)."</td>
                    <td>".(($value2->MyPagu($tahun)->tw3)/1000000)."</td>
                    <td>".(($value2->MyPagu($tahun)->tw4)/1000000)."</td>
                </tr>";   

                foreach (MOutput::model()->findAllByAttributes(array('parent'=>$value2->no)) as $key3 => $value3) {
                    echo "<tr>
                        <td></td>
                        <td>".$value3->no."</td>
                        <td>".$value3->label."</td>
                        <td>".($value3->MyPagu($tahun)->jumlah/1000000)."</td> 
                        <td>".($value3->MyPagu($tahun)->revisi/1000000)."</td>
                        <td>".(($value3->MyPagu($tahun)->tw1)/1000000)."</td>
                        <td>".(($value3->MyPagu($tahun)->tw2)/1000000)."</td>
                        <td>".(($value3->MyPagu($tahun)->tw3)/1000000)."</td>
                        <td>".(($value3->MyPagu($tahun)->tw4)/1000000)."</td>
                    </tr>";   
                }
            }
        }  
    ?>
</table>