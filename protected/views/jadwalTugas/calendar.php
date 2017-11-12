<style>
    .scrollme {
        overflow-y: auto;
    }

    td.red {
        background-color: #ff2600 !important;
        color: #fff;
        font-size: 10px;
    }

    td.yellow {
        background-color: #fece44 !important;
        color: #fff;
        font-size: 10px;
    }

    td.gray {
        background-color: #e8e8e8 !important;
    }
</style>

<div class="box box-info" id="calendar_tag">
	<div class="mailbox-controls">
        <b>Kalender Jadwal Tugas - </b>
        <?php echo CHtml::dropDownList('monthid','',HelpMe::getMonthList_singleNumber()); ?>

		<div class="pull-right">
			<?php echo CHtml::link("<i class='fa fa-list'></i> Daftar Jadwal Tugas", array('index'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
		</div>
		<!-- /.pull-right -->
	</div>

	<div class="alert alert-info text-center" id="loading">
		<i class="fa fa-spin fa-refresh"></i>&nbsp; Loading...
    </div>
    
	<div class="box-body">
        <div class="scrollme"> 
            <table class="table table-bordered">
                <thead id="tablehead">
                </thead>

                <tbody id="tablebody">
                </tbody>
            </table>
        </div>
	</div>
</div>

<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<script src="<?php echo $baseUrl;?>/dist/js/vue_page/calendar_tugas.js"></script>