  <aside class="main-sidebar">
    <section class="sidebar">
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>

      <ul class="sidebar-menu">
        <li class="header">SIMKET</li>
        <?php 
          echo '<li><a href="'.Yii::app()->createUrl('site/index').'"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>';
        ?>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-bicycle"></i>
            <span>Monitoring Kegiatan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php 
              echo '<li><a href="'.Yii::app()->createUrl('site/tagihan').'"><i class="fa fa fa-circle-o"></i> Tagihan Kerja</a></li>';
              echo '<li><a href="'.Yii::app()->createUrl('site/calendar').'"><i class="fa fa fa-circle-o"></i> Kalender Kegiatan</a></li>';
            ?>
            
            <?php 
              $list_provinsi=HelpMe::getListProvinsi();

              foreach($list_provinsi as $row){
                echo '<li><a href="'.Yii::app()->createUrl('site/bidang',array('id'=> $row['id'])).'"><i class="fa fa fa-circle-o"></i> '.$row['label'].'</a></li>';
              }
            ?>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-line-chart"></i>
            <span>Peringkat</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <?php 
              echo '<li><a href="'.Yii::app()->createUrl('site/peringkat').'"><i class="fa fa fa-circle-o"></i> Kabupaten/Kota</a></li>';
              echo '<li><a href="'.Yii::app()->createUrl('site/peringkat_month').'"><i class="fa fa fa-circle-o"></i> Kabupaten/Kota Bulanan</a></li>';
            ?>
          </ul>
        </li>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-bar-chart"></i>
            <span>Nilai Kab/Kota</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php 
              $list_kabupaten=HelpMe::getListKabupaten();

              foreach($list_kabupaten as $row){
                echo '<li><a href="'.Yii::app()->createUrl('report/kabupaten',array('id'=> $row['id'])).'"><i class="fa fa fa-circle-o"></i> '.$row['label'].'</a></li>';
              }
            ?>
          </ul>
        </li>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-money"></i>
            <span>Anggaran</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/charts/chartjs.html"><i class="fa fa fa-circle-o"></i> Report</a></li>
            <li><a href="pages/charts/chartjs.html"><i class="fa fa fa-circle-o"></i> Kelola Data PAGU</a></li>
            <li><a href="pages/charts/chartjs.html"><i class="fa fa fa-circle-o"></i> Kelola Rencana Penarikan</a></li>
            <li><a href="pages/charts/chartjs.html"><i class="fa fa fa-circle-o"></i> Kelola Anggaran</a></li>
            <li><a href="pages/charts/chartjs.html"><i class="fa fa fa-circle-o"></i> Import Data</a></li>
          </ul>
        </li>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-tasks"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/charts/chartjs.html"><i class="fa fa fa-circle-o"></i> Per Kegiatan</a></li>
            <li><a href="pages/charts/chartjs.html"><i class="fa fa fa-circle-o"></i> Bulanan</a></li>
          </ul>
        </li>

        <li class="header">TUGAS DAN DINAS LUAR</li>
        <li><a href="pages/calendar.html"><i class="fa fa-bicycle"></i><span> Buat Surat Tugas</span></a></li>
        <li><a href="pages/calendar.html"><i class="fa fa-bicycle"></i><span> Manajemen Surat Tugas</span></a></li>
        <li><a href="pages/calendar.html"><i class="fa fa-bicycle"></i><span> Kalender Tugas dan DL</span></a></li>
        <li class="header">WILAYAH</li>
          <?php 
            echo '<li><a href="'.Yii::app()->createUrl('mfd/index').'"><i class="fa fa-map-o"></i> Wilayah Sumatera Selatan</a></li>';
          ?>
        <li class="header">LAINNYA</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-align-justify"></i>
            <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php 
              echo '<li><a href="'.Yii::app()->createUrl('user/index').'"><i class="fa fa-user"></i> User</a></li>';
              echo '<li><a href="'.Yii::app()->createUrl('pegawai/index').'"><i class="fa fa-user-plus"></i> Pegawai</a></li>';
              echo '<li><a href="'.Yii::app()->createUrl('kegiatan/index').'"><i class="fa fa-cube"></i> Kegiatan</a></li>';
              echo '<li><a href="'.Yii::app()->createUrl('unitkerja/index').'"><i class="fa fa-building-o"></i> Unit Kerja</a></li>';
            ?>
          </ul>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>