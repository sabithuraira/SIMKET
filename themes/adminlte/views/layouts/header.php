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


          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-file-pdf-o"></i>
              Panduan Penggunaan
              <span class="label label-success">3</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Panduan SIM RAPOR</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="https://laci.bps.go.id/s/rJvvgHkm2KPvl8s">
                      <i class="fa fa-users text-aqua"></i> Panduan Awal
                    </a>
                  </li>
                  <!-- <li>
                    <a href="https://laci.bps.go.id/s/R8Dmm3bIrK1jItI">
                      <i class="fa fa-shopping-cart text-green"></i> MODUL Anggaran
                    </a>
                  </li>

                  <li>
                    <a href="https://laci.bps.go.id/s/1xRoh37hx6kP3zY">
                      <i class="fa fa-sticky-note text-yellow"></i> Slide SIMKET pada BIMTEK TU
                    </a>
                  </li> -->
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
                  <?php echo CHtml::link("Change Password", array("user/cp"),array('class'=>'btn btn-default btn-flat') ) ?>
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