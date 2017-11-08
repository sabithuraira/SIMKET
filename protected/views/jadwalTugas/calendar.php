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
		<b>Kalender Jadwal Tugas - September</b>
		<div class="pull-right">
			<?php echo CHtml::link("<i class='fa fa-list'></i> Daftar Jadwal Tugas", array('index'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
		</div>
		<!-- /.pull-right -->
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

<!-- 
<tr>
                  <td>1.</td>
                  <td class="red">Update software</td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-red">55%</span></td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>Clean database</td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-yellow">70%</span></td>
                </tr> -->