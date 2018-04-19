<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<style>
    @import url('<?php echo $baseUrl.'/dist/css/jadwal.css';?>');
</style>
<div id="dashboard_tag">
    <div class="text-center">
        <h2>SIM RAPOR</h2>
    </div>
    <div class="text-center widget-user-image">
        <img src="<?php echo Yii::app()->theme->baseUrl."/dist/img/dashboard_1604.jpg" ?>">
    </div>
</div>

      
<script src="<?php echo $baseUrl;?>/plugins/knob/jquery.knob.js"></script>
<script src="<?php echo $baseUrl;?>/plugins/chartjs/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo $baseUrl;?>/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo $baseUrl;?>//plugins/raphael/raphael.js"></script>
<script src="<?php echo $baseUrl;?>//plugins/morris/morris.min.js"></script>
<script src="<?php echo $baseUrl;?>/dist/js/vue_page/site/dashboard.js"></script>