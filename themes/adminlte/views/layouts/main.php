<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIMKET</title>
	<?php
	  $baseUrl = Yii::app()->theme->baseUrl; 
	?>
  <script src="<?php echo $baseUrl;?>/dist/js/jquery-1.9.1.js"></script>
  <script src="<?php echo $baseUrl;?>/dist/js/vue.js"></script>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/dist/css/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/dist/css/ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/dist/css/AdminLTE.css">
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/dist/css/farifam.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/plugins/fullcalendar/fullcalendar.min.css">
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/plugins/fullcalendar/fullcalendar.print.css" media="print">
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!-- <body class="hold-transition skin-blue sidebar-mini"> -->
<body class="hold-transition skin-purple sidebar-mini">


<!-- Bootstrap 3.3.6 -->
<script src="<?php echo $baseUrl;?>/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $baseUrl;?>/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $baseUrl;?>/dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo $baseUrl;?>/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo $baseUrl;?>/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo $baseUrl;?>/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo $baseUrl;?>/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?php echo $baseUrl;?>/plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?php echo $baseUrl;?>/dist/js/pages/dashboard2.js"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $baseUrl;?>/dist/js/demo.js"></script>


<div class="wrapper">

  <?php require_once('header.php'); ?>
  
  <?php require_once('navigation.php'); ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
    <section class="content">
      
      <div class="alert alert-success alert-dismissible">
        <i class="icon fa fa-check"></i> Hai.. kami mengubah ketentuan scoring pada SIMKET, lebih detail unduh <a href="https://laci.bps.go.id/s/LLyRmmnQBbjrD5y">disini</a>
      </div>

      <div class="alert alert-warning alert-dismissible">
        <i class="icon fa fa-exclamation"></i> UJI COBA SERVER. <p>Terkait upgrade spesifikasi server BPS Prov SUMSEL, mohon bantuan para pengguna untuk melaporkan ke sabit@bps.go.id apabila menemukan "error" atau "bugs" pada SIMKET & SIMRAPOR. Kami akan berusaha secepat mungkin melakukan perbaikan & penyesuaian,  mohon maaf atas ketidaknyamanannya.</p>
      </div>

        <?php echo $content; ?>
    </section>
  </div>
  <!-- /.content-wrapper -->

  <?php require_once('footer.php'); ?>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

</body>
</html>
