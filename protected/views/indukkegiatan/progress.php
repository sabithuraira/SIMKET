<div class="row">
    <div class="col-md-12">

        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $model->name." ".$model->tahun; ?></h3>
            </div>

            <div class="box-body">
                <center>
                    <?php if(HelpMe::isKabupaten() || Yii::app()->user->getLevel()==1){ ?>
                        <button type="button" class="btn btn-flat btn-primary insert-anggaran" data-toggle="modal" data-target="#myModal">Input Anggaran</button>
                    <?php } ?>
                </center>
                <br/>

                <div class="scrollme"> 
                    <table class="table table-hover table-bordered table-condensed">
                        <tr>
                            <th rowspan="2">Unit Kerja </th>
                            <th rowspan="2">Target </th>
                            <th colspan="24" class="text-center">Realisasi</th>
                        </tr>
                        <tr>
                            <?php
                                foreach (HelpMe::getMonthListArr() as $key => $value) {
                                    echo '<td>'.$value['short_lbl'].'</td>';
                                    echo '<td>%</td>';
                                }
                            ?>
                        </tr>
                        <?php
                            foreach (UnitKerja::model()->findAllByAttributes(array('jenis'=>'2'),array('order'=>'code')) as $key => $value)
                            {
                                $data = $model->getByKabKota($value['id']);
                                
                                echo '<tr>';
                                    echo '<td>'.$value['name'].'</td>';
                                    echo '<td>'.$data['target'].'</td>';
                                    for($i=1; $i<=12; ++$i){
                                        echo '<td>'.$data["r$i"].'</td>';
                                        echo '<td></td>';
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
                                    
                                    <div class="text-center"><h4>Realisasi</h4></div>
                                    <table class="table table-hover table-striped table-bordered table-condensed">
                                        <tbody>
                                        
                                            <tr>
                                                <td>Jan</td>
                                                <td class="center"><?php echo CHtml::textField('r1',''); ?></td>

                                                <td>Feb</td>
                                                <td class="center"><?php echo CHtml::textField('r2',''); ?></td>
                                            </tr>

                                            <tr>
                                                <td>Mar</td>
                                                <td class="center"><?php echo CHtml::textField('r3',''); ?></td>

                                                <td>Apr</td>
                                                <td class="center"><?php echo CHtml::textField('r4',''); ?></td>
                                            </tr>

                                            <tr>
                                                <td>Mei</td>
                                                <td class="center"><?php echo CHtml::textField('r5',''); ?></td>

                                                <td>Jun</td>
                                                <td class="center"><?php echo CHtml::textField('r6',''); ?></td>
                                            </tr>

                                            <tr>
                                                <td>Jul</td>
                                                <td class="center"><?php echo CHtml::textField('r7',''); ?></td>

                                                <td>Agu</td>
                                                <td class="center"><?php echo CHtml::textField('r8',''); ?></td>
                                            </tr>

                                            <tr>
                                                <td>Sep</td>
                                                <td class="center"><?php echo CHtml::textField('r9',''); ?></td>

                                                <td>Okt</td>
                                                <td class="center"><?php echo CHtml::textField('r10',''); ?></td>
                                            </tr>

                                            <tr>
                                                <td>Nov</td>
                                                <td class="center"><?php echo CHtml::textField('r11',''); ?></td>

                                                <td>Des</td>
                                                <td class="center"><?php echo CHtml::textField('r12',''); ?></td>
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
    var pathname = window.location.pathname;

    $(document).ready(function () {
        setDetailTarget();
    });

    unitkerja.change(function(){
        setDetailTarget();
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
