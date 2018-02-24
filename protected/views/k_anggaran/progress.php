<div class="row">
    <div class="col-md-12">

        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $model->indukKegiatan->name." (".HelpMe::showJenisData($model->jenis).") ".$model->keterangan." Tahun ".$model->tahun; ?></h3>
            </div>

            
            <div class="box-body">

                <center>
                    <?php if(HelpMe::isKabupaten() || Yii::app()->user->getLevel()==1){ ?>
                        <button type="button" class="btn btn-flat btn-primary" data-toggle="modal" data-target="#myModalTarget">Input Target Anggaran</button>
                        <button role="button" class="btn btn-flat btn-primary" data-toggle="modal" data-target="#myModalRealisasi" >Input Realisasi Anggaran</a>
                    <?php } ?>
                </center>
                <br/>

                <table class="table table-hover table-bordered table-condensed">
                    <tr>
                        <th rowspan="2">Unit Kerja </th>
                        <th rowspan="2">Rincian </th>
                        <th rowspan="2">Target </th>
                        <th colspan="4">Realisasi</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>Jumlah</th>
                        <th>Selisih</th>
                        <th>% Realiasi</th>
                    </tr>
                    <?php
                        foreach (UnitKerja::model()->findAllByAttributes(array('jenis'=>'2'),array('order'=>'code')) as $key => $value)
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


                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <span id="myModalLabel">Konfirmasi Penerimaan</span>
                            </div>
                            
                            <div class="modal-body">
                                <form id="InfroText" method="POST">
                        
                                    <input name="InfroText" value="1" type="hidden">
                            
                                    <table class="table table-hover table-striped table-bordered table-condensed">
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
                    </div>
                </div>

                <div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <span id="myModalLabel">Tambah Pengiriman</span>
                            </div>
                            
                            <div class="modal-body">
                                <form id="InfroText2" method="POST">
                                    <input name="InfroText" value="1" type="hidden">
                            
                                    <table class="table table-hover table-striped table-bordered table-condensed">
                                        <tbody>
                                            <?php if(!HelpMe::isKabupaten()){ ?>
                                            <tr>
                                                <td>Kabupaten/Kota</td>
                                                <td>
                                                    <?php 
                                                        echo CHtml::dropDownList('unit_kerja2','',
                                                                CHtml::listData(Participant::model()->PerKegiatan($model->id)->data,
                                                                    'unitkerja','unitkerja0.name'),
                                                                array('empty'=>'- Pilih Unit Kerja-','class'=>'form-control')); 
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
                                                <td><?php echo CHtml::textField('jumlah2','', array('class'=>'form-control')); ?></td>
                                            </tr>

                                            <tr>
                                                <td>Dikirim melalui</td>
                                                <td><?php echo CHtml::textField('via','', array('class'=>'form-control')); ?></td>
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
        var pathname = window.location.pathname;

         $.ajax({
            url: pathname+"?r=kegiatan/insert_pengiriman",
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
                        window.location.href=pathname+ "?r=kegiatan/progress&id="+data.satu
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

        var pathname = window.location.pathname;

        $.ajax({
            url: pathname+"?r=kegiatan/insert_progress",
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
                        window.location.href=pathname+ "?r=kegiatan/progress&id="+data.satu
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
