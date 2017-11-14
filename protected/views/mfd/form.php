<script src="https://www.gstatic.com/firebasejs/4.6.0/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.6.0/firebase-firestore.js"></script>

<div id="mfdform_tag">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Master File Desa</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form">

            <input type="hidden" v-model="idnya">
            
            <div class="row row-print">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Kode Provinsi</label>
                        <input v-model="prov_no" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="form-group">
                        <label>Nama Provinsi</label>
                        <input v-model="prov_nama" type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row row-print">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Kode Kabupaten</label>
                        <input v-model="kab_no" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="form-group">
                        <label>Nama Kabupaten</label>
                        <input v-model="kab_nama" type="text" class="form-control">
                    </div>
                </div>
            </div>


            <div class="row row-print">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Kode Kecamatan</label>
                        <input v-model="kec_no" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="form-group">
                        <label>Nama Kecamatan</label>
                        <input v-model="kec_nama" type="text" class="form-control">
                    </div>
                </div>
            </div>


            <div class="row row-print">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Kode Desa</label>
                        <input v-model="desa_no" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="form-group">
                        <label>Nama Desa</label>
                        <input v-model="desa_nama" type="text" class="form-control">
                    </div>
                </div>
            </div>


            <div class="row row-print">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Blok Sensus (contoh: 001B, 005P)</label>
                        <input v-model="blok_sensus" type="text" class="form-control">
                    </div>
                </div>
            </div>



            <div class="row row-print">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jumlah KK</label>
                        <input v-model="kk" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jumlah BSBTT/BSTTK</label>
                        <input v-model="bsbtt" type="text" class="form-control">
                    </div>
                </div>
            </div>


            <div class="row row-print">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Muatan Dominan</label>
                        <input v-model="muatan_dominan" type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row row-print">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Ruta Biasa</label>
                        <input v-model="ruta_biasa" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Ruta Khusus</label>
                        <input v-model="ruta_khusus" type="text" class="form-control">
                    </div>
                </div>
            </div>
                

            <div class="row row-print">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>ART Laki-laki</label>
                        <input v-model="art_laki" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>ART Perempuan</label>
                        <input v-model="art_perempuan" type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="button" id="btn-submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>


<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<script src="<?php echo $baseUrl;?>/dist/js/vue_page/mfd_form.js"></script>