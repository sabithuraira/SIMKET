<?php
/* @var $this PegawaiController */
/* @var $model Pegawai */

$this->breadcrumbs=array(
	'Pegawais'=>array('index'),
	$model->nip=>array('view','id'=>$model->nip),
	'Update',
);
?>


<div class="box box-info">
	<div class="mailbox-controls">
		<b>Update Pegawai <?php echo $model->nama; ?></b>
		<div class="pull-right">
			<?php echo CHtml::link("<i class='fa fa-list'></i> Daftar Pegawai", array('index'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
			<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
			<?php echo CHtml::link("<i class='fa fa-search'></i> Detail", array('view', "id"=>$model->nip), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
		</div>
	</div>

	<div class="box-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>