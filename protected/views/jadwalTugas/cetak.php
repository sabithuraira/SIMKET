<div id="review_tag">

    <input type="hidden" id="id-jadwal" value="<?php echo $model->id; ?>" />
    <input type="hidden" id="no-jadwal" value="<?php echo $model->print_no; ?>" />
    <?php $this->renderPartial('surat_tugas', array('model'=>$model)); ?>
</div>

<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<script src="<?php echo $baseUrl;?>/dist/js/vue_page/cetak_tugas.js"></script>