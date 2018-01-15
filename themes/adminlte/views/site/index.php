<div id="dashboard_tag">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
        <?php
          $this->widget('WJuara', array(
            'kab_name'    =>  $peringkat1tahun['name'],
            'title_name'  =>  'Peringkat 1 Tahun '.date('Y'),
            'color'       =>  'aqua',
            'kegiatan'    =>  $peringkat1tahun['jumlah_kegiatan'],
            'target'      =>  $peringkat1tahun['jumlah_target'],
            'point'       =>  $peringkat1tahun['point']
          ));


          $this->widget('WJuara', array(
            'kab_name'    =>  $peringkat1bulan['name'],
            'title_name'  =>  'Peringkat 1 Bulan '.date('F').' Tahun '.date('Y'),
            'color'       =>  'green',
            'kegiatan'    =>  $peringkat1bulan['jumlah_kegiatan'],
            'target'      =>  $peringkat1bulan['jumlah_target'],
            'point'       =>  $peringkat1bulan['point']
          ));
        ?>

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

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

      
<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo $baseUrl;?>/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo $baseUrl;?>/dist/js/vue_page/site/dashboard.js"></script>

