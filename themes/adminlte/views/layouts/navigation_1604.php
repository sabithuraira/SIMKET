<aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu">         
      
        <li class="header">MONITORING EVALUASI KINERJA PEGAWAI BPS</li>

        <?php if(!Yii::app()->user->isGuest){ ?>
          <?php
            echo '<li><a href="'.Yii::app()->createUrl('mitrabps/index').'"><i class="fa fa-user-plus"></i> Kelola Petugas Mitra</a></li>';
            echo '<li><a href="'.Yii::app()->createUrl('pegawai/index').'"><i class="fa fa-user-plus"></i> Kelola Petugas Organik</a></li>';
            echo '<li><a href="'.Yii::app()->createUrl('pertanyaan/index').'"><i class="fa fa-user-plus"></i> Kelola Pertanyaan Penilaian</a></li>';

            echo '<li><a href="'.Yii::app()->createUrl('kegiatan_mitra').'"><i class="fa fa-bicycle"></i><span> Kelola Penilaian Daftar Kegiatan</span></a></li>';

            echo '<li class="treeview"><a href="#"><i class="fa fa-circle-o"></i> Rapor Penilaian Kinerja
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>';

            echo '<ul class="treeview-menu">';
              echo '<li><a href="'.Yii::app()->createUrl('pegawai/rapor').'"><i class="fa fa-user-plus"></i> Pegawai</a></li>';
              echo '<li><a href="'.Yii::app()->createUrl('mitrabps/rapor').'"><i class="fa fa-user-plus"></i> Mitra BPS</a></li>';
            echo '</ul></li>';

            echo '<li><a href="#"><i class="fa fa-user-plus"></i> Database Mitra BPS Kab/Kota</a></li>';            
          ?>
          
        <?php } ?>


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

