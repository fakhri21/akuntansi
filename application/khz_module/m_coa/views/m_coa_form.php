<div class="container">
    <div class="row mb-2">
        <div class="col">
            
        </div>
    </div>
    <div class="row ">
        <div class="col">
            <div class="box box-primary mb-2">
                <div class="box-header">
                     <a href="<?php echo base_url('m_coa') ?>" class="btn btn-link btn-back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                     <h2><?php echo $button . (isset($id_kelompok_coa) ? ' '. $nama_coa : '') ?></h2>
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
                            <form action="<?php echo $action; ?>" method="post">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-4" for="id_coa">Id Coa <?php echo form_error('id_coa') ?></label>
                                            <div class="col">
                                                <input type="text" class="form-control" name="id_coa" id="id_coa" placeholder="Id Coa" value="<?php echo $id_coa; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-4" for="id_kelompok_coa">Id Kelompok Coa <?php echo form_error('id_kelompok_coa') ?></label>
                                            <div class="col">
                                                <?php echo cmb_dinamis('id_kelompok_coa','m_kelompok_coa','nama_kelompok_coa','id_kelompok_coa','id_kelompok_coa') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-4" for="nama_coa">Nama Coa <?php echo form_error('nama_coa') ?></label>
                                            <div class="col">
                                                <input type="text" class="form-control" name="nama_coa" id="nama_coa" placeholder="Nama Coa" value="<?php echo $nama_coa; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-4" for="saldo_awal">Saldo Awal <?php echo form_error('saldo_awal') ?></label>
                                            <div class="col">
                                                <input type="text" class="form-control" name="saldo_awal" id="saldo_awal" placeholder="Saldo Awal" value="<?php echo $saldo_awal; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="hidden" name="uniqid" value="<?php echo $uniqid; ?>" /> 
                                    <div class="col-lg-6 col-xs-12 mx-auto">
                                        <div class="row">
                                            <button type="submit" class="col btn btn-primary"><?php echo $button ?></button> 
                                            <a href="<?php echo base_url('m_coa') ?>" class="col btn btn-link   ">Cancel</a>
                                        </div>
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
    $(document).ready(function() {

        $("#id_kelompok_coa").selectize({
            create: false
        });
    })

</script>