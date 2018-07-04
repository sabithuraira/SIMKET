<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<style>
    @import url('<?php echo $baseUrl.'/dist/css/step.css';?>');
</style>

<div id="form_tag">
    <?php if(HelpMe::isAuthorizeUnitKerja($model->kab_id)){ ?>
	<div class="box box-info">
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
                        <a href="#step-2" type="button" class="btn btn-primary btn-circle" disabled="disabled">2</a>
                        <p>Kelola Pertanyaan</p>
                    </div>
                    <div class="stepwizard-step">
                        <?php if($model->isNewRecord){ ?>
                            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                        <?php }else{ 
                                echo CHtml::link("3", array('mitra', 'id'=>$model->id), array('class'=>'btn btn-default btn-circle'));
                            }
                        ?>
                        <p>Petugas Lapangan</p>
                    </div>
                    <div class="stepwizard-step">
                        <?php if($model->isNewRecord){ ?>
                            <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                        <?php }else{ 
                                echo CHtml::link("4", array("skoring", 'id'=>$model->id), array('class'=>'btn btn-default btn-circle'));
                            }
                        ?>
                        <p>Skoring Petugas</p>
                    </div>

                    <div class="stepwizard-step">
                        <?php if($model->isNewRecord){ ?>
                            <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
                        <?php }else{ 
                                echo CHtml::link("5", array("resume", 'id'=>$model->id), array('class'=>'btn btn-default btn-circle'));
                            }
                        ?>
                        <p>Resume Kegiatan</p>
                    </div>
                </div>
            </div>
		</div>
    </div>



    <?php $form=$this->beginWidget('CActiveForm', array(
      'enableAjaxValidation'=>false,
    )); 

        $is_disabled = '';
    
        if($model->is_set_form==1)
            $is_disabled = 'disabled';
    ?>

    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Pilih daftar pertanyaan yang dimasukkan</h3>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding"> 
        <input type="hidden" value="1" name="par_post"/>

        <div class="table-responsive mailbox-messages">
          <table class="table table-hover table-striped">
            <tbody>
            <tr>
                <th></th>
                <th>Soal</th>
                <th>Peruntukan</th>
                <th>Apakah dinilai per wilayah?</th>
            </tr>
              <?php 
                    $all_pertanyaan = MitraPertanyaan::model()->findAll();
                    
                    foreach($all_pertanyaan as $key=>$value){
                        $is_checked = '';
                        $is_per_wil = '';
                        $model_check = KegiatanMitraPertanyaan::model()->findByAttributes(array(
                            'kegiatan_mitra_id'     =>$model->id,
                            'mitra_pertanyaan_id'   =>$value['id']
                        ));

                        if($model_check!==null){
                            $is_checked = 'checked';
                            if($model_check->is_per_wilayah==1)
                                $is_per_wil = 'checked';
                        }

                        echo '<tr><td><input id="form'.$value['id'].'" name="form'.$value['id'].'" type="checkbox" '.$is_checked.' '.$is_disabled.'></td>';
                        echo '<td>'.$value->pertanyaan.'</td><td>'.$value->peruntukanLabel.'</td>';
                        echo '<td><input id="wil'.$value['id'].'" name="wil'.$value['id'].'" type="checkbox" '.$is_per_wil.' '.$is_disabled.'></td>';
                        echo '</tr>';
                    }
              ?>
            </tbody>
          </table>

        </div>
        <!-- /.mail-box-messages -->
      </div>
      <!-- /.box-body -->


    </div>
    <!-- /. box -->

        <div class="direct-chat-text">
        <?php
            if($model->is_set_form==0) echo 'Pastikan pilihan soal sudah benar karena sistem <u><b>TIDAK MENGIZINKAN</b></u> koreksi pemilihan soal!';
            else echo 'Anda tidak dapat memperbaharui data ini';

        ?>
        </div>
    <br/>
    <button type="submit" value="Submit" class="btn btn-success btn-block margin-bottom" <?php echo $is_disabled; ?>>Simpan</button>
    <?php 
        // echo CHtml::submitButton('Simpan', array('class'=>"btn btn-success btn-block margin-bottom"));
        $this->endWidget(); 
    } else { 
    ?>
        <div class="page-header">
            <h1>Anda Tidak Memiliki Autorisasi Pada Halaman Ini</h1>
        </div>
    <?php } ?>
</div>



<script src="<?php echo $baseUrl;?>/dist/js/vue_page/kegiatan_mitra/form.js"></script>