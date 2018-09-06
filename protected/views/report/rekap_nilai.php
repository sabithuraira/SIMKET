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
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/download.jpg" style="padding: 5px" width="35"  id='xlsBtn' title="XLS" onclick="tableToExcel();">


            <table id="initabel" class="table table-hover table-bordered table-condensed">
                <tr>
                    <th rowspan="3">No. </th>
                    <th rowspan="3" class="text-center">Kabupaten/Kota</th>

                    <th colspan="12" class="text-center">Bidang/Bagian</th>
                    <th colspan="3" class="text-center">Total</th>
                </tr>
                <tr>
                    <th colspan="2">TATA USAHA</th>
                    <th colspan="2">SOSIAL</th>
                    <th colspan="2">PRODUKSI</th>
                    <th colspan="2">DISTRIBUSI</th>
                    <th colspan="2">NERWILIS</th>
                    <th colspan="2">IPDS</th>
                    <th rowspan="2" >Kegiatan</th>
                    <th rowspan="2" >Target</th>
                    <th rowspan="2" >Nilai</th>
                </tr>
                <tr>
                    <?php
                        for($i=0;$i<6;++$i) { 
                            echo '<th>Nilai</th>'; 
                            echo '<th>CKP</th>';
                        }
                    ?>
                </tr>
                <?php 
                    foreach ($data as $key => $value) { 
                        $n_tu = ($value['jumlah_tu']!=0 ? round($value['total_tu']/$value['jumlah_tu'],2) : 0);
                        $n_sosial = ($value['jumlah_sosial']!=0 ? round($value['total_sosial']/$value['jumlah_sosial'],2) : 0);
                        $n_produksi = ($value['jumlah_produksi']!=0 ? round($value['total_produksi']/$value['jumlah_produksi'],2) : 0);
                        $n_distribusi = ($value['jumlah_distribusi']!=0 ? round($value['total_distribusi']/$value['jumlah_distribusi'],2) : 0);
                        $n_neraca = ($value['jumlah_neraca']!=0 ? round($value['total_neraca']/$value['jumlah_neraca'],2) : 0);
                        $n_ipds = ($value['jumlah_ipds']!=0 ? round($value['total_ipds']/$value['jumlah_ipds'],2) : 0);
                        echo '<tr>';

                        echo '<td>'.($key+1).'</td>';
                        echo '<td>'.CHtml::link('('.$value['code'].') '.$value['name'],array('report/kabupaten','id'=>$value['unitkerja'])).'</td>';
                        echo '<td>'.$n_tu.'</td>';
                        echo '<td>'.($n_tu*20).'</td>';
                        echo '<td>'.$n_sosial.'</td>';
                        echo '<td>'.($n_sosial*20).'</td>';
                        echo '<td>'.$n_produksi.'</td>';
                        echo '<td>'.($n_produksi*20).'</td>';
                        echo '<td>'.$n_distribusi.'</td>';
                        echo '<td>'.($n_distribusi*20).'</td>';
                        echo '<td>'.$n_neraca.'</td>';
                        echo '<td>'.($n_neraca*20).'</td>';
                        echo '<td>'.$n_ipds.'</td>';
                        echo '<td>'.($n_ipds*20).'</td>';

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



<script>
    var tableToExcel = (function() {   
        
        var uri = "data:application/vnd.ms-excel;base64,",
            template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http:\/\/www.w3.org\/TR\/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}<\/x:Name><x:WorksheetOptions><x:DisplayGridlines\/><\/x:WorksheetOptions><\/x:ExcelWorksheet><\/x:ExcelWorksheets><\/x:ExcelWorkbook><\/xml><![endif]--><\/head><body><table>{table}<\/table><\/body><\/html>',
            base64 = function(s) {
                return window.btoa(unescape(encodeURIComponent(s)));
            },
            format = function(s, c) {
                return s.replace(/{(\w+)}/g, function(m, p) {
                    return c[p];
                });
            };

        return function() {
            table = 'initabel';
            fileName = 'rekapitulasi.xls';
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {
                worksheet: fileName || 'Worksheet', 
                table: table.innerHTML
            }

            $("<a id='dlink'  style='display:none;'></a>").appendTo("body");
                document.getElementById("dlink").href = uri + base64(format(template, ctx))
                document.getElementById("dlink").download = fileName;
                document.getElementById("dlink").click();
        }

    })();  
</script>