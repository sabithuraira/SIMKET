<div class="row">
    <div class="col-md-12">

        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $model->name." ".$model->tahun; ?></h3>
            </div>

            
            <div class="box-body">
                <center>
                    <?php if(HelpMe::isKabupaten() || Yii::app()->user->getLevel()==1){ ?>
                        <button type="button" class="btn btn-flat btn-primary" data-toggle="modal" data-target="#myModalTarget">Input Target Anggaran</button>
                        <button role="button" class="btn btn-flat btn-primary insert_realisasi" data-toggle="modal" data-target="#myModalRealisasi" >Input Realisasi Anggaran</a>
                    <?php } ?>
                </center>
                <br/>

                <table class="table table-hover table-bordered table-condensed">
                    <tr>
                        <th rowspan="2">Unit Kerja </th>
                        <th rowspan="2">Target </th>
                        <th colspan="24">Realisasi</th>
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
                                // echo '<td>'.$data['r12'].'</td>';
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


                <div id="myModalRealisasi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <span id="myModalLabel">Realisasi Anggaran</span>
                            </div>
                            
                            <div class="modal-body">
                                <form id="InfroText" method="POST">
                                    <table class="table table-hover table-striped table-bordered table-condensed">
                                        <tbody>
                                        
                                            <?php if(!HelpMe::isKabupaten()){ ?>
                                            <tr>
                                                <td>Kabupaten/Kota</td>
                                                <td>
                                                    <?php 
                                                        echo CHtml::dropDownList('unit_kerja_realisasi','',
                                                                CHtml::listData(UnitKerja::model()->findAllByAttributes(array('jenis'=>'2'),array('order'=>'code')),
                                                                    'id','name'),
                                                                array('empty'=>'- Pilih Unit Kerja-','class'=>'form-control')); 
                                                    ?>
                                                </td>  

                                            </tr>
                                            <?php }else{ echo CHtml::hiddenField('unit_kerja_realisasi',Yii::app()->user-> getUnitKerja()); } ?>
                                            
                                            <tr>
                                                <td>Rincian</td>
                                                <td>
                                                    <?php 
                                                        echo CHtml::dropDownList('rincian','',
                                                                HelpMe::getDropDownAnggaran(),
                                                                array('empty'=>'- Pilih Rincian-','class'=>'form-control')); 
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

                                            <tr>
                                                <td>Keterangan <small><i>(contoh: Honor petugas pemutakhiran, Honor lembur pengolahan, dll )</i></small></td>
                                                <td>
                                                    <?php echo CHtml::textField('keterangan',''); ?>
                                                </td>
                                            </tr>
                                            <input id="vid" type="hidden" value="">
                                        </tbody>
                                    </table>
                            </form>
                            </div>
                            
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                <button class="btn btn-primary" data-dismiss="modal" id="InfroTextRealisasi">Save changes</button>
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
                                <form id="InfroFormTarget" method="POST">
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
    var unitkerja = $('#unit_kerja_target');
    var unitkerja_real = $('#unit_kerja_realisasi');
    var rincian = $('#rincian');
    var tanggal = $('#tanggal');
    var jumlah = $('#jumlah');
    var vid = $('#vid');
    var keterangan = $('#keterangan');
    var idnya=$('#idnya');
    var target1=$('#target1');
    var target2=$('#target2');
    var target3=$('#target3');
    var target4=$('#target4');
    var pathname = window.location.pathname;

    $(".update_realisasi").click(function () {
        vid.val($(this).data('id'));
        unitkerja_real.val($(this).data('unitkerja'));
        rincian.val($(this).data('jenis'));
        tanggal.val($(this).data('tanggal'));
        jumlah.val($(this).data('jumlah'));
        keterangan.val($(this).data('keterangan'));
    });

    $(".insert_realisasi").click(function () {
        vid.val('');
        unitkerja_real.val('');
        rincian.val('');
        tanggal.val('');
        jumlah.val('');
        keterangan.val('');
    });

    $(document).ready(function () {
        setDetailTarget();
    });

    unitkerja.change(function(){
        setDetailTarget();
    });

    function setDetailTarget(){
        if(unitkerja.val().length > 0){
            $.ajax({
                url: pathname+"?r=k_anggaran/detail_kab_kota&id=" + idnya.val() + "&kab_id=" + unitkerja.val(),
                type:"GET",
                dataType :"json",
                success : function(data)
                {
                    target1.val(data.satu.t1)
                    target2.val(data.satu.t2)
                    target3.val(data.satu.t3)
                    target4.val(data.satu.t4)
                }
            });
        }
    }

    $('#InfroTextTarget').click(function(){

        $.ajax({
            url: pathname+"?r=k_anggaran/insert_target&id=" + idnya.val(),
            type:"post",
            dataType :"json",
            data:{
                    "unitkerja":unitkerja.val(),
                    "target1":target1.val(),
                    "target2":target2.val(),
                    "target3":target3.val(),
                    "target4":target4.val()
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


    $('#InfroTextRealisasi').click(function(){
        $.ajax({
            url: pathname+"?r=k_anggaran/insert_realisasi&id=" + idnya.val(),
            type:"post",
            dataType :"json",
            data:{
                "unitkerja":unitkerja_real.val(),
                "rincian":rincian.val(),
                "tanggal":tanggal.val(),
                "jumlah":jumlah.val(),
                "keterangan":keterangan.val(),
                "vid": vid.val()
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
        });
    });
</script>
