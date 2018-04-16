<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<style>
    @import url('<?php echo $baseUrl.'/dist/css/step.css';?>');
</style>

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
                        <?php 
					    	echo CHtml::link("2", array('mitra', 'id'=>$model->id), array('class'=>'btn btn-default btn-circle'));
                        ?>
                        <p>Petugas Lapangan</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-3" type="button" class="btn btn-default btn-circle">3</a>
                        <p>Skoring Petugas</p>
                    </div>

                    <div class="stepwizard-step">
                        <a href="#step-4" type="button" class="btn btn-primary btn-circle">4</a>
                        <p>Resume Kegiatan</p>
                    </div>
                </div>
            </div>
		</div>
	</div>

  

    <div class="box box-widget widget-user-2">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-red">
            <h3 class="widget-user-username"><?php echo $model->nama; ?></h3>
        </div>

        <div class="box-footer">
            
            <div class="row">
                <div class="col-sm-6 border-right">
                    <div class="description-block">
                        <h4 class="description-header"><u>JUMLAH PETUGAS : <?php echo $model->resume['jumlah_petugas']; ?></u></h4>
                    </div>

                    <div class="col-sm-6 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><span class="badge bg-blue"><?php echo $model->resume['jumlah_pml'];; ?></span></h5>
                            <span class="description-text">PML</span>
                        </div>

                        <div class="description-block">
                            <h5 class="description-header"><span class="badge bg-blue"><?php echo $model->resume['jumlah_pcl'];; ?></span></h5>
                            <span class="description-text">PCL</span>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="description-block">
                            <h5 class="description-header"><span class="badge bg-blue"><?php echo $model->resume['jumlah_pegawai'];; ?></span></h5>
                            <span class="description-text">ORGANIK</span>
                        </div>

                        <div class="description-block">
                            <h5 class="description-header"><span class="badge bg-blue"><?php echo $model->resume['jumlah_mitra'];; ?></span></h5>
                            <span class="description-text">MITRA</span>
                        </div>
                    </div>
                </div>

                <!-- /.col -->
                <div class="col-sm-6">
                    <ul class="nav nav-stacked">
                        <li><a href="#">% Penilaian <span class="pull-right badge bg-blue">31</span></a></li>
                        <li><a href="#">Nilai Rata-rata <span class="pull-right badge bg-blue"><?php echo $model->resume['rata_nilai'].' / 4'; ?></span></a></li>
                        <li><a href="#">Nilai Paling Tinggi <span class="pull-right badge bg-aqua"><?php echo $model->resume['max_nilai'].' / 4'; ?></span></a></li>
                        <li><a href="#">Nilai Paling Kecil <span class="pull-right badge bg-red"><?php echo $model->resume['min_nilai'].' / 4'; ?></span></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="box-footer no-padding">
            
        </div>
    </div>




          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Petugas</a></li>
              <li><a href="#tab_2" data-toggle="tab">Form Pertanyaan</a></li>  
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">


                    <table class="table table-hover table-bordered table-condensed">
                        <tr>
                            <th>No. </th>
                            <th>Nama</th>
                            <th>NIP (Jika organik)</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Nilai</th>
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
                                echo '</tr>';
                                
                            }
                        ?>
                    </table>



                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <table class="table table-hover table-bordered table-condensed">
                        <tr>
                            <th>No. </th>
                            <th>Pertanyaan</th>
                            <th>Rata-Rata Nilai</th>
                        </tr>
                        <?php
                            foreach ($model->resumePertanyaan as $key => $value)
                            {
                                echo '<tr>';
                                    echo '<td>'.($key+1).'</td>';
                                    echo '<td>'.$value['pertanyaan'].'</td>';
                                    echo '<td class="text-center">'.$value['rata'].' / 4</td>';
                                echo '</tr>';
                                
                            }
                        ?>
                    </table>
                </div>
            </div>
          </div>
