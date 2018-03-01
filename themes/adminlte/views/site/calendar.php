<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<style>
    @import url('<?php echo $baseUrl.'/dist/css/jadwal.css';?>');
</style>
<div class="box box-info" id="calendar_kegiatan_tag">
	<div class="mailbox-controls">
        <b>Kalender Kegiatan - </b>
        <?php echo CHtml::dropDownList('bidang',$bidang,HelpMe::getBidangBosList()); ?>
    </div>
    
    
	<div class="box-body">
        <div class="alert alert-info text-center" id="loading">
            <i class="fa fa-spin fa-refresh"></i>&nbsp; Merefresh data calendar, harap tunggu..
        </div>

        <?php $this->widget('ColorDesc'); ?>

        <div id="calendar"></div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo $baseUrl;?>/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo $baseUrl;?>/dist/js/vue_page/site/calendar_kegiatan.js"></script>