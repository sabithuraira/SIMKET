<?php $baseUrl = Yii::app()->theme->baseUrl; ?>

<div id="detail_tag">
	<div class="box box-info">
		<div class="mailbox-controls">
			<b><?php echo $model->nama; ?></b>
			<div class="pull-right">
				<?php echo CHtml::link("<i class='fa fa-list'></i> Daftar Mitra", array('index'), array('class'=>'btn btn-default btn-sm toggle-event')); ?>
				<?php echo CHtml::link("<i class='fa fa-plus'></i> Tambah", array('create'), array('class'=>'btn btn-default btn-sm toggle-event')); ?>
				<?php echo CHtml::link("<i class='fa fa-pencil'></i> Perbaharui", array('update', 'id'=>$model->id), array('class'=>'btn btn-default btn-sm toggle-event')); ?>
				<?php echo '<button id="btn-delete" dataid="'.$model->id.'" class="btn btn-danger btn-sm toggle-event"> <i class="fa fa-trash"></i> Hapus</button>'; ?>
			</div>
		</div>

		<div class="box-body">
			<div class="row">

				<div class="col-sm-3 border-right">
					<img class="img-profile" src="<?php echo $model->fotoImage; ?>" alt="User Image">
				</div>
				<div class="col-sm-9">

					<?php $this->widget('zii.widgets.CDetailView', array(
						'data'=>$model,
						'attributes'=>array(
							'nama',
							array(
								'name'=>'kab_id',
								'value'=> $model->kabupaten->name,
							),
							'nomor_telepon',
							'alamat',
							'tanggal_lahir',
							array(
								'name'=>'jk',
								'value'=> ($model->jk == 1) ? "Laki-laki" : "Perempuan",
							),
							array(
								'name'=>'pendidikan',
								'value'=> ($model->pendidikan!=null) ? $model->pendidikanDropDown[$model->pendidikan] : "-",
							),
							'riwayat',
							// 'created_time',
							// 'updated_time',
							// 'created_by',
							// 'updated_by',
						),
					)); ?>
				</div>
			</div>

			<br/>
			<div class="row setup-content" id="step-1">
					<div class="col-xs-12">
						<div class="col-md-12">
							
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
											echo '<td>'.round($value['nilai'],2).'</td>';
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