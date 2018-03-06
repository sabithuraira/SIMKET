<div id="grafik_tag" class="row">
    <div class="col-md-12">
        <div class="box box-info">

            <div class="box-body">

                <div class="alert alert-info text-center" id="loading">
                    <i class="fa fa-spin fa-refresh"></i>&nbsp; Merefresh data calendar, harap tunggu..
                </div>

                <div class="box box-info">
                    <div class="box-header with-border">
                        <b>Grafik RPD & Realisasi Anggaran - </b>
                        <?php echo CHtml::dropDownList('unit_line',0,HelpMe::getListEselon3(true)); ?>
                        <?php echo CHtml::dropDownList('tahun',date('Y'),HelpMe::getYearForFilter()); ?>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    &nbsp&nbsp<i>Ket: 
                        &nbsp&nbsp<i class="fa fa fa-circle text-primary"></i> Rencana Penarikan Dana
                        &nbsp&nbsp<i class="fa fa fa-circle text-green"></i> Realisasi Anggaran
                    </i>
                    <div class="box-body chart-responsive">
                        <div class="chart" id="line-chart" style="height: 300px;"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<script src="<?php echo $baseUrl;?>//plugins/raphael/raphael.js"></script>
<script src="<?php echo $baseUrl;?>//plugins/morris/morris.min.js"></script>
<script src="<?php echo $baseUrl;?>/dist/js/vue_page/indukkegiatan/grafik.js"></script>