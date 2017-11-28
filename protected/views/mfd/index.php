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
                  <button id="download-excel" type="button" class="btn btn-default btn-sm" onclick="tableToExcel();"><i class="fa fa-file-excel-o"> Download Excel</i></button>
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



              <div class="table-responsive mailbox-messages">
                <table id="tabletoexcel" class="table table-border table-hover table-striped table-hidden">
                  <thead>
                    <tr>
                      <th>Kode Provinsi</th>
                      <th>Nama Provinsi</th>
                      <th>Kode Kabupaten</th>
                      <th>Nama Kabupaten</th>
                      <th>Kode Kecamatan</th>
                      <th>Nama Kecamatan</th>
                      <th>Kode Desa</th>
                      <th>Nama Desa</th>
                      <th>Blok Sensus</th>
                      <th>Jumlah KK</th>
                      <th>Jumlah BSBTT</th>
                      <th>Muatan Dominan</th>
                      <th>Jumlah Ruta Biasa</th>
                      <th>Jumlah Ruta Khusus</th>
                      <th>Jumlah ART Laki</th>
                      <th>Jumlah ART Perempuan</th>
                    </tr>
                  </thead>
                   <tbody v-for="row in data">
                    <tr>
                  
                      <td>{{ row.prov_no }}   </td>
                      <td>{{ row.prov_nama }}</td>
                      <td>{{ row.kab_no}}</td>
                      <td>{{ row.kab_nama }}</td>
                      <td>{{ row.kec_no }}</td>
                      <td>{{ row.kec_nama }}</td>
                      <td>{{ row.desa_no}}</td>
                      <td>{{ row.desa_nama}}</td>
                      <td>{{ row.blok_sensus}}</td>
                      <td>{{ row.kk }}</td>
                      <td>{{ row.bsbtt }}</td>
                      <td>{{ row.muatan_dominan }}</td>
                      <td>{{ row.ruta_biasa }}</td>
                      <td>{{ row.ruta_khusus }}</td>
                      <td>{{ row.art_laki }}</td>
                      <td>{{ row.art_perempuan }}</td>
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

<script>
    var tableToExcel = (function() {   
        
        var uri = "data:application/vnd.ms-excel;base64,",
            template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http:\/\/www.w3.org\/TR\/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}<\/x:Name><x:WorksheetOptions><x:DisplayGridlines\/><\/x:WorksheetOptions><\/x:ExcelWorksheet><\/x:ExcelWorksheets><\/x:ExcelWorkbook><\/xml><![endif]--><\/head><body><table>{table}<\/table><\/body><\/html>',
            base64 = function(s) {
                return window.btoa(unescape(encodeURIComponent(s)));
            },
            format = function(s, c) {
                return s.replace(/{(\w+)}/g, function(m, p) {
                    return c[p];
                });
            };

        return function() {
            table = 'tabletoexcel';
            fileName = 'mfd1673.xls';
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {
                worksheet: fileName || 'Worksheet', 
                table: table.innerHTML
            }

            $("<a id='dlink'  style='display:none;'></a>").appendTo("body");
                document.getElementById("dlink").href = uri + base64(format(template, ctx))
                document.getElementById("dlink").download = fileName;
                document.getElementById("dlink").click();
        }

    })();  
</script>