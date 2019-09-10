<?php $baseUrl = Yii::app()->theme->baseUrl; ?>

<div id="detail_tag">
	<div class="box box-info">
		<div class="mailbox-controls">
			<b><?php echo $model->nama; ?></b>
			<div class="pull-right">
				<?php if(Yii::app()->user->name!='guess'){ ?>
					<?php echo CHtml::link("<i class='fa fa-list'></i> Daftar Mitra", array('index'), array('class'=>'btn btn-default btn-sm toggle-event')); ?>
					<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')); ?>
					<?php echo CHtml::link("<i class='fa fa-pencil'></i> Perbaharui", array('update', 'id'=>$model->id), array('class'=>'btn btn-default btn-sm toggle-event')); ?>
					<?php echo CHtml::link("<i class='fa fa-thumbs-o-down'></i> Tandai Mitra Hitam", array('black', 'id'=>$model->id), array('class'=>'btn bg-black btn-sm toggle-event')); ?>
					<?php 
						if(Yii::app()->user->getLevel()==1 || ($model->kab_id==Yii::app()->user->getUnitKerja()))
						{ 
							echo '<button id="btn-delete" dataid="'.$model->id.'" class="btn btn-danger btn-sm toggle-event">';
							if($model->is_active==1)
								echo '<i class="fa fa-trash"></i> Hapus Mitra</button>';
							else
								echo '<i class="fa fa-trash"></i> Aktifkan Mitra</button>';
						} 
					?>
				<?php } ?>
			</div>
		</div>

		<div class="box-body">

			<div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="<?php echo $model->fotoImage; ?>" alt="User Image">
                <span class="username"><?php echo $model->nama; ?></span>
                <span class="description"><?php echo $model->kabupaten->name; ?></span>
                <span class="description">Tanggal Lahir: <?php echo $model->tanggal_lahir; ?></span>
                <span class="description">Riwayat Kerja: <?php echo $model->riwayat; ?></span>
              </div>

			  <div class="box-tools">
			  
			  <div class="box-header with-border">
				<div class="user-block">
					<?php
					if(!Yii::app()->user->isGuest){
						if(Yii::app()->user->id != 'guess') {
					?>
					<span class="description">Nomor Telepon: <?php echo $model->nomor_telepon; ?></span>
						<?php }} ?>
					<span class="description"><?php echo ($model->jk == 1) ? "Laki-laki" : "Perempuan"; ?>, Pendidikan Terakhir: <?php echo ($model->pendidikan!=null) ? $model->pendidikanDropDown[$model->pendidikan] : "-" ?></span>
					<span class="description"><?php echo $model->alamat; ?></span>
				</div>
              </div>

              <!-- /.box-tools -->
            </div>
			<br/>
            <!-- /.box-body -->
            <div class="box-footer box-comments">
				<?php 
					foreach ($model->listKegiatan as $key => $value)
					{
						$statusLabel = 'PCL';
						if($value['status']==1) $statusLabel = 'PML';
						echo '<div class="box-comment">
							<img class="img-circle img-sm" src="'.Yii::app()->theme->baseUrl.'/dist/img/logo_bps.png" />
			
							<div class="comment-text">
								<span class="username">'.$value['nama'].'<span class="text-muted pull-right">Status: '.$statusLabel.', Nilai: '.round($value['nilai'],2).'</span></span>
								Catatan: -
							</div>
						</div>
						';
					}
				?>
              
              <!-- /.box-comment -->
            </div>

            <!-- /.box-footer -->
          </div>

			<br/>

			<?php if($model->is_black==1){ ?>
			<div class="alert bg-black">
				<h4 class="text-center"><i class="icon fa fa-warning"></i> Incompetent Agent</h4>
			</div>
			<?php } ?>

			<div class="row setup-content" id="step-1">
					<div class="col-xs-12">
						<div class="col-md-12">
							<?php if(Yii::app()->user->name!='guess'){ ?>
							<div class="box box-widget widget-user">
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
										<h5 class="description-header"><?php echo round($model->nilaiAndJumlah['rata'],2); ?></h5>
										<span class="description-text">RATA-RATA NILAI</span>
									</div>
									<!-- /.description-block -->
									</div>
									<!-- /.col -->
								</div>
							</div>

								


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
													$total = $value['jumlah1'] + $value['jumlah2'] + $value['jumlah3'] + $value['jumlah4'];
													$perc1 = $value['jumlah1'] / $total * 100;
													$perc2 = $value['jumlah2'] / $total * 100;
													$perc3 = $value['jumlah3'] / $total * 100;
													$perc4 = $value['jumlah4'] / $total * 100;

													echo '<div id="donut-chart-'.$value['pertanyaan_id'].'" class="donut-chart" style="height:150px;width: 100%"
														data-one="'.$perc1.'" 
														data-two="'.$perc2.'"
														data-three="'.$perc3.'"
														data-four="'.$perc4.'"
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
															echo '<li class="li'.$i.'"><a href="#">'.$value['opt'.$i].'<span class="pull-right"> '.($value['jumlah'.$i] / $total * 100).' %</span></a></li>';
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


						<?php } ?>
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

<script src="<?php echo $baseUrl;?>/dist/js/vue_page/mitrabps/detail.js"></script>