<?php
/* @var $this KegiatanController */
/* @var $model Kegiatan */

$this->breadcrumbs=array(
	'Kegiatan'=>array('index'),
	$model->kegiatan=>array('view','id'=>$model->id),
	'Update',
);

if(HelpMe::isAuthorizeUnitKerja($model->unit_kerja))
{

?>
	<div class="box box-info">
		<div class="mailbox-controls">
			<b>Update Kegiatan <?php echo $model->kegiatan; ?></b>
			<div class="pull-right">
				<?php echo CHtml::link("<i class='fa fa-list'></i> Daftar Pegawai", array('index'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
				<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah Pegawai", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
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