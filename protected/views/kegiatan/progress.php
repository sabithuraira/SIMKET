<div class="row">

    <div class="col-md-12">

        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $model->kegiatan; ?></h3>
            </div>

            
            <div class="box-body">

                <?php $this->widget('zii.widgets.CDetailView', array(
                    'data'=>$model,
                    'attributes'=>array(
                        //'id',
                        'kegiatan',
                        array(
                            'name'  =>'unit_kerja',
                            'value' =>$model->unitKerja->name
                        ),

                        array(
                            'name'  =>'jenis_kegiatan',
                            'value' =>$model->jenisKegiatan,
                        ),
                        array(
                            'name'  =>'start_date',
                            'value' =>HelpMe::HrDate($model->start_date),
                        ),
                        array(
                            'name'  =>'end_date',
                            'value' =>HelpMe::HrDate($model->end_date),
                        ),
                        //'start_date',
                        //'end_date',
                    ),
                )); ?>

                <br/>


                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_progress" data-toggle="tab">Progress</a></li>
                        <li><a href="#tab_anggaran" data-toggle="tab">Anggaran</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_progress">

                            <?php if(HelpMe::isKabupaten() || HelpMe::isAuthorizeUnitKerja($model->unit_kerja)){ ?>
                            <a href="#myModal2" role="button" class="btn" data-toggle="modal">Tambah Pengiriman</a>
                            <?php }if(HelpMe::isAuthorizeUnitKerja($model->unit_kerja)){ ?>
                            <a href="#myModal" role="button" class="btn" data-toggle="modal">Konfirmasi Penerimaan</a>
                            <?php echo CHtml::link('Cetak Surat',array('kegiatan/pdfinfo','id'=>$model->id),array('class'=>'btn')); ?>
                            <?php } ?>

                            <div class="alert alert-info">
                            <strong>Ket !</strong> [ RR= Response Rate, kuantitas dokumen/pekerjaan yang dikumpulkan ] |
                            [ Timelines= Ketepatan waktu pengumpulan dokumen/pekerjaan ]<br/>

                            </div>

                            <table class="table table-hover table-bordered table-condensed">
                                <tr>
                                    <th rowspan="2">No. </th>
                                    <th rowspan="2">Unit Kerja </th>
                                    <th rowspan="2">Target </th>
                                    <th colspan="3">Pengiriman</th>
                                    <th colspan="3">Penerimaan</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th>RR (%)</th>
                                    <th>Ketepatan Waktu</th>
                                    <th></th>
                                    <th>RR (%)</th>
                                    <th>Ketepatan Waktu</th>
                                </tr>
                                <?php
                                    //foreach (Participant::model()->findAllByAttributes(array('kegiatan'=>$model->id)) as $key => $value)
                                    foreach (Participant::model()->PerKegiatan($model->id)->data as $key => $value)
                                    {
                                        echo '<tr>';

                                            echo '<td>'.($key+1).'</td>';
                                            echo '<td>'.$value->unitkerja0->name.'</td>';
                                            echo '<td>'.$value->target.'</td>';
                                        
                                            echo '<td>'.$value->getListProgressDelivery().'</td>';
                                            echo '<td class="'.$value->getClassProgress(2).'">'.$value->getPercentageProgress(2).' % </td>';
                                            ?>
                                            <td>
                                                <?php
                                                    $this->widget('Star', array('starNumber'=>$value->getTimelinesSkor(2)));
                                                ?>
                                            </td>
                                            <?php
                                            echo '<td>'.$value->getListProgressAcceptance().'</td>';
                                            echo '<td class="'.$value->getClassProgress(1).'">'.$value->getPercentageProgress(1).' % </td>';
                                            ?>
                                            <td>
                                                <?php
                                                    $this->widget('Star', array('starNumber'=>$value->getTimelinesSkor(1)));
                                                ?>
                                            </td>
                                            <?php
                                        echo '</tr>';
                                        
                                    }

                                    echo '<tr>';

                                            echo '<td colspan="2"><h4>Total</h4></td>';
                                            echo '<td><h4>'.$model->getTarget().'</h4></td>';
                                        
                                            echo '<td><h4>'.$model->getPercentageProgress(2).'</h4></td>';
                                            echo '<td><h4> '.($model->getTarget()==0 ? 0 : round($model->getPercentageProgress(2)/$model->getTarget()*100,2)).'% </h4></td>';
                                            echo '<td><h4> '.($model->getTarget()==0 ? 0 : round($model->getPercentageProgress(2)/$model->getTarget()*100,2)).'% </h4></td>';

                                            echo '<td><h4>'.$model->getPercentageProgress(1).'</h4></td>';
                                            echo '<td><h4>'.($model->getTarget()==0 ? 0 : round($model->getPercentageProgress(1)/$model->getTarget()*100,2)).' % </h4></td>';
                                            echo '<td><h4>'.($model->getTarget()==0 ? 0 : round($model->getPercentageProgress(1)/$model->getTarget()*100,2)).' % </h4></td>';
                                        echo '</tr>';
                                ?>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_anggaran">
                        

                            <table class="table table-hover table-bordered table-condensed">
                                <tr>
                                    <th>No. </th>
                                    <th>Unit Kerja </th>
                                    <th>Target </th>
                                    <th>Realisasi</th>
                                    <th>Selisih</th>
                                </tr>

                                <?php
                                    foreach (Participant::model()->PerKegiatan($model->id)->data as $key => $value)
                                    {
                                        echo '<tr>';

                                            echo '<td>'.($key+1).'</td>';
                                            echo '<td>'.$value->unitkerja0->name.'</td>';
                                            echo '<td>'.$value->target_anggaran.'</td>';
                                        
                                            echo '<td>'.$value->getListProgressDelivery().'</td>';
                                            echo '<td class="'.$value->getClassProgress(2).'">'.$value->getPercentageProgress(2).' % </td>';
                                            ?>
                                            
                                            <?php
                                        echo '</tr>';
                                        
                                    }

                                    echo '<tr>';

                                            echo '<td colspan="2"><h4>Total</h4></td>';
                                            echo '<td><h4>'.$model->getTarget().'</h4></td>';
                                        
                                            echo '<td><h4>'.$model->getPercentageProgress(2).'</h4></td>';
                                            echo '<td><h4> '.($model->getTarget()==0 ? 0 : round($model->getPercentageProgress(2)/$model->getTarget()*100,2)).'% </h4></td>';
                                        echo '</tr>';
                                ?>
                            </table>
                        </div>
                    
                    </div>
                    <!-- /.tab-content -->
                </div>


                <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">Konfirmasi Penerimaan</h3>
                    </div>
                    
                    <div class="modal-body">
                        <form id="InfroText" method="POST">
                
                            <input name="InfroText" value="1" type="hidden">
                    
                            <table>
                                <tbody>
                                
                                    <tr>
                                        <td>Kabupaten/Kota</td>
                                        <td>
                                            <?php 
                                                echo CHtml::dropDownList('unit_kerja','',
                                                        CHtml::listData(Participant::model()->PerKegiatan($model->id)->data,
                                                            'unitkerja','unitkerja0.name'),
                                                        array('empty'=>'- Pilih Unit Kerja-')); 
                                            ?>
                                        </td>  

                                    </tr>

                                    <tr>
                                        <td>Tanggal Penerimaan</td>
                                        <td>
                                            <?php 
                                                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                                    'name'=>'tanggal',
                                                    'options' => array(
                                                        'dateFormat'=>'yy-mm-dd',
                                                        //'changeYear'=>true,
                                                        //'changeMonth'=>true,
                                                    ),
                                                ));
                                            ?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Jumlah</td>
                                        <td>
                                            <?php echo CHtml::textField('jumlah',''); ?>
                                        </td>
                                    </tr>

                                    <input id="idnya" type="hidden" value="<?php  echo $model->id; ?>">
                                    <input id="vid2" type="hidden" value="">
                                </tbody>
                            </table>
                    </form>
                    </div>
                    
                    <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn btn-primary" data-dismiss="modal" id="InfroTextSubmit">Save changes</button>
                    </div>
                </div>

                <div id="myModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">Tambah Pengiriman</h3>
                    </div>
                    
                    <div class="modal-body">
                        <form id="InfroText2" method="POST">
                
                            <input name="InfroText" value="1" type="hidden">
                    
                            <table>
                                <tbody>
                                    <?php if(!HelpMe::isKabupaten()){ ?>
                                    <tr>
                                        <td>Kabupaten/Kota</td>
                                        <td>
                                            <?php 
                                                echo CHtml::dropDownList('unit_kerja2','',
                                                        CHtml::listData(Participant::model()->PerKegiatan($model->id)->data,
                                                            'unitkerja','unitkerja0.name'),
                                                        array('empty'=>'- Pilih Unit Kerja-')); 
                                            ?>
                                        </td>  

                                    </tr>
                                    <?php }else{ echo CHtml::hiddenField('unit_kerja2',Yii::app()->user-> getUnitKerja()); } ?>

                                    <tr>
                                        <td>Tanggal Pengiriman</td>
                                        <td>
                                            <?php 
                                                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                                    'name'=>'tanggal2',
                                                    'options' => array(
                                                        'dateFormat'=>'yy-mm-dd',
                                                        //'changeYear'=>true,
                                                        //'changeMonth'=>true,
                                                    ),
                                                ));
                                            ?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Jumlah</td>
                                        <td>
                                            <?php echo CHtml::textField('jumlah2',''); ?>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>Dikirim melalui</td>
                                        <td>
                                            <?php echo CHtml::textField('via',''); ?>
                                        </td>
                                    </tr>

                                    <input id="idnya" type="hidden" value="<?php  echo $model->id; ?>">
                                    <input id="vid" type="hidden" value="">
                                
                                </tbody>
                            </table>
                    </form>
                    </div>
                    
                    <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn btn-primary" data-dismiss="modal" id="InfroTextSubmit2">Save changes</button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".update_kirim").click(function () {
            $('#vid').val($(this).data('id'));
            $('#unit_kerja2').val($(this).data('unitkerja'));
            $('#tanggal2').val($(this).data('tanggal'));
            $('#jumlah2').val($(this).data('jumlah'));
            $('#via').val($(this).data('ket'));
        });

        $(".update_terima").click(function () {
            $('#vid2').val($(this).data('id'));
            $('#unit_kerja').val($(this).data('unitkerja'));
            $('#tanggal').val($(this).data('tanggal'));
            $('#jumlah').val($(this).data('jumlah'));
        });
    });

    $('#InfroTextSubmit2').click(function(){
        var vid     =$("#vid").val();
        var unitkerja=$('#unit_kerja2').val();
        var tanggal=$('#tanggal2').val();
        var jumlah=$('#jumlah2').val();
        var via=$('#via').val();
        var idnya=$('#idnya').val();
         $.ajax({
            url: "<?php echo Yii::app()->createUrl('kegiatan/insert_pengiriman'); ?>",
            type:"post",
            dataType :"json",
            data:{"tanggal":tanggal,
                    "unitkerja":unitkerja,
                    "jumlah":jumlah,
                    "via":via,
                    "idnya":idnya,
                    "vid":vid,
                },
                success : function(data)
                {
                    if(data.satu.length >0)
                    {
                        window.location.href=data.satu;
                    }
                    else
                    {
                        alert('Data gagal disimpan, refresh halaman anda dan ulangi lagi');
                    }
                }
            }
        );

    });

    $('#InfroTextSubmit').click(function(){

        var vid     =$("#vid2").val();
        var unitkerja=$('#unit_kerja').val();
        var tanggal=$('#tanggal').val();
        var jumlah=$('#jumlah').val();
        var idnya=$('#idnya').val();
        $.ajax({
            url: "<?php echo Yii::app()->createUrl('kegiatan/insert_progress'); ?>",
            type:"post",
            dataType :"json",
            data:{"unitkerja":unitkerja,
                    "tanggal":tanggal,
                    "jumlah":jumlah,
                    "idnya":idnya,
                    "vid":vid,
                },
                success : function(data)
                {
                    if(data.satu.length >0)
                    {
                        window.location.href=data.satu;
                    }
                    else
                    {
                        alert('Data gagal disimpan, refresh halaman anda dan ulangi lagi');
                    }
                }
            }
        );

    });
</script>
