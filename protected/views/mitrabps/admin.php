<div class="box box-info">
	<div class="mailbox-controls">
		Mitra BPS
		<div class="pull-right">
			<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah Mitra", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
		</div>
	</div>
		  
	<?php
		Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
			$('.search-form').toggle();
			return false;
		});
		$('.search-form form').submit(function(){
			$('#mitra-bps-grid').yiiGridView('update', {
				data: $(this).serialize()
			});
			return false;
		});
		");
	?>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'mitra-bps-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			'nama',
			array(
				'name'	=>'kab_id',
				'type'=>'raw',
				'value'		=> function($data){ return $data->kabupaten->name; },
				'filter' => CHtml::listData(UnitKerja::model()->findAllByAttributes(array('jenis'=>2)), 'id', 'name')
			),
			'nomor_telepon',
			'alamat',
			'tanggal_lahir',
			'jk',

			array(
				'class'=>'CButtonColumn',
				'template' => '{view} {update} {delete}',
				'htmlOptions' => array('width' => 20),
				'buttons'=>array(
					'update'=>array(
						'url'=>function($data){
							return Yii::app()->createUrl("mitrabps/update", array("id"=>$data->id));
						},
					),
					'view'=>array(
						'url'=>function($data){
							return Yii::app()->createUrl("mitrabps/view", array("id"=>$data->id));
						},
					),
					'delete'=>array(
						'url'=>function($data){
							return Yii::app()->createUrl("mitrabps/delete", array("id"=>$data->id));
						},
						'label'=>'Hapus',
					),
				),
			),
		),
	)); ?>
</div>
