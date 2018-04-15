<div class="box box-info">
	<div class="mailbox-controls">
		<b><?php echo $model->pertanyaan; ?></b>
		<div class="pull-right">
			<?php echo CHtml::link("<i class='fa fa-list'></i> Daftar Pertanyaan", array('index'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
			<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
			<?php echo CHtml::link("<i class='fa fa-pencil'></i> Perbaharui", array('update', 'id'=>$model->id), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
			<?php echo CHtml::link("<i class='fa fa-trash'></i> Hapus", "#", array("submit"=>array('delete', 'id'=>$model->id), 'confirm' => 'Anda yakin ingin menghapus data ini?', 'class'=>'btn btn-default btn-sm toggle-event')) ?>
		</div>
	</div>
	<br/>
	<div class="box-body">
		<?php 
			$this->widget('zii.widgets.CDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					'pertanyaan',
					'description',
					array(
						'name'	=>'teruntuk',
						'value'=>$model->peruntukanLabel
					)
				),
			)); 
		?>

		<p></p>
		<u>Daftar Jawaban:</u>
		<p></p>
		<table class="table table-hover table-bordered table-condensed">
			<tr>
				<th class="text-center">Skala Nilai</th>
				<th class="text-center">Option</th>
			</tr>
			<?php
				for($i=1;$i<=4;++$i)
				{
					echo '<tr class="text-center">';
						echo '<td>'.($i).'</td>';
						echo '<td>'.MitraOption::model()->findByAttributes(array('id_pertanyaan'=>$model->id, 'skala'=>$i))->description.'</td>';
					echo '</tr>';
					
				}
			?>
		</table>
	</div>
</div>