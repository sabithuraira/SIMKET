<?php
/* @var $this PsatkerController */
/* @var $model PaguSatker */

$this->breadcrumbs=array(
    'Rencana Penarikan'=>array('index'),
    'Kelola',
);

$this->menu=array(
    array('label'=>'Tambah Rencana Penarikan', 'url'=>array('create')),
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

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'solusi-sk-form',
)); ?>
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
            echo "<td>".CHtml::textField($id.'-'.$value['m_induk'].'-1'.'-'.$tahun,$value['Jan'])."</td>";
            echo '<td>'.CHtml::textField($id.'-'.$value['m_induk'].'-2'.'-'.$tahun,$value['Feb']).'</td>';
            echo '<td>'.CHtml::textField($id.'-'.$value['m_induk'].'-3'.'-'.$tahun,$value['Mar']).'</td>';
            echo '<td>'.CHtml::textField($id.'-'.$value['m_induk'].'-4'.'-'.$tahun,$value['Apr']).'</td>';
            echo '<td>'.CHtml::textField($id.'-'.$value['m_induk'].'-5'.'-'.$tahun,$value['May']).'</td>';
            echo '<td>'.CHtml::textField($id.'-'.$value['m_induk'].'-6'.'-'.$tahun,$value['Jun']).'</td>';
            echo '<td>'.CHtml::textField($id.'-'.$value['m_induk'].'-7'.'-'.$tahun,$value['Jul']).'</td>';
            echo '<td>'.CHtml::textField($id.'-'.$value['m_induk'].'-8'.'-'.$tahun,$value['Aug']).'</td>';
            echo '<td>'.CHtml::textField($id.'-'.$value['m_induk'].'-9'.'-'.$tahun,$value['Sep']).'</td>';
            echo '<td>'.CHtml::textField($id.'-'.$value['m_induk'].'-10'.'-'.$tahun,$value['Oct']).'</td>';
            echo '<td>'.CHtml::textField($id.'-'.$value['m_induk'].'-11'.'-'.$tahun,$value['Nov']).'</td>';
            echo '<td>'.CHtml::textField($id.'-'.$value['m_induk'].'-12'.'-'.$tahun,$value['Dec']).'</td>';
            echo '</tr>';

            $second_table.='<tr>
                    <td>'.$value['label'].'</td>
                    <td>'.CHtml::textField('r-'.$id.'-'.$value['m_induk'].'-1'.'-'.$tahun,$value['Janr']).'</td>
                    <td>'.CHtml::textField('r-'.$id.'-'.$value['m_induk'].'-2'.'-'.$tahun,$value['Febr']).'</td>
                    <td>'.CHtml::textField('r-'.$id.'-'.$value['m_induk'].'-3'.'-'.$tahun,$value['Marr']).'</td>
                    <td>'.CHtml::textField('r-'.$id.'-'.$value['m_induk'].'-4'.'-'.$tahun,$value['Aprr']).'</td>
                    <td>'.CHtml::textField('r-'.$id.'-'.$value['m_induk'].'-5'.'-'.$tahun,$value['Mayr']).'</td>
                    <td>'.CHtml::textField('r-'.$id.'-'.$value['m_induk'].'-6'.'-'.$tahun,$value['Junr']).'</td>
                    <td>'.CHtml::textField('r-'.$id.'-'.$value['m_induk'].'-7'.'-'.$tahun,$value['Julr']).'</td>
                    <td>'.CHtml::textField('r-'.$id.'-'.$value['m_induk'].'-8'.'-'.$tahun,$value['Augr']).'</td>
                    <td>'.CHtml::textField('r-'.$id.'-'.$value['m_induk'].'-9'.'-'.$tahun,$value['Sepr']).'</td>
                    <td>'.CHtml::textField('r-'.$id.'-'.$value['m_induk'].'-10'.'-'.$tahun,$value['Octr']).'</td>
                    <td>'.CHtml::textField('r-'.$id.'-'.$value['m_induk'].'-11'.'-'.$tahun,$value['Novr']).'</td>
                    <td>'.CHtml::textField('r-'.$id.'-'.$value['m_induk'].'-12'.'-'.$tahun,$value['Decr']).'</td>
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

    <div class="row buttons">
        <?php echo CHtml::submitButton('Save'); ?>
    </div>
<?php $this->endWidget(); ?>