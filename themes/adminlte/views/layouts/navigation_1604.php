<aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu">         
      
        <li class="header">MONITORING EVALUASI KINERJA PEGAWAI BPS</li>

        <?php if(!Yii::app()->user->isGuest){ ?>
          <?php
            if(Yii::app()->user->id != 'guess') 
            {
              echo '<li><a href="'.Yii::app()->createUrl('mitrabps/index').'"><i class="fa fa-user-plus"></i> Kelola Petugas Mitra</a></li>';
              echo '<li><a href="'.Yii::app()->createUrl('pegawai/index').'"><i class="fa fa-user-plus"></i> Kelola Petugas Organik</a></li>';
              echo '<li><a href="'.Yii::app()->createUrl('pertanyaan/index').'"><i class="fa fa-user-plus"></i> Kelola Pertanyaan Penilaian</a></li>';

              echo '<li><a href="'.Yii::app()->createUrl('kegiatan_mitra').'"><i class="fa fa-bicycle"></i><span> Kelola Penilaian Daftar Kegiatan</span></a></li>';
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
            echo '<li><a href="'.Yii::app()->createUrl('simrapor/tagihan').'"><i class="fa fa fa-circle-o"></i> Tagihan Kerja</a></li>';
            echo '<li><a href="'.Yii::app()->createUrl('simrapor/calendar').'"><i class="fa fa fa-circle-o"></i> Kalender Kegiatan</a></li>';
          ?>
          
          <?php 
            $list_provinsi = HelpMe::getListProvinsi();

            foreach($list_provinsi as $row){
              echo '<li><a href="'.Yii::app()->createUrl('simrapor/bidang',array('id'=> $row['id'])).'"><i class="fa fa fa-circle-o"></i> '.$row['label'].'</a></li>';
            }
          ?>
        </ul>
      </li>

      <?php
              echo '<li class="treeview"><a href="#"><i class="fa fa-circle-o"></i> Rapor Penilaian Kinerja
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>';

              echo '<ul class="treeview-menu">';
                echo '<li><a href="'.Yii::app()->createUrl('pegawai/rapor').'"><i class="fa fa-user-plus"></i> Pegawai</a></li>';
                echo '<li><a href="'.Yii::app()->createUrl('mitrabps/rapor').'"><i class="fa fa-user-plus"></i> Mitra BPS</a></li>';
              echo '</ul></li>';
            }


            echo '<li class="treeview"><a href="#"><i class="fa fa-circle-o"></i>  Database Mitra
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>';

            echo '<ul class="treeview-menu">';
              echo '<li><a href="'.Yii::app()->createUrl('mitrabps/dbase').'"><i class="fa fa-user-plus"></i> Daftar Mitra</a></li>';
              echo '<li><a href="'.Yii::app()->createUrl('mitrabps/recommended').'"><i class="fa fa-thumbs-o-up"></i> Mitra Andalan</a></li>';


              if(!Yii::app()->user->isGuest){
                if(Yii::app()->user->id != 'guess') {
                  echo '<li><a href="'.Yii::app()->createUrl('mitrabps/blacklist').'"><i class="fa fa-thumbs-o-down"></i> Mitra Hitam</a></li>';
                }
              }
            echo '</ul></li>';       
          ?>
          
        <?php } ?>


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

