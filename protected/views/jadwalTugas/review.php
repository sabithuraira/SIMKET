<div id="calendar_tag">
    <div class="col-md-3">

        <div class="box box-solid clearfix">
            <blockquote class="pull-right">
            <small>Nomor surat bergantung pada pejabat yang menandatangan.</small>
            </blockquote>
        </div>
<!-- 
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Nomor Surat</h3>
            </div>

            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="#">Inbox</a></li>
                </ul>
            </div>
        </div> -->

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
<script src="<?php echo $baseUrl;?>/dist/js/vue_page/calendar_tugas.js"></script>