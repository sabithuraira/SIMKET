<header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>KT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SIMKET</b></span>
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
          <!-- User Account: style can be found in dropdown.less -->
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