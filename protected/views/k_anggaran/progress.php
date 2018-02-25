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
                            $data_anggaran = $model->getByKabKota($value['id']);
                            echo '<tr>';
                                $idx_jenis=0;
                                echo '<td rowspan="4">'.$value['name'].'</td>';
                                $curr_target = $data_anggaran['t'.($idx_jenis+1)];
                                $curr_real = $data_anggaran['r'.($idx_jenis+1)];

                                echo '<td>'.HelpMe::getRawAnggaran()[$idx_jenis]['label'].'</td>';
                                echo '<td>'.$curr_target.'</td>';
                                echo '<td></td>';
                                echo '<td>'.$curr_real.'</td>';
                                echo '<td>'.($curr_target - $curr_real).'</td>';
                                echo '<td>'.(($curr_real == 0) ? 0 : $curr_target / $curr_real * 100).'</td>';
                                ++$idx_jenis;
                            echo '</tr>';

                            for($i=0; $i<3; ++$i){
                                $curr_target = $data_anggaran['t'.($idx_jenis+1)];
                                $curr_real = $data_anggaran['r'.($idx_jenis+1)];
                                echo '<tr>';
                                echo '<td>'.HelpMe::getRawAnggaran()[$idx_jenis]['label'].'</td>';                                echo '<td>'.$curr_target.'</td>';
                                echo '<td></td>';
                                echo '<td>'.$curr_real.'</td>';
                                echo '<td>'.($curr_target - $curr_real).'</td>';
                                echo '<td>'.(($curr_real == 0) ? 0 : $curr_target / $curr_real * 100).'</td>';
                                ++$idx_jenis;
                            echo '</tr>';
                            }
                            
                        }

                        // echo '<tr>';

                        //         echo '<td colspan="2"><h4>Total</h4></td>';
                        //         echo '<td><h4>'.$model->getTarget().'</h4></td>';
                            
                        //         echo '<td><h4>'.$model->getPercentageProgress(2).'</h4></td>';
                        //         echo '<td><h4> '.($model->getTarget()==0 ? 0 : round($model->getPercentageProgress(2)/$model->getTarget()*100,2)).'% </h4></td>';
                        //         echo '<td><h4> '.($model->getTarget()==0 ? 0 : round($model->getPercentageProgress(2)/$model->getTarget()*100,2)).'% </h4></td>';

                        //         echo '<td><h4>'.$model->getPercentageProgress(1).'</h4></td>';
                        //         echo '<td><h4>'.($model->getTarget()==0 ? 0 : round($model->getPercentageProgress(1)/$model->getTarget()*100,2)).' % </h4></td>';
                        //         echo '<td><h4>'.($model->getTarget()==0 ? 0 : round($model->getPercentageProgress(1)/$model->getTarget()*100,2)).' % </h4></td>';
                        //     echo '</tr>';
                    ?>
                </table>


                <div id="myModalRealisasi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

                <input id="idnya" type="hidden" value="<?php  echo $model->id; ?>">

                <div id="myModalTarget" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <span id="myModalLabel">Target Anggaran</span>
                            </div>
                            
                            <div class="modal-body">
                                <form id="InfroTextTarget" method="POST">
                                    <table class="table table-hover table-striped table-bordered table-condensed">
                                        <tbody>
                                            <?php if(!HelpMe::isKabupaten()){ ?>
                                            <tr>
                                                <td>Kabupaten/Kota</td>
                                                <td>
                                                    <?php 
                                                        echo CHtml::dropDownList('unit_kerja_target','',
                                                                CHtml::listData(UnitKerja::model()->findAllByAttributes(array('jenis'=>'2'),array('order'=>'code')),
                                                                    'id','name'),
                                                                array('empty'=>'- Pilih Unit Kerja-','class'=>'form-control')); 
                                                    ?>
                                                </td>  

                                            </tr>
                                            <?php }else{ echo CHtml::hiddenField('unit_kerja_target',Yii::app()->user-> getUnitKerja()); } ?>
                                            
                                            <?php for($i=1;$i<5;++$i){ ?>
                                                <tr>
                                                    <td><?php echo HelpMe::showAnggaran($i) ?></td>
                                                    <td><?php echo CHtml::textField('target'.$i,'', array('class'=>'form-control')); ?></td>
                                                </tr>
                                            <?php } ?> 
                                        </tbody>
                                    </table>
                            </form>
                            </div>
                            
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                <button class="btn btn-primary" data-dismiss="modal" id="InfroTextTarget">Save changes</button>
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
    });

    $('#InfroTextTarget').click(function(){
        var unitkerja = $('#unit_kerja_target').val();
        var idnya=$('#idnya').val();
        var target1=$('#target1').val();
        var target2=$('#target2').val();
        var target3=$('#target3').val();
        var target4=$('#target4').val();
        var pathname = window.location.pathname;

         $.ajax({
            url: pathname+"?r=k_anggaran/insert_target",
            type:"post",
            dataType :"json",
            data:{
                    "unitkerja":unitkerja,
                    "idnya": idnya,
                    "target1":target1,
                    "target2":target2,
                    "target3":target3,
                    "target4":target4
                },
                success : function(data)
                {
                    if(data.satu.length >0)
                    {
                        window.location.href=pathname+ "?r=k_anggaran/progress&id="+data.satu
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
