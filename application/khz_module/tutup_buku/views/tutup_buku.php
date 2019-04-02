
<?php
if (!empty($this->session->flashdata('message_success'))) {
  echo '
  <div class="alert alert-success alert-dismissible">
     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
     <h4><i class="icon fa fa-check"></i> Selamat.!</h4>
     '.$this->session->flashdata('message_success').'
 </div>
 ';
}

if (!empty($this->session->flashdata('message_failed'))) {
  echo '
  <div class="alert alert-warning alert-dismissible">
     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
     <h4><i class="icon fa fa-ban"></i> Perhatian.!</h4>
     '.$this->session->flashdata('message_failed').'
 </div>
 ';
}

?>
<div class="container">
    <div class="box box-primary px-2">
        <div class="box-header">
            <a href="<?php echo base_url('akuntansi') ?>" class="btn btn-link btn-back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
            <h3 class="display- mb-2">
                Tutup Buku
            </h3>
            <p class="mb-2"> Bulanan   :<?php echo $bulan;?></p>
            <p> Harian    :<?php echo $hari;?></p>
        </div>
        <div class="box-body">
            <div class="row">

                <div class="col card p-3 m-2">
                    <form id="eom" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>tutup_buku/eom">
                        <div class="form-group d-flex flex-column justify-content-center align-items-center">
                            <label>Bulanan</label>
                            <button type="submit" name="buka" class="btn btn-primary btn-block">Buka</button>
                            <button type="submit" name="bulan" class="btn btn-outline-primary btn-block">EOM</button>
                        </div>
                    </form>
                </div>

                <div class="col card p-3 m-2">
                    <form id="eod" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>tutup_buku/eod">
                        <div class="form-group d-flex flex-column justify-content-center align-items-center">
                            <label>Harian</label>
                            <button type="submit" name="buka" class="btn btn-primary btn-block">Buka</button>
                            <button type="submit" name="hari" class="btn btn-outline-primary btn-block">EOD</button>
                        </div>
                    </form>
                </div>

                 <div class="col card p-3 m-2">
                    <form id="eoy" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>tutup_buku/eoy">
                        <div class="form-group d-flex flex-column justify-content-center align-items-center">
                            <label for="eod">Tutup Buku Tahunan</label>
                            <button type="submit" class="btn btn-outline-primary">Akhir Siklus</button> 
                        </div>
                    </form>
                </div>

               <!--  <div class="col">
                    <form id="eod" method="post" enctype="multipart/form-data" action="<?php //echo base_url(); ?>tutup_buku/buka_akuntansi">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="hari" id="hari" value="" placeholder="End Of Day" class="form-control">
                                <div class="input-group-append">
                                    <input type="submit" value="Terapkan" class="btn btn-outline-secondary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div> -->
            </div>
        </div>
    </div>
</div>


<script>

    $("#hari").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    $("#bulan").datepicker({
        format: 'yyyy-mm-00',
        minViewMode: 1,
        autoclose: true
    });

    $("#tahun").datepicker({
        format: 'yyyy',
        minViewMode: 2,
        autoclose: true
    });


</script>