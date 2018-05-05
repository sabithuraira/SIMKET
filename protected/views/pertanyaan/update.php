<?php
if(Yii::app()->user->level<=2)
{
?>
	<div class="box box-info">
		<div class="mailbox-controls">
			<b>Update Pertanyaan <?php echo $model->pertanyaan; ?></b>
			<div class="pull-right">
				<?php echo CHtml::link("<i class='fa fa-list'></i> Daftar Pertanyaan", array('index'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
				<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah Pertanyaan", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
			</div>
			<!-- /.pull-right -->
		</div>

		<div class="box-body">
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
	</div>
<?php } else { ?>
	<div class="page-header">
		<h1>Anda Tidak Memiliki Autorisasi Pada Halaman Ini</h1>
	</div>
<?php } ?>