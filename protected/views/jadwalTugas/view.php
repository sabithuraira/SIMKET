<?php
/* @var $this JadwalTugasController */
/* @var $model JadwalTugas */

$this->breadcrumbs=array(
	'Jadwal Tugases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List JadwalTugas', 'url'=>array('index')),
	array('label'=>'Create JadwalTugas', 'url'=>array('create')),
	array('label'=>'Update JadwalTugas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete JadwalTugas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JadwalTugas', 'url'=>array('admin')),
);
?>

<h1>View JadwalTugas #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nama_kegiatan',
		'tanggal_mulai',
		'tanggal_berakhir',
		'pegawai_id',
		'penjelasan',
		'created_time',
		'updated_time',
		'created_by',
		'updated_by',
	),
)); ?>
