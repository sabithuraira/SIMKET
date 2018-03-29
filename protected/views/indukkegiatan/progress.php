<div id="progress_tag" class="row">
    <div class="col-md-12">

        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $model->name." ".$model->tahun; ?></h3>
            </div>

            <div class="box-body">
                
                <?php $this->widget('zii.widgets.CDetailView', array(
                    'data'=>$model,
                    'attributes'=>array(
                        array(
                            'name'  =>'name',
                            'value' =>$model->name." ".$model->tahun
                        ),
                        array(
                            'name'  =>'output_id',
                            'value' =>($model->output_id != null || $model->output_id!=0) ? $model->output->name : "",
                        ),
                        array(
                            'name'  =>'unit_kerja_id',
                            'value' =>($model->unit_kerja_id != null || $model->unit_kerja_id!=0) ? $model->unitKerja->name : "",
                        ),
                    ),
                )); ?>

                <br/>

                <div class="alert alert-info text-center" id="loading">
                    <i class="fa fa-spin fa-refresh"></i>&nbsp; Merefresh data calendar, harap tunggu..
                </div>


                <div class="box-header with-border">
                    <b>Grafik RPD & Realisasi Anggaran - </b>
                    <?php echo CHtml::dropDownList('unit_line',0,HelpMe::getListEselon3(true)); ?>
                </div>

                <div class="box box-solid bg-teal-gradient">
                    &nbsp&nbsp<i>Ket: 
                        &nbsp&nbsp<i class="fa fa fa-circle text-primary"></i> Rencana Penarikan Dana
                        &nbsp&nbsp<i class="fa fa fa-circle text-green"></i> Realisasi Anggaran
                    </i>
                    <div class="box-body chart-responsive">
                        <div class="chart" id="line-chart" style="height: 300px;"></div>
                    </div>
                    <!-- /.box-body -->
                </div>

                <center>
                    <?php if(HelpMe::isKabupaten() || Yii::app()->user->getLevel()==1){ ?>
                        <button type="button" class="btn btn-flat btn-primary insert-anggaran" data-toggle="modal" data-target="#myModal">Masukkan Anggaran</button>
                        <button type="button" class="btn btn-flat btn-primary insert-rpd" data-toggle="modal" data-target="#myModalRpd">Masukkan RPD</button>
                    <?php } ?>
                </center>
                <br/>

                <div class="scrollme"> 
                    <table class="table table-hover table-bordered table-condensed">
                        <tr>
                            <th rowspan="2">Unit Kerja </th>
                            <th rowspan="2" class="text-center">Pagu Anggaran </th>
                            <!-- <th colspan="24" class="text-center">Realisasi</th> -->
                            <?php
                                foreach (HelpMe::getMonthListArr() as $key => $value) {
                                    echo '<th colspan="4" class="text-center">'.$value['short_lbl'].'</th>';
                                }
                            ?>
                        </tr>
                        <tr>
                            <?php
                                foreach (HelpMe::getMonthListArr() as $key => $value) {
                                    echo '<th class="text-center">RPD</th>';
                                    echo '<th class="text-center">Real</th>';
                                    echo '<th class="text-center">%</th>';
                                    echo '<th class="text-center">% Kumulatif</th>';
                                }
                            ?>
                        </tr>
                        <?php
                            // foreach (UnitKerja::model()->findAllByAttributes(array('jenis'=>'2'),array('order'=>'code')) as $key => $value)
                            foreach (UnitKerja::model()->findAll('jenis=2 OR (jenis=1 AND parent=1) ORDER BY code') as $key => $value)
                            {
                                $data = $model->getByKabKota($value['id']);
                                $total_real = 0;
                                
                                echo '<tr>';
                                    echo '<th>'.$value['name'].'</th>';
                                    echo '<td>'.number_format($data['target'],2,',','.').'</td>';

                                    for($i=1; $i<=12; ++$i){
                                        $total_real += $data["r$i"];
                                        $percentage_total = 0;
                                        $percentage = 0;

                                        if($data['target']!=0){
                                            $percentage = $data["r$i"] / $data['target']*100;
                                            $percentage_total = $total_real/$data['target']*100;
                                        }

                                        echo '<td>'.number_format($data["rpd$i"],2,',','.').'</td>';
                                        echo '<td>'.number_format($data["r$i"],2,',','.').'</td>';
                                        echo '<td class="text-center">'.number_format($percentage,2).'</td>';
                                        echo '<td class="text-center">'.number_format($percentage_total,2).'</td>';
                                    }
                                echo '</tr>';
                            }
                        ?>
                    </table>

                </div>
                <!-- /.tab-content -->
            </div>









                


                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <span id="myModalLabel">Realisasi Anggaran</span>
                            </div>
                            
                            <div class="modal-body">
                                <form id="InfroTextForm" method="POST">
                                    <table class="table table-hover table-bordered table-condensed">
                                        <tbody>
                                        
                                            <?php if(!HelpMe::isKabupaten()){ ?>
                                            <tr>
                                                <td class="text-center w50">Kabupaten/Kota</td>
                                                <td class="text-center w50">
                                                    <?php 
                                                        echo CHtml::dropDownList('unit_kerja','',HelpMe::getListEselon3(),
                                                                array('empty'=>'- Pilih Unit Kerja-','class'=>'form-control')); 
                                                    ?>
                                                </td>  

                                            </tr>
                                            <?php }else{ echo CHtml::hiddenField('unit_kerja',Yii::app()->user-> getUnitKerja()); } ?>
                                            
                                            <tr>
                                                <td class="text-center w50">Target</td>
                                                <td class="text-center w50">
                                                    <?php echo CHtml::textField('target','',array('size'=>60,'maxlength'=>255, 'class'=>"form-control")); ?>
                                                </td>  
                                            </tr>

                                        
                                        </tbody>
                                    </table>
                                    
                                    <div class="text-center"><b>Realisasi</b></div>
                                    <table class="table table-hover table-striped table-bordered table-condensed">
                                        <tbody>
                                        
                                            <tr>
                                                <td>Jan</td>
                                                <td class="text-center"><?php echo CHtml::textField('r1',''); ?></td>

                                                <td>Feb</td>
                                                <td class="text-center"><?php echo CHtml::textField('r2',''); ?></td>
                                            </tr>

                                            <tr>
                                                <td>Mar</td>
                                                <td class="text-center"><?php echo CHtml::textField('r3',''); ?></td>

                                                <td>Apr</td>
                                                <td class="text-center"><?php echo CHtml::textField('r4',''); ?></td>
                                            </tr>

                                            <tr>
                                                <td>Mei</td>
                                                <td class="text-center"><?php echo CHtml::textField('r5',''); ?></td>

                                                <td>Jun</td>
                                                <td class="text-center"><?php echo CHtml::textField('r6',''); ?></td>
                                            </tr>

                                            <tr>
                                                <td>Jul</td>
                                                <td class="text-center"><?php echo CHtml::textField('r7',''); ?></td>

                                                <td>Agu</td>
                                                <td class="text-center"><?php echo CHtml::textField('r8',''); ?></td>
                                            </tr>

                                            <tr>
                                                <td>Sep</td>
                                                <td class="text-center"><?php echo CHtml::textField('r9',''); ?></td>

                                                <td>Okt</td>
                                                <td class="text-center"><?php echo CHtml::textField('r10',''); ?></td>
                                            </tr>

                                            <tr>
                                                <td>Nov</td>
                                                <td class="text-center"><?php echo CHtml::textField('r11',''); ?></td>

                                                <td>Des</td>
                                                <td class="text-center"><?php echo CHtml::textField('r12',''); ?></td>
                                            </tr>

                                        </tbody>
                                    </table>
                            </form>
                            </div>
                            
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                <button class="btn btn-primary" data-dismiss="modal" id="InfroText">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div id="myModalRpd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <span id="myModalLabel">Rencana Penarikan Dana</span>
                            </div>
                            
                            <div class="modal-body">
                                <form id="InfroTextFormRpd" method="POST">
                                    <table class="table table-hover table-bordered table-condensed">
                                        <tbody>
                                        
                                            <?php if(!HelpMe::isKabupaten()){ ?>
                                            <tr>
                                                <td class="text-center w50">Kabupaten/Kota</td>
                                                <td class="text-center w50">
                                                    <?php 
                                                        echo CHtml::dropDownList('unit_kerjarpd','',HelpMe::getListEselon3(),
                                                                array('empty'=>'- Pilih Unit Kerja-','class'=>'form-control')); 
                                                    ?>
                                                </td>  

                                            </tr>
                                            <?php }else{ echo CHtml::hiddenField('unit_kerjarpd',Yii::app()->user-> getUnitKerja()); } ?>
                                        </tbody>
                                    </table>
                                    
                                    <div class="text-center"><b>Rencana Penarikan Dana</b></div>
                                    <table class="table table-hover table-striped table-bordered table-condensed">
                                        <tbody>
                                        
                                            <tr>
                                                <td>Jan</td>
                                                <td class="text-center"><?php echo CHtml::textField('rpd1',''); ?></td>

                                                <td>Feb</td>
                                                <td class="text-center"><?php echo CHtml::textField('rpd2',''); ?></td>
                                            </tr>

                                            <tr>
                                                <td>Mar</td>
                                                <td class="text-center"><?php echo CHtml::textField('rpd3',''); ?></td>

                                                <td>Apr</td>
                                                <td class="text-center"><?php echo CHtml::textField('rpd4',''); ?></td>
                                            </tr>

                                            <tr>
                                                <td>Mei</td>
                                                <td class="text-center"><?php echo CHtml::textField('rpd5',''); ?></td>

                                                <td>Jun</td>
                                                <td class="text-center"><?php echo CHtml::textField('rpd6',''); ?></td>
                                            </tr>

                                            <tr>
                                                <td>Jul</td>
                                                <td class="text-center"><?php echo CHtml::textField('rpd7',''); ?></td>

                                                <td>Agu</td>
                                                <td class="text-center"><?php echo CHtml::textField('rpd8',''); ?></td>
                                            </tr>

                                            <tr>
                                                <td>Sep</td>
                                                <td class="text-center"><?php echo CHtml::textField('rpd9',''); ?></td>

                                                <td>Okt</td>
                                                <td class="text-center"><?php echo CHtml::textField('rpd10',''); ?></td>
                                            </tr>

                                            <tr>
                                                <td>Nov</td>
                                                <td class="text-center"><?php echo CHtml::textField('rpd11',''); ?></td>

                                                <td>Des</td>
                                                <td class="text-center"><?php echo CHtml::textField('rpd12',''); ?></td>
                                            </tr>

                                        </tbody>
                                    </table>
                            </form>
                            </div>
                            
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                <button class="btn btn-primary" data-dismiss="modal" id="InfroTextRpd">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

                <input id="idnya" type="hidden" value="<?php  echo $model->id; ?>">
                
            </div>
        </div>
    </div>
</div>

<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<script src="<?php echo $baseUrl;?>//plugins/raphael/raphael.js"></script>
<script src="<?php echo $baseUrl;?>//plugins/morris/morris.min.js"></script>
<script src="<?php echo $baseUrl;?>/dist/js/vue_page/indukkegiatan/progress.js"></script>