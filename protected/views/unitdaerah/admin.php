<div class="box box-info">
	<div class="mailbox-controls">
		Unit Kerja Kabupaten/Kota
		<div class="pull-right">
			<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah Unit Kerja", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
		</div>
		<!-- /.pull-right -->
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

	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'unit-kerja-daerah-grid',
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
			'nama',
			'kode',
			array(
				'class'=>'CButtonColumn',
			),
		),
	)); ?>
</div>
