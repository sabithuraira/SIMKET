<?php
  $baseUrl = Yii::app()->theme->baseUrl; 
?>
<div class="wrapper">
    <section class="invoice">
        
        <div class="row row-print invoice-info">
            <div class="col-sm-12 invoice-col">
                <img class="header-logo" src="<?php echo $baseUrl;?>/dist/img/logo-surat.png" style="width:auto;height:80px;">
            </div>
            <!-- /.col -->
            <!-- <div class="col-sm-10 invoice-col">
                <div>
                    <div class="header-bps">BADAN PUSAT STATISTIK</div>
                    <div class="header-unit">KOTA PALEMBANG</div>
                </div> 
            </div> -->
            <!-- /.col -->
            <!-- /.col -->


            <div class="sub-header text-center">
                <u>SURAT TUGAS</u><br/>
                Nomor : {{ no_surat }}
            </div>


              <div class="row row-print sub-header">
                <div class="col-xs-4">Menimbang</div>

                <div class="col-xs-1">:</div>
                <div class="col-xs-7">
                    Bahwa dalam rangka <?php echo $model->nama_kegiatan; ?> maka dipandang perlu menugaskan pegawai di lingkungan Badan Pusat Statistik Kota Palembang Provinsi Sumatera Selatan untuk melaksanakan kegiatan dimaksud. 

                </div>
              </div>



              <div class="row row-print sub-header">
                <div class="col-xs-4">Mengingat</div>

                <div class="col-xs-1">:</div>
                <div class="col-xs-7">

                  <ol>
                    <li>Undang-undang No. 16 Tahun 1997 Tentang Statistik;</li>
                    <li>Peraturan Pemerintah No. 51 Tahun 1999 Tentang Penyelenggaraan Statistik;</li>
                    <li>Peraturan Presiden No. 86 Tahun 2007 Tentang Badan Pusat Statistik;</li>
                    <li>Peraturan Menteri Keuangan Nomor 113/PMK.05/2012, Tentang Perjalanan Dinas Jabatan Dalam Negeri Bagi Pejabat Negara, Pegawai Negeri, dan Pegawai Tidak Tetap beserta perubahannya;</li>
                    <li>Peraturan Kepala Badan Pusat Statistik Nomor 7 Tahun 2008, Tentang Organisasi dan Tata Kerja Badan Pusat Statistik;</li>
                    <li>Keputusan Kepala Badan Pusat Statistik No. 121 Tahun 2001, Tentang Organisasi dan Tata Kerja Perwakilan BPS di Daerah;</li>
                  </ol>
                <!-- 1.	Undang-undang No. 16 Tahun 1997 Tentang Statistik;<br/>
                2.	Peraturan Pemerintah No. 51 Tahun 1999 Tentang Penyelenggaraan Statistik;<br/>
                3.	Peraturan Presiden No. 86 Tahun 2007 Tentang Badan Pusat Statistik;<br/>
                4.	Peraturan Menteri Keuangan Nomor 113/PMK.05/2012, Tentang Perjalanan Dinas Jabatan Dalam Negeri Bagi Pejabat Negara, Pegawai Negeri, dan Pegawai Tidak Tetap beserta perubahannya;<br/>
                5.	Peraturan Kepala Badan Pusat Statistik Nomor 7 Tahun 2008, Tentang Organisasi dan Tata Kerja Badan Pusat Statistik;<br/>
                6.	Keputusan Kepala Badan Pusat Statistik No. 121 Tahun 2001, Tentang Organisasi dan Tata Kerja Perwakilan BPS di Daerah;<br/> -->
                </div>
              </div>

              <div class="sub-header text-center">
                    Memberi Tugas :
                </div>


              <div class="row row-print sub-header">
                <div class="col-xs-4">Kepada</div>

                <div class="col-xs-1">:</div>
                <div class="col-xs-7">
                    <b><?php echo $model->pegawai->nama ?> / <?php echo $model->pegawai->jabatan ?> </b><br/>
                    <?php echo $model->pegawai->unitKerja->name; ?>
                </div>
              </div>


              <div class="row row-print sub-header">
                <div class="col-xs-4">Pangkat / Golongan</div>

                <div class="col-xs-1">:</div>
                <div class="col-xs-7">
                    <?php echo $model->pegawai->golongan; ?>
                </div>
              </div>



              <div class="row row-print sub-header">
                <div class="col-xs-4">Untuk</div>

                <div class="col-xs-1">:</div>
                <div class="col-xs-7">
                    <?php echo $model->penjelasan; ?><br/>
                    Dalam Rangka <b><?php echo $model->nama_kegiatan; ?></b>. Program Penyediaan dan Pelayanan Informasi Statistik. <br/>
                    Tahun Anggaran <?php echo date('Y') ?>
                </div>
              </div>


              <div class="row row-print sub-header">
                <div class="col-xs-4">Pada Tanggal</div>

                <div class="col-xs-1">:</div>
                <div class="col-xs-7">
                    <?php echo date("d M Y",strtotime($model->tanggal_mulai)); ?> s.d <?php echo date("d M Y",strtotime($model->tanggal_berakhir)); ?>
                </div>
              </div>



              <div class="row row-print sub-header">
                <div class="col-xs-8"></div>

                <div class="col-xs-4 text-center">
                    Palembang, <?php echo date("d M Y") ?><br/>
                    <div v-if="is_kepala">Kepala Badan Pusat Statistik<br/></div>
                    <div v-if="!is_kepala">an Kepala Badan Pusat Statistik<br/></div>
                    Kota Palembang<br/>


                    <div class="nama-ttd">{{ nama_ttd }}</div><br/>
                    <div>{{ nip_ttd }}</div>
                </div>
              </div>

        </div>
    </section>
</div>