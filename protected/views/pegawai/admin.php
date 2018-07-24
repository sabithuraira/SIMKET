<div class="box box-info">
	<div class="mailbox-controls">
		Pegawai
		<div class="pull-right">
			<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah Pegawai", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
		</div>
	</div>
		  
	<?php
		Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
			$('.search-form').toggle();
			return false;
		});
		$('.search-form form').submit(function(){
			$('#pegawai-grid').yiiGridView('update', {
				data: $(this).serialize()
			});
			return false;
		});
		");
	?>


	<div class="box-body">
		<?php $this->renderPartial('_search',array(
			'model'=>$model
		)); ?>
		<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
		<button id="cetak-surat"  onclick="tableToExcel();" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Download Excel</button>

		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'pegawai-grid',
			'dataProvider'=>$model->search(),

			'summaryText'=>Yii::t('penerjemah','Menampilkan {start}-{end} dari {count} hasil'),
			'pager'=>array(
				'header'=>Yii::t('penerjemah','Ke halaman : '),
				'prevPageLabel'=>Yii::t('penerjemah','Sebelumnya'),
				'nextPageLabel'=>Yii::t('penerjemah','Selanjutnya'),
				'firstPageLabel'=>Yii::t('penerjemah','Pertama'),
				'lastPageLabel'=>Yii::t('penerjemah','Terakhir'),
			),
			
			'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
			
			// 'filter'=>$model,
			'columns'=>array(
				// 'nip',
				// 'nama',
				array(
					'header'	=>'Pegawai',
					'type'=>'raw',
					'value'		=> function($data){ return '<div class="user-block">
						<div class="pull-right">
							<a href="'.Yii::app()->createUrl("pegawai/update", array("id"=>$data->nip)).'" class="btn"><i class="fa fa-edit"></i></a>
						</div>

						<img class="img-circle" src="'.$data->fotoImage.'" alt="User Image">
						<span class="comment">'.$data->jabatan.' - '.$data->unitKerja->name.'</span>
						<span class="username"><a href="'.Yii::app()->createUrl("pegawai/view", array("id"=>$data->nip)).'">'.$data->nama.'</a></span>
						<span class="description">'.$data->nip.'</span>
					  </div>
					  '; },
					// 'filter' => CHtml::listData(UnitKerja::model()->findAll(), 'id', 'name')
				),
				// 'golongan',
				// 'jabatan',
				// 'created_time',
				/*
				'updated_time',
				*/
				// array(
				// 	'header'	=>'',
				// 	'type' 	=>'raw',
				// 	'value'		=> function($data){ return "[".CHtml::link("Update",array("update","id"=>$data->nip))."] [".CHtml::link("Delete",array("delete","id"=>$data->nip))."]"; },
				// ),
				// array(
				// 	'class'=>'CButtonColumn',
				// 	'template' => '{update} {delete}',
				// 	'htmlOptions' => array('width' => 20),
				// 	'buttons'=>array(
				// 		'update'=>array(
				// 			'url'=>function($data){
				// 				return Yii::app()->createUrl("pegawai/update", array("id"=>$data->nip));
				// 			},
				// 		),
				// 		'delete'=>array(
				// 			'url'=>function($data){
				// 				return Yii::app()->createUrl("pegawai/delete", array("id"=>$data->nip));
				// 			},
				// 			'label'=>'Hapus',
				// 		),
				// 	),
				// ),
			),
		)); ?>


		<table id="table-excel" style="display:none" class="table table-hover table-bordered table-condensed">
			<tr>
				<th>NIP</th>
				<th>Nama</th>
				<th>Unit Kerja</th>
				<th>Golongan</th>
				<th>Jabatan</th>
			</tr>
			
			<?php 
				foreach($model->searchAll()->data as $key=>$value){
					echo '<tr>';
					echo '<td>'.$value->nip.'</td>';
					echo '<td>'.$value->nama.'</td>';
					echo '<td>'.$value->unitKerja->name.'</td>';
					echo '<td>'.$value->golongan.'</td>';
					echo '<td>'.$value->jabatan.'</td>';
					echo '</tr>';
				} 
			?>
		</table>
	</div>
</div>


<script>
    var tableToExcel = (function() {   
        
        var uri = "data:application/vnd.ms-excel;base64,",
            template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http:\/\/www.w3.org\/TR\/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}<\/x:Name><x:WorksheetOptions><x:DisplayGridlines\/><\/x:WorksheetOptions><\/x:ExcelWorksheet><\/x:ExcelWorksheets><\/x:ExcelWorkbook><\/xml><![endif]--><\/head><body><table>{table}<\/table><\/body><\/html>',
            base64 = function(s) {
                return window.btoa(unescape(encodeURIComponent(s)));
            },
            format = function(s, c) {
                return s.replace(/{(\w+)}/g, function(m, p) {
                    return c[p];
                });
            };

        return function() {
            table = 'table-excel';
            fileName = 'mitra_bps.xls';
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {
                worksheet: fileName || 'Worksheet', 
                table: table.innerHTML
            }

            $("<a id='dlink'  style='display:none;'></a>").appendTo("body");
                document.getElementById("dlink").href = uri + base64(format(template, ctx))
                document.getElementById("dlink").download = fileName;
                document.getElementById("dlink").click();
        }

    })();  
</script>

