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
$this->menu=array(
	array('label'=>'<i class="icon-th-list"></i>  List Kegiatan', 'url'=>array('index')),
	array('label'=>'<i class="icon-plus-sign"></i> Tambah Kegiatan', 'url'=>array('create')),
);
?>

<h1>Update Kegiatan <?php echo $model->kegiatan; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>

<?php
}
else
{
    ?>
<div class="page-header">
    <h1>Anda Tidak Memiliki Autorisasi Pada Halaman Ini</h1>
</div>
<?php
}
?>