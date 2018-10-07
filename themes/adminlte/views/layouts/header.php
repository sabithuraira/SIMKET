<header class="main-header">

    <!-- Logo -->
    <a href="<?php echo Yii::app()->createUrl('site/index') ?>" class="logo">
      <!-- <span class="logo-mini"><b>S</b>KT</span>
      <span class="logo-lg"><b>SIMKET</b></span> -->
      <span class="logo-mini"><b><?php echo GLabel::$short_title1; ?></b><?php echo GLabel::$short_title2; ?></span>
      <span class="logo-lg"><b><?php echo GLabel::$long_title; ?></b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- <li class="dropdown messages-menu">
            <a href="https://laci.bps.go.id/s/rJvvgHkm2KPvl8s">
              <i class="fa fa-file-pdf-o"></i>
              Panduan Penggunaan
              <span class="label label-success">&#8730;</span>
            </a>
          </li> -->


          <!-- SIMKET -->
          <!-- <li class="dropdown notifications-menu">
            <a href="https://s.bps.go.id/simrapor">
              SIM RAPOR
            </a>
          </li> -->

          <!-- SIM RAPOR -->
          <li class="dropdown notifications-menu">
            <a href="http://s.bps.go.id/simket">
              SIMKET
            </a>
          </li>

          <!-- SIMKET -->
          <!-- <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-file-pdf-o"></i>
              File Kerja BPS1600
            </a>
            <ul class="dropdown-menu">
              <li>
                <ul class="menu">
                  <li>
                    <a href="https://laci.bps.go.id/s/rJvvgHkm2KPvl8s">
                      <i class="fa fa-file-pdf-o text-aqua"></i> Panduan SIMKET
                    </a>
                  </li>
                  <li>
                    <a href="https://laci.bps.go.id/s/R8Dmm3bIrK1jItI">
                      <i class="fa fa-file-pdf-o text-green"></i> Panduan SIMKET Modul Anggaran
                    </a>
                  </li>


                  <li>
                    <a href="https://s.bps.go.id/file_rb1600">
                      <i class="fa fa-gears text-aqua"></i> Direktori Dokumen RB
                    </a>
                  </li>

                  <li>
                    <a href="http://s.bps.go.id/foto1600">
                      <i class="fa fa-file-image-o text-green"></i> Direktori Foto Kegiatan
                    </a>
                  </li>

                  <li>
                    <a href="http://s.bps.go.id/pedoman1600">
                      <i class="fa fa-file-pdf-o text-aqua"></i> Direktori Buku Pedoman Kegiatan
                    </a>
                  </li>

                </ul>
              </li>
            </ul>
          </li> -->

          <!-- SIM RAPOR -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-file-pdf-o"></i>
              File Kerja BPS1600
            </a>
            <ul class="dropdown-menu">
              <li>
                <ul class="menu">
                  <li>
                    <a href="https://laci.bps.go.id/s/yE1z8AP0GZwpDe6">
                      <i class="fa fa-users text-aqua"></i> Panduan SIM Rapor
                    </a>
                  </li>

                  <li>
                    <a href="https://s.bps.go.id/file_rb1600">
                      <i class="fa fa-gears text-aqua"></i> Direktori Dokumen RB
                    </a>
                  </li>

                  <li>
                    <a href="http://s.bps.go.id/foto1600">
                      <i class="fa fa-file-image-o text-aqua"></i> Direktori Foto Kegiatan
                    </a>
                  </li>

                  <li>
                    <a href="http://s.bps.go.id/pedoman1600">
                      <i class="fa fa-file-pdf-o text-aqua"></i> Direktori Buku Pedoman Kegiatan
                    </a>
                  </li>
                </ul>
              </li>

            </ul>
          </li>

          <li class="dropdown user user-menu">
            <?php 
              if(Yii::app()->user->isGuest){ 
                echo CHtml::link("Login", array("site/login"));
              }
              else{  
            ?>
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs">Hallo <?php echo Yii::app()->user->name; ?> !</span>
              </a>
              
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <p>
                    Selamat datang <?php echo Yii::app()->user->name; ?>. Salam PIA!
                    <small>Salam PIA..</small>
                  </p>
                </li>
                
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                  <?php if(Yii::app()->user->id != 'guess') echo CHtml::link("Change Password", array("user/cp"),array('class'=>'btn btn-default btn-flat') ) ?>
                  </div>
                  <div class="pull-right">
                    <?php echo CHtml::link("Sign Out", array("site/logout"),array('class'=>'btn btn-default btn-flat') ) ?>
                  </div>
                </li>
              </ul>
            <?php } ?>
          </li>
        </ul>
      </div>

    </nav>
  </header>