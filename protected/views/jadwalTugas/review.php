<div id="review_tag">
    <div class="col-md-3">

        <div class="box box-solid clearfix">
            <blockquote class="pull-right">
            <small>Nomor surat bergantung pada pejabat yang menandatangan.</small>
            </blockquote>
        </div>

        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Tanda tangan oleh:</h3>
            </div>

            <div class="box-body">
                <?php
                    echo CHtml::dropDownList('ttd', '', 
                        CHtml::listData(UnitKerjaDaerah::model()->findAll(), 'id', 'nama'),
                        array('class'=>'form-control'));
                ?>
                <input type="hidden" id="id-jadwal" value="<?php echo $model->id; ?>" />
                <input type="hidden" id="no-jadwal" value="<?php echo $model->print_no; ?>" />
                <br/>

                <p>
                    <button type="button" id="btn-save" class="btn bg-blue btn-flat form-control" v-bind:class="{ disabled: !is_allow_simpan }">Simpan Nomor Surat</button>
                </p>

                <p>
                    <button type="button" id="btn-print" class="btn bg-green btn-flat form-control" v-bind:class="{ disabled: is_allow_simpan }">Cetak Surat</button>
                </p>
            </div>

        </div>
        
    </div>

    <div class="col-md-9">
        <div class="box box-solid">
            <?php $this->renderPartial('surat_tugas', array('model'=>$model)); ?>
        </div>
    </div>
</div>

<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<script src="<?php echo $baseUrl;?>/dist/js/vue_page/review_tugas.js"></script>