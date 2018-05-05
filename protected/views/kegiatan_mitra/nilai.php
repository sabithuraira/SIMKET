<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<style>
    @import url('<?php echo $baseUrl.'/dist/css/step.css';?>');
</style>

	<div class="box box-info">
		<div class="mailbox-controls">
			<b><?php echo $model->getNamaMitra(); ?></b>
			<!-- /.pull-right -->
		</div>

		<div class="box-body">
            
            <div class="stepwizard">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step">
                        <?php 
					    	echo CHtml::link("1", array('update', 'id'=>$model->id_kegiatan), array('class'=>'btn btn-default btn-circle'));
                        ?>
                        <p>Data Kegiatan</p>
                    </div>
                    <div class="stepwizard-step">
                        <?php 
					    	echo CHtml::link("2", array('mitra', 'id'=>$model->id_kegiatan), array('class'=>'btn btn-default btn-circle'));
                        ?>
                        <p>Petugas Lapangan</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-3" type="button" class="btn btn-primary btn-circle">3</a>
                        <p>Skoring Petugas</p>
                    </div>

                    <div class="stepwizard-step">
                        <?php
                            echo CHtml::link("4", array("resume", 'id'=>$model->id_kegiatan), array('class'=>'btn btn-default btn-circle'));
                        ?>
                        <p>Resume Kegiatan</p>
                    </div>
                </div>
            </div>

            <hr/>

            <div class="row setup-content" id="step-1">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        

                        <div class="box box-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-black" style="background: url('../dist/img/photo1.png') center center;">
                            <h3 class="widget-user-username"><?php echo $model->namamitra; ?></h3>
                            <h5 class="widget-user-desc"><?php echo $model->statusLabel; ?></h5>
                            </div>
                            <div class="widget-user-image">
                            <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl."/dist/img/logo_bps.png" ?>" alt="User Avatar">
                            </div>
                            <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"><?php echo $model->totalPertanyaan; ?></h5>
                                    <span class="description-text">TOTAL PERTANYAAN</span>
                                </div>
                                <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"><?php echo $model->totalNilai; ?></h5>
                                    <span class="description-text">TOTAL NILAI</span>
                                </div>
                                <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header"><?php echo $model->totalNilai/$model->totalPertanyaan.' / 4'; ?></h5>
                                    <span class="description-text">RATA-RATA</span>
                                </div>
                                <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            </div>
                        </div>

                        <?php if($is_simpan){ ?>
                            <div class="callout callout-info" style="margin-bottom: 0!important;">
                                Data penilaian berhasil disimpan
                            </div>
                        <?php } ?>
                        
                        <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'kegiatan-form',
                            'enableAjaxValidation'=>false,
                        )); ?>
                            <br/>
                            <table class="table table-hover table-bordered table-condensed">
                                <?php
                                    foreach ($questions as $key => $value)
                                    {
                                        $opts_name = 'opts'.$value['id'];
                                        echo '<tr><td><b>'.$value['pertanyaan'].'</b></td></tr>';
                                        if($value['id']==11 || $value['id']==12){
                                    
                                            echo '<tr>';
                                            echo '<td><div class="form-group">';
                                            
                                            $wilayah = KegiatanMitraWilayah::model()->findAllByAttributes(array(
                                                'kmp_id'	=>$model->id //this field refer to id_mitra in kegiatan NOT ID PEGAWAI/MITRA MASTER
                                            ));

                                            echo '<table class="table table-hover table-bordered table-condensed">';
                                            
                                            $list_data = CHtml::listData($value->options, 'skala', 'label');
                                            foreach ($wilayah as $key_wil => $value_wil)
                                            {
                                                $nilai = MitraNilai::model()->findByAttributes(
                                                    array(
                                                        'mitra_id'		=>$model->id, //this field refer to id_mitra in kegiatan NOT ID PEGAWAI/MITRA MASTER
                                                        'pertanyaan_id'	=>$value['id'],
                                                        'wilayah_id'	=>$value_wil['id']
                                                    )
                                                );
                                                echo '<tr>';
                                                    echo '<td>'.($key_wil+1).'</td>';
                                                    echo '<td>'.$value_wil['nks'].'</td>';
                                                    echo '<td>'.$value_wil['bs'].'</td>';
                                                
                                                    if($nilai!=null)
                                                        echo '<td class="text-center">'.CHtml::dropDownList($opts_name.'_'.$value_wil['id'], $nilai->nilai ,$list_data).'</td>';
                                                    else
                                                        echo '<td class="text-center">'.CHtml::dropDownList($opts_name.'_'.$value_wil['id'], '' ,$list_data).'</td>';
                                                echo '</tr>';
                                            }

                                            echo '</table>';
                                            
                                            echo '</div></td>';
                                        }
                                        else{
    
                                            echo '<tr>';
                                            echo '<td><div class="form-group">';
                                            
                                            $nilai = MitraNilai::model()->findByAttributes(
                                                array(
                                                    'mitra_id'		=>$model->id, //this field refer to id_mitra in kegiatan NOT ID PEGAWAI/MITRA MASTER
                                                    'pertanyaan_id'	=>$value['id']
                                                )
                                            );
                                            
                                            foreach($value->options as $key2 => $value2){
                                                $opts_id = 'opts'.$value['id'].$value2['skala'];
    
                                                $is_disable = (strlen($value2['label']) == 0) ? 'disabled' : '';
                                                $is_checked = ($nilai!=null && $nilai->nilai==$value2['skala']) ? 'checked' : '';
    
    
                                                echo '<div class="radio"><label>';
                                                echo '<input type="radio" name="'.$opts_name.'" id="'.$opts_id.'" value="'.$value2['skala'].'" '.$is_disable.' '.$is_checked.'>('.$value2['skala'].') '.$value2['label'].'</label>';
                                                echo '</div>';    
                                            }
                                            echo '</div></td>';
                                        }
                                        echo '</tr>';
                                    }
                                ?>
                            </table>

                            <div class="box-footer">
                                <?php echo CHtml::submitButton('Simpan', array('class'=>'btn btn-primary btn-sm pull-right')); ?>
                            </div>
					    <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>

		</div>
	</div>
