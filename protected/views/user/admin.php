<div class="box box-info">
	<div class="mailbox-controls">
		<b>User</b>
		<div class="pull-right">
			<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah User", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
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
		$('#user-grid').yiiGridView('update', {
			data: $(this).serialize()
		});
		return false;
	});
	");
	?>

		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'user-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,

			'summaryText'=>Yii::t('penerjemah','Menampilkan {start}-{end} dari {count} hasil'),
			'pager'=>array(
				'header'=>Yii::t('penerjemah','Ke halaman : '),
				'prevPageLabel'=>Yii::t('penerjemah','Sebelumnya'),
				'nextPageLabel'=>Yii::t('penerjemah','Selanjutnya'),
				'firstPageLabel'=>Yii::t('penerjemah','Pertama'),
				'lastPageLabel'=>Yii::t('penerjemah','Terakhir'),
			),
			
			'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
			

			'columns'=>array(
				'username',
				'email',
				// 'password',
				// array(
				// 	'value'=>'$data->unitKerja->name'
				// ),

				array(
					'name'	=>'unit_kerja',
					'type'=>'raw',
					'value'		=> function($data){ return $data->unitKerja->name; },
					'filter' => CHtml::listData(UnitKerja::model()->findAll(), 'id', 'name')
				),
				'created_time',
				/*
				'last_login',
				*/
				array(
					'class'=>'CButtonColumn',
				),
			),
		)); ?>
</div>