<div class="box box-info" id="single_calendar_tag">
	<div class="mailbox-controls">
        <b>Kalender Pegawai - </b>
        <?php echo CHtml::dropDownList('pegawai_id','',CHtml::listData(Pegawai::model()->findAll(),'nip','nama')); ?>

		<div class="pull-right">
			<?php echo CHtml::link("<i class='fa fa-list'></i> Daftar Jadwal Tugas", array('index'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
		</div>
	</div>
    
	<div class="box-body">
        <div class="alert alert-info text-center" id="loading">
            <i class="fa fa-spin fa-refresh"></i>&nbsp; Merefresh data calendar, harap tunggu..
        </div>
        <div id="calendar"></div>
	</div>
</div>

<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo $baseUrl;?>/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo $baseUrl;?>/dist/js/vue_page/single_calendar.js"></script>