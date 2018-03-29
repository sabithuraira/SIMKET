<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<style>
    @import url('<?php echo $baseUrl.'/dist/css/jadwal.css';?>');
</style>
<div id="dashboard_tag">
      <!-- Main row -->
      <div class="row">
        

        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">


          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Resume Kegiatan <?php echo date('Y'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="pieChart" height="150"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul class="chart-legend clearfix">
                    <li><i class="fa fa-circle-o text-red"></i> Terlambat</li>
                    <li><i class="fa fa-circle-o text-green"></i> Tepat Waktu</li>
                    <li><i class="fa fa-circle-o text-yellow"></i> Belum Selesai</li>
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-xs-6 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60" data-fgColor="#39CCCC">

                  <div class="knob-label">% Realisasi Response Rate</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-6 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgColor="#39CCCC">

                  <div class="knob-label">% Realisasi Anggaran</div>
                </div>
                <!-- ./col -->
              </div>
            </div>
            <!-- /.footer -->
          </div>

          <div class="box box-solid bg-teal-gradient">
            <div class="box-header with-border">
              <i class="fa fa-th"></i>
              <h3 class="box-title">Grafik RPD & Realisasi Anggaran</h3>
              <div class="pull-right box-tools">
                <a type="button" href="<?php echo Yii::app()->createUrl('indukkegiatan/grafik'); ?>" class="btn btn-default btn-sm" style="color:#fff"><u><b>Selengkapnya >></b></u></a>
              </div>
            </div>
            <div class="box-body">
              &nbsp&nbsp<i>Ket: 
                  &nbsp&nbsp<i class="fa fa fa-circle text-primary"></i> Rencana Penarikan Dana
                  &nbsp&nbsp<i class="fa fa fa-circle text-green"></i> Realisasi Anggaran
              </i>
              <div class="chart">
                <div class="chart" id="anggaran-chart" style="height: 300px;"></div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <?php
            $this->widget('WJuara', array(
              'kab_name'    =>  $peringkat1tahun['name'],
              'title_name'  =>  'Peringkat 1 Tahun '.date('Y'),
              'color'       =>  'aqua',
              'kegiatan'    =>  $peringkat1tahun['jumlah_kegiatan'],
              'target'      =>  $peringkat1tahun['jumlah_target'],
              'point'       =>  $peringkat1tahun['point'],
              'url'         =>  $peringkat1tahun['url'],
            ));


            $this->widget('WJuara', array(
              'kab_name'    =>  $peringkat1bulan['name'],
              'title_name'  =>  'Peringkat 1 Bulan '.date('F').' Tahun '.date('Y'),
              'color'       =>  'green',
              'kegiatan'    =>  $peringkat1bulan['jumlah_kegiatan'],
              'target'      =>  $peringkat1bulan['jumlah_target'],
              'point'       =>  $peringkat1bulan['point'],
              'url'         =>  $peringkat1bulan['url'],
            ));
          ?>

          <!-- Calendar -->
          <div class="box box-solid bg-green-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">Calendar</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                
                <a type="button" href="<?php echo Yii::app()->createUrl('site/calendar'); ?>" class="btn btn-success btn-sm">Selengkapnya</a>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <!--The calendar -->
              <div id="calendar" style="width: 100%"></div>
            </div>
            
          </div>
          <!-- /.box -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
</div>

      
<script src="<?php echo $baseUrl;?>/plugins/knob/jquery.knob.js"></script>
<script src="<?php echo $baseUrl;?>/plugins/chartjs/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo $baseUrl;?>/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo $baseUrl;?>//plugins/raphael/raphael.js"></script>
<script src="<?php echo $baseUrl;?>//plugins/morris/morris.min.js"></script>
<script src="<?php echo $baseUrl;?>/dist/js/vue_page/site/dashboard.js"></script>