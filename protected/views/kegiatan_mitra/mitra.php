<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<style>
    @import url('<?php echo $baseUrl.'/dist/css/step.css';?>');
</style>
<div id="mitra_tag">
    
    <?php
    if(HelpMe::isAuthorizeUnitKerja($model->kab_id)){
    ?>
        <div class="box box-info">
            <div class="mailbox-controls">
                <b><?php echo $model->nama; ?></b>
                <!-- /.pull-right -->
            </div>

            <div class="box-body">
                
                <div class="stepwizard">
                    <div class="stepwizard-row setup-panel">
                        <div class="stepwizard-step">
                            <?php 
                                echo CHtml::link("1", array('update', 'id'=>$model->id), array('class'=>'btn btn-default btn-circle'));
                            ?>
                            <p>Data Kegiatan</p>
                        </div>
                        <div class="stepwizard-step">
                            <a href="#step-2" type="button" class="btn btn-primary btn-circle">2</a>
                            <p>Petugas Lapangan</p>
                        </div>
                        <div class="stepwizard-step">
                            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                            <p>Skoring Petugas</p>
                        </div>

                        <div class="stepwizard-step">
                            <?php
                                echo CHtml::link("4", array("resume", 'id'=>$model->id), array('class'=>'btn btn-default btn-circle'));
                            ?>
                            <p>Resume Kegiatan</p>
                        </div>
                    </div>
                </div>

                <hr/>

                <div class="pull-right">
                    <?php //echo CHtml::link("<i class='fa fa-plus'></i> Tambah Mitra", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')) ?>
                    <button type="button" class="btn btn-default btn-sm toggle-event" data-toggle="modal" data-target="#myModal"><i class='fa fa-plus'></i> Tambah Petugas</button>
                </div>
                <div class="row setup-content" id="step-1">
                    <div class="col-xs-12">
                        
                        <div class="col-md-12">
                            <br/>
                            <table class="table table-hover table-bordered table-condensed">
                                <tr>
                                    <th>No. </th>
                                    <th>Nama</th>
                                    <th>NIP (Jika organik)</th>
                                    <th class="text-center">Status & wilayah tugas(khusus PCL)</th>
                                    <th class="text-center">Nilai</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <?php
                                    foreach ($list_mitra as $key => $value)
                                    {
                                        echo '<tr>';
                                            echo '<td>'.($key+1).'</td>';
                                            echo '<td>'.$value['nama'].'</td>';
                                            echo '<td>'.$value['nip'].'</td>';
                                        
                                            echo '<td class="text-center">'.$value['status'].'</td>';
                                            echo '<td class="text-center">'.$value['nilai'].' / 4</td>';
                                            echo '<td class="text-center">';
                                                echo CHtml::link("<i class='fa fa-tachometer'></i> Penilaian", array('nilai', 'id'=> $value['id']), array('class'=>'btn btn-default btn-sm'));
                                            echo '</td>';
                                            
                                            echo '<td class="text-center">';
                                                echo '<a href="#" data-id="'.$value['id'].'"  class="btn btn-default btn-sm delete-petugas"><i class="fa fa-trash"></i> Hapus</a>';
                                            echo '</td>';
                                        

                                        echo '</tr>';
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    <?php } else { ?>
        <div class="page-header">
            <h1>Anda Tidak Memiliki Autorisasi Pada Halaman Ini</h1>
        </div>
    <?php } ?>



    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <span id="myModalLabel">Tambah Petugas</span>
                </div>
                
                <div class="modal-body">
                    <form id="InfroText2" method="POST">
                        <input name="InfroText" value="1" type="hidden">
                
                        <table class="table table-hover table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td>Petugas Dari</td>
                                    <td>
                                        <?php 
                                            echo CHtml::dropDownList('mitra_from','',
                                                array(1=>'Pegawai', 2=>'Mitra'),
                                                array('empty'=>'- Pilih -','class'=>'form-control')); 
                                        ?>
                                    </td>  
                                </tr>

                                <tr>
                                    <td>Petugas</td>
                                    <td>
                                        <?php 
                                            echo CHtml::dropDownList('mitra_id','',
                                                array(),
                                                array('empty'=>'- Pilih Petugas -','class'=>'form-control')); 
                                        ?>
                                    </td>  
                                </tr>
                                
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        <?php 
                                            echo CHtml::dropDownList('mitra_status','',
                                                array(1=>'PML', 2=>'PCL'),
                                                array('empty'=>'- Status -','class'=>'form-control')); 
                                        ?>
                                    </td> 
                                </tr>

                                <input id="idnya" type="hidden" value="<?php  echo $model->id; ?>"> 
                                <input id="idkab" type="hidden" value="<?php  echo $model->kab_id; ?>"> 
                            </tbody>
                        </table>

                        <b><u>Wilayah tugas (khusus PCL):</u></b><br/>
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td class="text-center">
                                        <input class="new-todo"
                                            autofocus autocomplete="off"
                                            placeholder="NKS, ex: 541928"
                                            v-model="nks">
                                    </td>
                                    <td class="text-center">
                                        <input class="new-todo"
                                            autofocus autocomplete="off"
                                            placeholder="Nomor BS, ex: 001B"
                                            v-model="bs">
                                    </td>
                                    <td class="text-center"><a href="#" id="btn_wilayah" @click="addWil" class="btn btn-default btn-sm"><i class='fa fa-plus'></i> Tambah</a></td>  
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="wil in wils" :key="wil.nks">
                                    <td>{{ wil.nks }}</td>
                                    <td>{{ wil.bs }}</td>
                                    <td class="text-center"><a href="#" id="btn_wilayah"  @click="removeWil(wil)" class="btn btn-default btn-sm"><i class='fa fa-trash'></i> Hapus</a></td>  
                                </tr>

                                <input id="idnya" type="hidden" value="<?php  echo $model->id; ?>"> 
                                <input id="idkab" type="hidden" value="<?php  echo $model->kab_id; ?>"> 
                            </tbody>
                        </table>
                </form>

                <?php
                    echo CHtml::link("Tambah Mitra", array('mitrabps/create'), array('target'=>'_blank'));
                    echo "&nbsp | &nbsp";
                    echo CHtml::link("Tambah Pegawai", array('pegawai/create'), array('target'=>'_blank'));
                ?>
                </div>
                
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn btn-primary" data-dismiss="modal" id="InfroTextSubmit">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modalUpdate" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <span id="myModalLabel">Perbaharui Wilayah Tugas {{ cur_mitra_name }}</span>
                </div>
                
                <div class="modal-body">
                    <div class="loading">
                        <img class="loading_image"  height="50" width="50" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/loading.gif" /><br/>
                        <b class="loading_message">Loading...</b>
                    </div>

                    <form id="InfroText2" method="POST">
                        <input name="InfroText" value="1" type="hidden">

                        <b><u>Wilayah tugas (khusus PCL):</u></b><br/>
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td class="text-center">
                                        <input class="new-todo"
                                            autofocus autocomplete="off"
                                            placeholder="NKS, ex: 541928"
                                            v-model="nks">
                                    </td>
                                    <td class="text-center">
                                        <input class="new-todo"
                                            autofocus autocomplete="off"
                                            placeholder="Nomor BS, ex: 001B"
                                            v-model="bs">
                                    </td>
                                    <td class="text-center"><a href="#" @click="addWilDb" class="btn btn-default btn-sm"><i class='fa fa-plus'></i> Tambah</a></td>  
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="wil in cur_wils" :key="wil.nks">
                                    <td>{{ wil.nks }}</td>
                                    <td>{{ wil.bs }}</td>
                                    <td class="text-center"><a href="#"  @click="removeWilDb(wil.id)" class="btn btn-default btn-sm"><i class='fa fa-trash'></i> Hapus</a></td>  
                                </tr>
                            </tbody>
                        </table>
                </form>

                <?php
                    echo CHtml::link("Tambah Mitra", array('mitrabps/create'), array('target'=>'_blank'));
                    echo "&nbsp | &nbsp";
                    echo CHtml::link("Tambah Pegawai", array('pegawai/create'), array('target'=>'_blank'));
                ?>
                </div>
                
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn btn-primary" data-dismiss="modal" id="btn-update-finish">Save changes</button>
                </div>
            </div>
        </div>
    </div>


</div>

<script src="<?php echo $baseUrl;?>/dist/js/vue_page/kegiatan_mitra/mitra.js"></script>