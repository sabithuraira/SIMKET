<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Peringkat Kabupaten/Kota hingga saat ini</h3>
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

                        <div class="center">
                            <?php echo CHtml::dropDownList('bidang',$bidang,HelpMe::getBidangBosList()); ?>
                            <?php echo CHtml::dropDownList('tahun',$tahun,HelpMe::getYearForFilter()); ?>
                            <?php echo CHtml::submitButton('Tampilkan',array('class'=>'btn btn-success btn-xs btn-flat')); ?>
                            <button class="btn btn-success btn-xs btn-flat" onclick="tableToExcel();">Cetak Excel</button>
                        </div>

                    <?php $this->endWidget(); ?>
                </div>

                <table id="initabel" class="table table-hover table-striped table-bordered table-condensed">
                    <caption><?php echo "Peringkat Bulanan Kab/Kota Tahun ".$tahun; ?></caption>  
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
            fileName = 'peringkat_tahunan.xls';
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