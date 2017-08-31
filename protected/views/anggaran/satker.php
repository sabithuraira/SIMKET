<?php
/* @var $this AnggaranController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Anggaran',
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
    <tr>
        <th colspan="2">Program Kegiatan</th>
        <th>Bidang</th>
        <th>Satker Provinsi</th>
        <th>Satker Kab/Kota</th>
        <th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th>
        <th>9</th><th>10</th><th>11</th><th>71</th><th>72</th><th>73</th><th>74</th>
    </tr>
    <tr>
        <th colspan="2"></th>
        <th></th>
        <td><b><?php echo ($model->TotalPaguProv($tahun)/1000000); ?></b></th>
        <th></th>
        <td><b><?php echo ($model->TotalPaguKab($tahun,'1601')/1000000); ?></b></th>
        <td><b><?php echo ($model->TotalPaguKab($tahun,'1602')/1000000); ?></b></th>
        <td><b><?php echo ($model->TotalPaguKab($tahun,'1603')/1000000); ?></b></th>
        <td><b><?php echo ($model->TotalPaguKab($tahun,'1604')/1000000); ?></b></th>
        <td><b><?php echo ($model->TotalPaguKab($tahun,'1605')/1000000); ?></b></th>
        <td><b><?php echo ($model->TotalPaguKab($tahun,'1606')/1000000); ?></b></th>
        <td><b><?php echo ($model->TotalPaguKab($tahun,'1607')/1000000); ?></b></th>
        <td><b><?php echo ($model->TotalPaguKab($tahun,'1608')/1000000); ?></b></th>
        <td><b><?php echo ($model->TotalPaguKab($tahun,'1609')/1000000); ?></b></th>
        <td><b><?php echo ($model->TotalPaguKab($tahun,'1610')/1000000); ?></b></th>
        <td><b><?php echo ($model->TotalPaguKab($tahun,'1611')/1000000); ?></b></th>
        <td><b><?php echo ($model->TotalPaguKab($tahun,'1671')/1000000); ?></b></th>
        <td><b><?php echo ($model->TotalPaguKab($tahun,'1672')/1000000); ?></b></th>
        <td><b><?php echo ($model->TotalPaguKab($tahun,'1673')/1000000); ?></b></th>
        <td><b><?php echo ($model->TotalPaguKab($tahun,'1674')/1000000); ?></b></th>
    </tr>
    <?php foreach(MInduk::model()->findAll() as $key=>$value){
        echo "<tr>
                <td><b>".$value->id."</b></td>
                <td><b>".$value->label."</b></td>
                <td><b></b></td>
                <td><b>".($value->MyPagu($tahun)/1000000)."</b></td>
                <td><b></b></td>
                <td><b>".($value->PaguSatker($tahun,'1601')/1000000)."</b></td>
                <td><b>".($value->PaguSatker($tahun,'1602')/1000000)."</b></td>
                <td><b>".($value->PaguSatker($tahun,'1603')/1000000)."</b></td>
                <td><b>".($value->PaguSatker($tahun,'1604')/1000000)."</b></td>
                <td><b>".($value->PaguSatker($tahun,'1605')/1000000)."</b></td>
                <td><b>".($value->PaguSatker($tahun,'1606')/1000000)."</b></td>
                <td><b>".($value->PaguSatker($tahun,'1607')/1000000)."</b></td>
                <td><b>".($value->PaguSatker($tahun,'1608')/1000000)."</b></td>
                <td><b>".($value->PaguSatker($tahun,'1609')/1000000)."</b></td>
                <td><b>".($value->PaguSatker($tahun,'1610')/1000000)."</b></td>
                <td><b>".($value->PaguSatker($tahun,'1611')/1000000)."</b></td>
                <td><b>".($value->PaguSatker($tahun,'1671')/1000000)."</b></td>
                <td><b>".($value->PaguSatker($tahun,'1672')/1000000)."</b></td>
                <td><b>".($value->PaguSatker($tahun,'1673')/1000000)."</b></td>
                <td><b>".($value->PaguSatker($tahun,'1674')/1000000)."</b></td>

            </tr>";   

            $criteria2 = new CDbCriteria;
            $criteria2->condition = "m_induk={$value->id} AND parent IS NULL";
            $criteria2->order='id';

            foreach (MOutput::model()->findAllByAttributes(array(),$criteria2) as $key2 => $value2) {
                echo "<tr>
                    <td>".$value2->no."</td>
                    <td>".$value2->label."</td>
                    <td>".($value2->MyPagu($tahun)->unitKerja->name)."</td>
                    <td>".($value2->MyPagu($tahun)->jumlah/1000000)."</td>
                    <td>".($value2->PaguSatker($tahun)/1000000)."</td>";
                //</tr>";   

                foreach (UnitKerja::model()->findAllByAttributes(array('parent'=>1,'jenis'=>2),array('order'=>'code')) as $key3 => $value3) {
                    echo "<td>".(Pagu::model()->PaguKab($value2->id, $value3->id, $tahun)/1000000)."</td>";   
                }
            }
        }  
    ?>
</table>