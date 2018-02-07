<div id="kabupaten_tag">
    <div class="row">

        <div class="col-md-12">

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $model->name; ?></h3>
                </div>


                <div class="box-body">
                    <div class="pad margin no-print">
                        <div class="form">
                            <?php $form=$this->beginWidget('CActiveForm', array(
                                'id'=>'kegiatan-form',
                                'enableAjaxValidation'=>false,
                            )); ?>
                                <div class="center">
                                    <?php echo "<b>Tampilkan Data Tahun : </b>"; ?>
                                    <input type="hidden" id="id" value="<?php echo $model->id ?>" />
                                    <?php echo CHtml::dropDownList('tahun',$tahun,HelpMe::getYearForFilter()); ?>
                                    <?php echo CHtml::submitButton('Tampilkan',array('class'=>'btn btn-flat btn-sm  btn-success')); ?>
                                </div>

                            <?php $this->endWidget(); ?>
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="span12">
                            <?php
                                $this->beginWidget('zii.widgets.CPortlet', array(
                                    'title'=>"<i class='icon-check'></i> Performa Perbulan",
                                ));
                                
                            ?>

                            <div class="chart">
                                <canvas id="areaChart" style="height:250px"></canvas>
                            </div>
                            <?php $this->endWidget();?>
                        </div>
                    </div>

                    <br/>

                    <div class="row-fluid">
                        <?php foreach (UnitKerja::model()->findAllByAttributes(array('parent'=>1,'jenis'=>1)) as $key => $value) { ?> 
                            <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                <input type="text" class="knob" data-readonly="true" value="<?php echo ReportMe::ValuePerKabBidang($value->id,$model->id,$tahun); ?>" data-max="5" data-width="60" data-height="60" data-fgColor="#39CCCC">

                                <div class="knob-label"><?php echo $value->name; ?></div>
                            </div>
                        
                        <?php } ?>

                    </div>
                    <br/>


                    <?php
                    $this->widget('ext.groupgridview.GroupGridView', array(
                        'id' => 'grid1',
                        'dataProvider' => $data,
                        'mergeColumns' => array('bulan'),  
                        
                    'summaryText'=>Yii::t('penerjemah','Menampilkan {start}-{end} dari {count} hasil'),
                                                'pager'=>array(
                                                    'header'=>Yii::t('penerjemah','Ke halaman : '),
                                                    'prevPageLabel'=>Yii::t('penerjemah','Sebelumnya'),
                                                    'nextPageLabel'=>Yii::t('penerjemah','Selanjutnya'),
                                                    'firstPageLabel'=>Yii::t('penerjemah','Pertama'),
                                                    'lastPageLabel'=>Yii::t('penerjemah','Terakhir'),
                                                    ),
                        'columns' => array(
                            array(
                                'header'        =>'Bulan',
                                'name'          =>'bulan',
                            ),
                            array(
                                'header'        =>'Kegiatan',
                                'name'          =>'kegiatan',
                                'type'          =>'raw',
                                'value'         =>function($data) { return CHtml::link($data["kegiatan"],array("kegiatan/progress","id"=>$data["id"])); }
                            ),
                            array(
                                'header'        =>'Tanggal Berakhir',
                                'name'          =>'end_date',
                                'type'          =>'raw',
                                'value'         =>function($data){ return date("d M Y",strtotime($data["end_date"])); },
                            ),
                            array(
                                'header'        =>'Target',
                                'name'          =>'target',
                            ),
                            array(
                                'header'        =>'Nilai',
                                'name'          =>'timelines_point',
                            ),
                        ),
                        ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<script src="<?php echo $baseUrl;?>/plugins/knob/jquery.knob.js"></script>
<script src="<?php echo $baseUrl;?>/plugins/chartjs/Chart.min.js"></script>
<script src="<?php echo $baseUrl;?>/dist/js/vue_page/report/kabupaten.js"></script>