<script src="https://www.gstatic.com/firebasejs/4.6.0/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.6.0/firebase-firestore.js"></script>
<div id="mfd_tag">
    <!-- Main content -->
    <section class="content">
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">

          <div id="flash-message"></div>

          <div class="alert alert-info text-center" id="loading">
            <i class="fa fa-spin fa-refresh"></i>&nbsp; Mengambil data, harap tunggu...
          </div>

          <div class="box box-info">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <div class="btn-group">
                  <button id="download-excel" type="button" class="btn btn-default btn-sm"><i class="fa fa-file-excel-o"> Download Excel</i></button>
                </div>
                
                <b>&nbsp Master Blok Sensus</b>
              </div>


              <div class="mailbox-controls">
                <form role="search">
                  <div class="form-group">

                    <div class="row">
                      <div class="col-xs-3">

                        <?php
                          $listData = array(
                            'prov_nama' =>'Nama Provinsi',
                            'prov_no' =>'Kode Provinsi',
                            'kab_nam' =>'Nama Kabupaten',
                            'kab_no' =>'Kode Kabupaten',
                            'kec_nama' =>'Nama Kecamatan',
                            'kec_no' =>'Kode Kecamatan',
                            'desa_nama' =>'Nama Desa',
                            'desa_no' =>'Kode Desa',
                            'blok_sensus' => 'blok_sensus'
                          );

                          echo CHtml::dropDownList('search_type', '', 
                              $listData,
                              array('class'=>'form-control'));
                        ?>  
                      </div>

                      <div class="col-xs-9">
                        
                        <input type="text" class="form-control" id="search" placeholder="Enter keyword for search">
                      </div>
                    </div>


                  </div>
                </form>
              </div>

              <!-- <div class="loading">
                <img class="loading_image"  height="50" width="50" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/loading.gif" /><br/>
                <b class="loading_message">Loading...</b>
              </div> -->

              <div class="table-responsive mailbox-messages">
                <table class="table table-border table-hover table-striped">
                  <thead>
                    <tr>
                      <th>
                      </th>
                      <!-- <td>NIP</td>
                      <td>Tanggal</td>
                      <td>Kegiatan</td>
                      <td>Action</td> -->
                    </tr>
                  </thead>
                   <tbody v-for="row in data">
                    <tr>
                      <td>
                        <div class="product-info">

                          <a class="product-title">{{ row.prov_no }}{{ row.kab_no}}{{ row.kec_no }}{{ row.desa_no}} {{ row.blok_sensus}}  
                            </a><br/>

                            <span class="product-description">({{ row.prov_no }}) {{row.prov_nama }}
                              <span class="text-muted pull-right">Jumlah KK: {{ row.kk }}, Jumlah BSBTT/BSBTK: {{ row.bsbtt }}</span> 
                            </span><br/>
                            
                            <span class="product-description">Kabupaten/Kota: ({{ row.kab_no }}) {{ row.kab_nama }}
                              <span class="text-muted pull-right">Muatan Dominan: {{ row.muatan_dominan }}</span>  
                            </span><br/>

                            <span class="product-description">Kecamatan: ({{ row.kec_no }}) {{ row.kec_nama }}
                              <span class="text-muted pull-right">Ruta Biasa: {{ row.ruta_biasa }}, Ruta Khusus: {{ row.ruta_khusus }}</span>  
                            </span><br/>

                            <span class="product-description">Desa/Kelurahan: ({{ row.desa_no}}) {{row.desa_nama}}
                              <span class="text-muted pull-right">ART Laki-laki: {{ row.art_laki }}, ART Perempuan: {{ row.art_perempuan }}</span>  
                            </span>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                    
                </table>
              </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
</div>



<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<script src="<?php echo $baseUrl;?>/dist/js/vue_page/mfd.js"></script>
