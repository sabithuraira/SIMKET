<?php $baseUrl = Yii::app()->theme->baseUrl; ?>

<div id="detail_tag">
	<div class="box box-info">
		<div class="mailbox-controls">
			<b><?php echo $model->nama; ?></b>
			<!-- /.pull-right -->
		</div>

		<div class="box-body">
            <div class="row setup-content" id="step-1">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        

                        <div class="box box-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-black" style="background: url('../dist/img/photo1.png') center center;">
                            <h3 class="widget-user-username"><?php echo $model->nama; ?></h3>
                            <h5 class="widget-user-desc"><?php echo $model->nomor_telepon; ?></h5>
                            </div>
                            <div class="widget-user-image">
                            <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl."/dist/img/logo_bps.png" ?>" alt="User Avatar">
                            </div>
                            <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-6 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"><?php echo $model->nilaiAndJumlah['jumlah']; ?></h5>
                                    <span class="description-text">JUMLAH KEGIATAN</span>
                                </div>
                                <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6">
                                <div class="description-block">
                                    <h5 class="description-header"><?php echo $model->nilaiAndJumlah['rata']; ?></h5>
                                    <span class="description-text">RATA-RATA NILAI</span>
                                </div>
                                <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            </div>
                        </div>

                            <h4>Kegiatan yang diikuti</h4>
                            <table class="table table-hover table-bordered table-condensed">

                                <tr>
                                    <th>Nama Kegiatan</th>
                                    <th>Status</th>
                                    <th>Nilai</th>
                                </tr>
                                <?php
                                    foreach ($model->listKegiatan as $key => $value)
                                    {
                                        $statusLabel = 'PCL';
                                        if($value['status']==1) $statusLabel = 'PML';

                                        echo '<tr>';
                                        echo '<td>'.$value['nama'].'</td>';
                                        echo '<td>'.$statusLabel.'</td>';
                                        echo '<td>'.$value['nilai'].'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </table>


                        <div class="row">
                            <?php
                                foreach ($model->resumePertanyaan as $key => $value)
                                {
                                    if($key%2==0){
                                        echo '<div class="col-sm-6 border-right">';
                                    }
                                    else{
                                        echo '<div class="col-sm-6">';
                                    }
                            ?>
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                        <?php echo $value['pertanyaan']; ?>
                                        </div>
                                    
                                        <div class="box-body">
                                            <?php
                                                echo '<div id="donut-chart-'.$value['pertanyaan_id'].'" class="donut-chart" style="height:150px;width: 100%"
                                                    data-one="'.$value['jumlah1'].'" 
                                                    data-two="'.$value['jumlah2'].'"
                                                    data-three="'.$value['jumlah3'].'"
                                                    data-four="'.$value['jumlah4'].'"
                                                    data-optone="'.$value['opt1'].'" 
                                                    data-opttwo="'.$value['opt2'].'"
                                                    data-optthree="'.$value['opt3'].'"
                                                    data-optfour="'.$value['opt4'].'">
                                                    </div>';
                                            ?>
                                        </div>
                                        
                                        <div class="box-footer no-padding">

                                            <ul class="nav nav-pills nav-stacked">
                                                <?php
                                                    for($i=1;$i<=4;++$i){
                                                        echo '<li class="li'.$i.'"><a href="#">'.$value['opt'.$i].'<span class="pull-right"> '.$value['jumlah'.$i].'</span></a></li>';
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                            <?php        
                                    echo '</div>';
                                }
                            ?>
                        </div>



                    </div>
                </div>
            </div>

		</div>
	</div>
</div>



<script src="<?php echo $baseUrl;?>/plugins/flot/jquery.flot.min.js"></script>
<script src="<?php echo $baseUrl;?>/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="<?php echo $baseUrl;?>/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="<?php echo $baseUrl;?>/plugins/flot/jquery.flot.categories.min.js"></script>

<script src="<?php echo $baseUrl;?>/dist/js/vue_page/pegawai/detail.js"></script>