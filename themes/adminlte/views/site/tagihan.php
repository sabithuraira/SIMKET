<style>
    @import url('<?php echo Yii::app()->theme->baseUrl.'/dist/css/jadwal.css';?>');
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
<div class="row">

    <div class="col-md-12">

        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Kegiatan melewati batas waktu</h3>
            </div>

            <div class="mailbox-controls">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'kegiatan-form',
                        'enableAjaxValidation'=>false,
                )); ?>
                    <?php 
                        echo "<div class='form-group' >";
                        echo "Tampilkan Data Tahun : "; 
                        echo CHtml::dropDownList('tahun',$tahun,HelpMe::getYearForFilter());
                        echo '  &nbsp&nbsp';
                        echo CHtml::submitButton('Tampilkan',array('class'=>'btn btn-success btn-sm'));
                        echo "</div>";
                    ?>
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
                            for($i=0;$i<5;++$i) echo '<i class="fa fa-star text-yellow"></i>';
                            echo ' <b>  [ Terima kasih telah menyelesaikan pekerjaan tepat pada waktunya ]</b></td>';
                            echo '</tr>';   
                        }
                    ?>
                <?php } ?>
            </table>
        </div>
    </div>
</div>