<?php
/* @var $this KegiatanController */
/* @var $model Kegiatan */

$this->breadcrumbs=array(
	'Kegiatan'=>array('index'),
	'Tambah',
);
?>

<div class="box box-info">
	<div class="mailbox-controls">
		<b>Tambah Kegiatan</b>
		<div class="pull-right">
			<?php echo CHtml::link("<i class='fa fa-list'></i> Daftar Pegawai", array('index'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
		</div>
		<!-- /.pull-right -->
	</div>

	<div class="box-body">

		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>