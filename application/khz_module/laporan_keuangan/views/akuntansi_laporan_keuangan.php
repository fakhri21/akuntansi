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
    <div class="row">
        <div class="col">
            <div class="box box-primary mb-2">
                <div class="box-header">
                    <a href="<?php echo base_url('laporan_keuangan') ?>" class="btn btn-link btn-back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                    <h1>Laporan Keuangan</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>laporan_keuangan/tampil_laporan_keuangan/neraca">
                            <label for="neraca1">Neraca</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Periode</span>
                                    </div>
                                    <input type="text" class="hari form-control" id="neraca1" name="hari">
                                    <div class="input-group-append">
                                        <input type="submit" name="" value="Cetak" class="btn btn-outline-secondary">
                                    </div>
                                </div>
                                        <div>
                                            Summary <input  type="radio" name="model" value="kelompok" checked="checked">
                                            Detail <input  type="radio" name="model" value="detail"> 
                                        </div>
                            </form>
                        </div> 
                        <div class="col">
                            <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>laporan_keuangan/tampil_laporan_keuangan/trial_balance">
                                <label for="trialbalance">Trial Balance</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Periode</span>
                                    </div>
                                    <input type="text" class="hari form-control" id="trialbalance" name="hari">
                                    <div class="input-group-append">
                                        <input type="submit" name="" value="Cetak" class="btn btn-outline-secondary">
                                    </div>
                                </div>
                            </form>
                        </div> 
                        <div class="col">
                            <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>laporan_keuangan/tampil_laporan_keuangan/labarugi">
                                <label for="labarugi1">Laba Rugi</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Periode</span>
                                    </div>
                                    <input type="text" class="hari form-control" id="labarugi1" name="hari">
                                    <div class="input-group-append">
                                        <input type="submit" name="" value="Cetak" class="btn btn-outline-secondary">
                                    </div>
                                </div>
                                    <div>
                                        Summary <input  type="radio" name="model" value="kelompok" checked="checked">
                                        Detail <input  type="radio" name="model" value="detail"> 
                                    </div>
                            </form>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col">
                            <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>laporan_keuangan/excel_laporan_keuangan/neraca">
                                <label for="neraca2">Neraca Excel</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Periode</span>
                                    </div>
                                    <input type="text" class="hari form-control" id="neraca2" name="hari">
                                    <div class="input-group-append">
                                        <input type="submit" name="" value="Cetak" class="btn btn-outline-secondary">
                                    </div>
                                </div>
                            </form>
                        </div> 
                        <div class="col">
                        
                        </div> 
                        <div class="col">
                            <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>laporan_keuangan/excel_laporan_keuangan/labarugi">
                                <label for="exampleInputEmail1">Excel Laba Rugi</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Periode</span>
                                    </div>
                                    <input type="text" class="hari form-control" id="exampleInputEmail1" name="hari">
                                    <div class="input-group-append">
                                        <input type="submit" name="" value="Cetak" class="btn btn-outline-secondary">
                                    </div>
                                </div>
                            </form>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    $(".hari").datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });


</script>
