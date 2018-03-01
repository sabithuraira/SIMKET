<div class="row">
    <div class="col-md-12">

        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $model->name." ".$model->tahun; ?></h3>
            </div>

            <div class="box-body">
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
                            foreach (UnitKerja::model()->findAllByAttributes(array('jenis'=>'2'),array('order'=>'code')) as $key => $value)
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
                                                        echo CHtml::dropDownList('unit_kerja','',
                                                                CHtml::listData(UnitKerja::model()->findAllByAttributes(array('jenis'=>'2'),array('order'=>'code')),
                                                                    'id','name'),
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
                                                        echo CHtml::dropDownList('unit_kerjarpd','',
                                                                CHtml::listData(UnitKerja::model()->findAllByAttributes(array('jenis'=>'2'),array('order'=>'code')),
                                                                    'id','name'),
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

<script>
    var unitkerja = $('#unit_kerja');
    var idnya=$('#idnya');
    var target=$('#target');
    var r1=$('#r1');
    var r2=$('#r2');
    var r3=$('#r3');
    var r4=$('#r4');
    var r5=$('#r5');
    var r6=$('#r6');
    var r7=$('#r7');
    var r8=$('#r8');
    var r9=$('#r9');
    var r10=$('#r10');
    var r11=$('#r11');
    var r12=$('#r12');


    var unitkerja_rpd = $('#unit_kerjarpd');
    var rpd1=$('#rpd1');
    var rpd2=$('#rpd2');
    var rpd3=$('#rpd3');
    var rpd4=$('#rpd4');
    var rpd5=$('#rpd5');
    var rpd6=$('#rpd6');
    var rpd7=$('#rpd7');
    var rpd8=$('#rpd8');
    var rpd9=$('#rpd9');
    var rpd10=$('#rpd10');
    var rpd11=$('#rpd11');
    var rpd12=$('#rpd12');
    var pathname = window.location.pathname;

    $(document).ready(function () {
        setDetailTarget();
        setDetailRpd();
    });

    unitkerja.change(function(){
        setDetailTarget();
    });

    unitkerja_rpd.change(function(){
        setDetailRpd();
    });

    function setDetailTarget(){
        if(unitkerja.val().length > 0){
            $.ajax({
                url: pathname+"?r=indukkegiatan/detail_kab_kota&id=" + idnya.val() + "&kab_id=" + unitkerja.val(),
                type:"GET",
                dataType :"json",
                success : function(data)
                {
                    target.val(data.satu.target);
                    r1.val(data.satu.r1);
                    r2.val(data.satu.r2);
                    r3.val(data.satu.r3);
                    r4.val(data.satu.r4);
                    r5.val(data.satu.r5);
                    r6.val(data.satu.r6);
                    r7.val(data.satu.r7);
                    r8.val(data.satu.r8);
                    r9.val(data.satu.r9);
                    r10.val(data.satu.r10);
                    r11.val(data.satu.r11);
                    r12.val(data.satu.r12);
                }
            });
        }
    }

    function setDetailRpd(){
        if(unitkerja_rpd.val().length > 0){
            $.ajax({
                url: pathname+"?r=indukkegiatan/detail_kab_kota&id=" + idnya.val() + "&kab_id=" + unitkerja_rpd.val(),
                type:"GET",
                dataType :"json",
                success : function(data)
                {
                    rpd1.val(data.satu.rpd1);
                    rpd2.val(data.satu.rpd2);
                    rpd3.val(data.satu.rpd3);
                    rpd4.val(data.satu.rpd4);
                    rpd5.val(data.satu.rpd5);
                    rpd6.val(data.satu.rpd6);
                    rpd7.val(data.satu.rpd7);
                    rpd8.val(data.satu.rpd8);
                    rpd9.val(data.satu.rpd9);
                    rpd10.val(data.satu.rpd10);
                    rpd11.val(data.satu.rpd11);
                    rpd12.val(data.satu.rpd12);
                }
            });
        }
    }

    $('#InfroTextRpd').click(function(){

        $.ajax({
            url: pathname+"?r=indukkegiatan/insert_rpd&id=" + idnya.val(),
            type:"post",
            dataType :"json",
            data:{
                    "unitkerja":unitkerja_rpd.val(),
                    "rpd1":rpd1.val(),
                    "rpd2":rpd2.val(),
                    "rpd3":rpd3.val(),
                    "rpd4":rpd4.val(),
                    "rpd5":rpd5.val(),
                    "rpd6":rpd6.val(),
                    "rpd7":rpd7.val(),
                    "rpd8":rpd8.val(),
                    "rpd9":rpd9.val(),
                    "rpd10":rpd10.val(),
                    "rpd11":rpd11.val(),
                    "rpd12":rpd12.val()
                },
                success : function(data)
                {
                    if(data.satu.length >0)
                    {
                        window.location.href=pathname+ "?r=indukkegiatan/progress&id="+data.satu
                    }
                    else
                    {
                        alert('Data gagal disimpan, refresh halaman anda dan ulangi lagi');
                    }
                }
            }
        );

    });

    $('#InfroText').click(function(){

        $.ajax({
            url: pathname+"?r=indukkegiatan/insert_anggaran&id=" + idnya.val(),
            type:"post",
            dataType :"json",
            data:{
                    "unitkerja":unitkerja.val(),
                    "target":target.val(),
                    "r1":r1.val(),
                    "r2":r2.val(),
                    "r3":r3.val(),
                    "r4":r4.val(),
                    "r5":r5.val(),
                    "r6":r6.val(),
                    "r7":r7.val(),
                    "r8":r8.val(),
                    "r9":r9.val(),
                    "r10":r10.val(),
                    "r11":r11.val(),
                    "r12":r12.val()
                },
                success : function(data)
                {
                    if(data.satu.length >0)
                    {
                        window.location.href=pathname+ "?r=indukkegiatan/progress&id="+data.satu
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
