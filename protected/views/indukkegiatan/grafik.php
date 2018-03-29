<div id="grafik_tag" class="row">
    <div class="col-md-12">
        <div class="box box-info">

            <div class="box-header with-border">
                <b>Table dan Grafik RPD & Realisasi Anggaran</b>
                <?php echo CHtml::dropDownList('unit_line',0,HelpMe::getListEselon3(true)); ?>
                <?php echo CHtml::dropDownList('tahun',date('Y'),HelpMe::getYearForFilter()); ?>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>

            <div class="alert alert-info text-center" id="loading">
                <i class="fa fa-spin fa-refresh"></i>&nbsp; Merefresh grafik, harap tunggu..
            </div>

            <div class="box-body">

                <div class="box box-solid bg-teal-gradient">
                    &nbsp&nbsp<i>Ket: 
                        &nbsp&nbsp<i class="fa fa fa-circle text-primary"></i> Rencana Penarikan Dana
                        &nbsp&nbsp<i class="fa fa fa-circle text-green"></i> Realisasi Anggaran
                    </i>
                    <div class="box-body chart-responsive">
                        <div class="chart" id="line-chart" style="height: 300px;"></div>
                    </div>
                </div>

            </div>


            <div class="box-body">

                <div class="box box-info">
                    <table class="table table-hover table-bordered table-condensed">
                        <tr>
                            <th rowspan="2">No.</th>
                            <th rowspan="2">Unit Kerja</th>
                            <th rowspan="2">Target</th>
                            <th colspan="2" class="text-center">RPD</th>
                            <th colspan="2" class="text-center">Realisasi</th>
                            <th rowspan="2"></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th class="text-center">%</th>
                            <th></th>
                            <th class="text-center">%</th>
                        </tr>
                        <?php
                            foreach($data as $key=>$value){
                                echo '<tr>';
                                echo '<td>'.($key+1).'</td>';
                                echo '<td>'.$value['name'].'</td>';
                                echo '<td>'.number_format($value['target'],2,',','.').'</td>';
                                
                                $total_rpd = 0;
                                $total_real = 0;
                                for($i=1;$i<=12;++$i){
                                    $total_real+= $value['r'.$i];
                                    $total_rpd+= $value['rpd'.$i];
                                }

                                $percent_rpd = ($value['target']<=0) ? 0 : ($total_rpd/$value['target']*100);
                                $percent_real = ($value['target']<=0) ? 0 : ($total_real/$value['target']*100);

                                echo '<td>'.number_format($total_rpd,2,',','.').'</td>';
                                echo '<td>'.number_format($percent_rpd,2).'</td>';
                                echo '<td>'.number_format($total_real,2,',','.').'</td>';
                                echo '<td>'.number_format($percent_real,2).'</td>';
                                echo '<td>'.CHtml::link('Detail',array('uk3','id'=>$value['id'])).'</td>';
                                echo '</tr>';
                            }
                        ?>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<script src="<?php echo $baseUrl;?>//plugins/raphael/raphael.js"></script>
<script src="<?php echo $baseUrl;?>//plugins/morris/morris.min.js"></script>
<script src="<?php echo $baseUrl;?>/dist/js/vue_page/indukkegiatan/grafik.js"></script>