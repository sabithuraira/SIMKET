<style>
@import url('<?php echo Yii::app()->theme->baseUrl.'/css/baru/jadwal.css';?>');
</style>

<div class="row">

<div class="col-md-12">

    <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Rekapitulasi Nilai Kabupaten/Kota</h3>
        </div>

        
        <div class="box-body">
            <div class="pad margin no-print">
            
                <div class="callout callout-info" style="margin-bottom: 0!important;">
                    <h4><i class="fa fa-info"></i> Note:</h4>
                    <ul>
                        <li>Point maksimal = 5</li>
                    </ul>
                </div>
                <br/>

                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'kegiatan-form',
                    'enableAjaxValidation'=>false,
                )); ?>

                    <div class="center row">
                        <?php echo CHtml::dropDownList('year',$year, HelpMe::getYearForFilter()); ?>
                        <?php echo CHtml::dropDownList('month',$month, HelpMe::getMonthList()); ?>
                        <?php echo CHtml::submitButton('Tampilkan',array('class'=>'btn btn-success btn-xs btn-flat')); ?>
                    </div>

                <?php $this->endWidget(); ?>
            </div>



            <table class="table table-hover table-bordered table-condensed">
                <tr>
                    <th rowspan="2">No. </th>
                    <th rowspan="2" class="text-center">Kabupaten/Kota</th>

                    <th colspan="6" class="text-center">Bidang/Bagian</th>
                    <th colspan="3" class="text-center">Total</th>
                </tr>
                <tr>
                    <th>TATA USAHA</th>
                    <th>SOSIAL</th>
                    <th>PRODUKSI</th>
                    <th>DISTRIBUSI</th>
                    <th>NERWILIS</th>
                    <th>IPDS</th>
                    <th>Kegiatan</th>
                    <th>Target</th>
                    <th>Nilai</th>
                </tr>
                <?php 
                    foreach ($data as $key => $value) { 
                        echo '<tr>';

                        echo '<td>'.($key+1).'</td>';
                        echo '<td>'.CHtml::link($value['code'].$value['name'],array('report/kabupaten','id'=>$value['unitkerja'])).'</td>';
                        echo '<td>'.($value['jumlah_tu']!=0 ? round($value['total_tu']/$value['jumlah_tu'],2) : 0).'</td>';
                        echo '<td>'.($value['jumlah_sosial']!=0 ? round($value['total_sosial']/$value['jumlah_sosial'],2) : 0).'</td>';
                        echo '<td>'.($value['jumlah_produksi']!=0 ? round($value['total_produksi']/$value['jumlah_produksi'],2) : 0).'</td>';
                        echo '<td>'.($value['jumlah_distribusi']!=0 ? round($value['total_distribusi']/$value['jumlah_distribusi'],2) : 0).'</td>';
                        echo '<td>'.($value['jumlah_neraca']!=0 ? round($value['total_neraca']/$value['jumlah_neraca'],2) : 0).'</td>';
                        echo '<td>'.($value['jumlah_ipds']!=0 ? round($value['total_ipds']/$value['jumlah_ipds'],2) : 0).'</td>';

                        echo '<td>'.$value['jumlah_kegiatan'].' </td>';
                        echo '<td>'.$value['jumlah_target'].' </td>';
                        echo '<td>'.$value['point'].' </td>';
                        echo '</tr>';
                    } 
                ?>
            </table>
        </div>      
    </div>
</div>
</div>