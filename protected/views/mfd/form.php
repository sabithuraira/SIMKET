<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Master File Desa</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form">

        <div class="row row-print">
            <div class="col-md-2">
                <div class="form-group">
                    <label>Kode Provinsi</label>
                    <input type="text" class="form-control">
                </div>
            </div>

            <div class="col-md-10">
                <div class="form-group">
                    <label>Nama Provinsi</label>
                    <input type="text" class="form-control">
                </div>
            </div>
        </div>

        <div class="row row-print">
            <div class="col-md-2">
                <div class="form-group">
                    <label>Kode Kabupaten</label>
                    <input type="text" class="form-control">
                </div>
            </div>

            <div class="col-md-10">
                <div class="form-group">
                    <label>Nama Kabupaten</label>
                    <input type="text" class="form-control">
                </div>
            </div>
        </div>


        <div class="row row-print">
            <div class="col-md-2">
                <div class="form-group">
                    <label>Kode Kecamatan</label>
                    <input type="text" class="form-control">
                </div>
            </div>

            <div class="col-md-10">
                <div class="form-group">
                    <label>Nama Kecamatan</label>
                    <input type="text" class="form-control">
                </div>
            </div>
        </div>


        <div class="row row-print">
            <div class="col-md-2">
                <div class="form-group">
                    <label>Kode Desa</label>
                    <input type="text" class="form-control">
                </div>
            </div>

            <div class="col-md-10">
                <div class="form-group">
                    <label>Nama Desa</label>
                    <input type="text" class="form-control">
                </div>
            </div>
        </div>


        <div class="row row-print">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Blok Sensus (contoh: 001B, 005P)</label>
                    <input type="text" class="form-control">
                </div>
            </div>
        </div>



        <div class="row row-print">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Jumlah KK</label>
                    <input type="text" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Jumlah BSBTT/BSTTK</label>
                    <input type="text" class="form-control">
                </div>
            </div>
        </div>


        <div class="row row-print">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Muatan Dominan</label>
                    <input type="text" class="form-control">
                </div>
            </div>
        </div>

        <div class="row row-print">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Ruta Biasa</label>
                    <input type="text" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Ruta Khusus</label>
                    <input type="text" class="form-control">
                </div>
            </div>
        </div>
            

        <div class="row row-print">
            <div class="col-md-6">
                <div class="form-group">
                    <label>ART Laki-laki</label>
                    <input type="text" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>ART Perempuan</label>
                    <input type="text" class="form-control">
                </div>
            </div>
        </div>

        <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>


<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<script src="<?php echo $baseUrl;?>/dist/js/vue_page/mfd_form.js"></script>