<div class="box box-info">
	<div class="mailbox-controls">
		Mitra BPS
		<div class="pull-right">
			<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah Mitra", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
		</div>
	</div>
		 
	
	<div class="box-body">
		<?php $this->renderPartial('_search',array(
			'model'=>$model
		)); ?>


		<button id="cetak-surat"  onclick="tableToExcel();" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Download Excel</button>

		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider'=>$model->search(),

			'summaryText'=>Yii::t('penerjemah','Menampilkan {start}-{end} dari {count} hasil'),
			'pager'=>array(
				'header'=>Yii::t('penerjemah','Ke halaman : '),
				'prevPageLabel'=>Yii::t('penerjemah','Sebelumnya'),
				'nextPageLabel'=>Yii::t('penerjemah','Selanjutnya'),
				'firstPageLabel'=>Yii::t('penerjemah','Pertama'),
				'lastPageLabel'=>Yii::t('penerjemah','Terakhir'),
			),
			
			'itemsCssClass'=>'table-excel table table-hover table-striped table-bordered table-condensed',
			
			// 'filter'=>$model,
			'columns'=>array(
				array(
					'header'	=>'Mitra BPS',
					'type'=>'raw',
					'value'		=> function($data){ return '<div class="user-block">
						<div class="pull-right">
							<a href="'.Yii::app()->createUrl("mitrabps/update", array("id"=>$data->id)).'" class="btn"><i class="fa fa-edit"></i></a>
						</div>

						<img class="img-circle" src="'.$data->fotoImage.'" alt="User Image">
						<span class="comment">'.$data->kabupaten->name.'</span>
						<span class="username"><a href="'.Yii::app()->createUrl("mitrabps/view", array("id"=>$data->id)).'">'.$data->nama.'</a></span>
						<span class="description">'.$jk = ($data->jk==1 ? "Laki-laki" : "Perempuan").', Alamat: '.$data->alamat.'</span>
					  </div>
					  '; },
					// 'filter' => CHtml::listData(UnitKerja::model()->findAll(), 'id', 'name')
				),
			),
		)); ?>

		<table id="table-excel" style="display:none" class="table table-hover table-bordered table-condensed">
			<tr>
				<th>Nama</th>
				<th>Kabupaten/Kota</th>
				<th>Jenis Kelamin</th>
				<th>Alamat</th>
				<th>Telepon</th>
				<th>Tanggal Lahir</th>
				<th>Pendidikan Terakhir</th>
				<th>Riwayat Kerja</th>
			</tr>
			
			<?php 
				foreach($model->searchAll()->data as $key=>$value){
					echo '<tr>';
					echo '<td>'.$value->nama.'</td>';
					echo '<td>'.$value->kabupaten->name.'</td>';
					echo '<td>'.(($value->jk == 1) ? "Laki-laki" : "Perempuan").'</td>';
					echo '<td>'.$value->alamat.'</td>';
					echo '<td>'.$value->nomor_telepon.'</td>';
					echo '<td>'.$value->tanggal_lahir.'</td>';
					echo '<td>'.(($value->pendidikan!=null) ? $value->pendidikanDropDown[$value->pendidikan] : "-").'</td>';
					echo '<td>'.$value->riwayat.'</td>';
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
