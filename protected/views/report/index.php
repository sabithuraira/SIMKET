<style>
    .scrollme {
        overflow-y: auto;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">

            <div class="pad margin no-print">

                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'kegiatan-form',
                    'enableAjaxValidation'=>false,
                )); ?>
                    <div class="center row">
                        <?php echo CHtml::dropDownList('bidang',$bidang,HelpMe::getBidangList()); ?>
                        <?php echo CHtml::dropDownList('tahun',$tahun,HelpMe::getYearForFilter()); ?>
                        <?php echo CHtml::submitButton('Tampilkan',array('class'=>'btn btn-success')); ?>
                    </div>

                <?php $this->endWidget(); 
                    $uvalue=UnitKerja::model()->findByPk($bidang);
                ?>

            </div><!-- form -->

            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/download.jpg" style="padding: 5px" width="35"  id='xlsBtn' title="XLS" onclick="tableToExcel();">
            <div class="scrollme">                 
                <table id="initabel" class="table table-hover table-bordered table-condensed">
                    <tr>
                        <th></th>
                        <th>No. </th>
                        <th>Kegiatan</th>
                        <th>Batas Waktu</th>
                        
                        <th>Target </th>
                        <th>Pengiriman</th>
                        <th>Penerimaan</th>
                        
                        <th>OKU</th>
                        <th>OKI</th>
                        <th>M.E</th>
                        <th>Lahat</th>
                        <th>Mura</th>
                        <th>Muba</th>
                        <th>BA</th>
                        <th>OKUS</th>
                        <th>OKUT</th>
                        <th>OI</th>
                        <th>4Lawang</th>
                        <th>PLG</th>
                        <th>Prabumulih</th>
                        <th>P.A</th>
                        <th>LL</th>
                    </tr>
                    <?php //foreach (UnitKerja::model()->findAllByAttributes(array('jenis'=>1,'parent'=>1)) as $ukey => $uvalue) { ?>
                        <tr><td colspan="22"><h5><?php echo $uvalue->name; ?></h5></td></tr>
                        
                        <?php foreach (UnitKerja::model()->findAllByAttributes(array('parent'=>$uvalue->id)) as $uukey => $uuvalue) { ?>
                            <tr><td colspan="22"><b><?php echo $uuvalue->name; ?></b></td></tr>
                            <?php

                                $criteria = new CDbCriteria;
                                $criteria->condition = "YEAR(end_date)={$tahun}";
                                $criteria->order='end_date';
                                $temp_kegiatan=Kegiatan::model()->findAllByAttributes(
                                    array('unit_kerja'=>$uuvalue->id),$criteria
                                );
                                
                                foreach ($temp_kegiatan as $key => $value)
                                {
                                    echo '<tr>';
                                    echo '<td class="'.$value->TabelClass().'"></td>';
                                    echo '<td>'.($key+1).'</td>';
                                    echo '<td>'.CHtml::link($value->kegiatan,array('kegiatan/progress','id'=>$value->id)).'</td>';
                                    echo '<td>'.date("d M Y",strtotime($value->end_date)).'</td>';
                                    echo '<td>'.$value->getTarget().'</td>';
                                    echo '<td>'.$value->getPercentageProgress(2).' </td>';
                                    if(strlen($value->getPercentageProgress(1))<=50){

                                        echo '<td>'.$value->getPercentageProgress(1).' </td>';
                                        echo '<td>'.$value->getNilaiParticipan(6).' </td>';
                                        echo '<td>'.$value->getNilaiParticipan(8).' </td>';
                                        echo '<td>'.$value->getNilaiParticipan(12).' </td>';
                                        echo '<td>'.$value->getNilaiParticipan(22).' </td>';
                                        echo '<td>'.$value->getNilaiParticipan(21).' </td>';
                                        echo '<td>'.$value->getNilaiParticipan(10).' </td>';
                                        echo '<td>'.$value->getNilaiParticipan(11).' </td>';
                                        echo '<td>'.$value->getNilaiParticipan(7).' </td>';
                                        echo '<td>'.$value->getNilaiParticipan(4).' </td>';
                                        echo '<td>'.$value->getNilaiParticipan(9).' </td>';
                                        echo '<td>'.$value->getNilaiParticipan(23).' </td>';
                                        echo '<td>'.$value->getNilaiParticipan(26).' </td>';
                                        echo '<td>'.$value->getNilaiParticipan(25).' </td>';
                                        echo '<td>'.$value->getNilaiParticipan(27).' </td>';
                                        echo '<td>'.$value->getNilaiParticipan(24).' </td>';

                                    }
                                    else{
                                        echo '<td colspan="16" style="text-align: center;">'.$value->getPercentageProgress(1).' </td>';
                                    }
                                    echo '</tr>';
                                }
                            ?>
                        <?php } ?>
                    <?php //} ?>
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
            fileName = 'bps-file.xls';
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