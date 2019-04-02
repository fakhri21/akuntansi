<div class="container">
    <div class="row">
        <div class="col">
            <div class="box box-primary mb-2">
                <div class="box-header">
                    <div class="row">
                        <div class="col">
                            <a href="<?php echo base_url('m_kelompok_coa') ?>" class="btn btn-link btn-back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                            <h2><?php echo $button . (isset($nama_kelompok_coa) ? ' '. $nama_kelompok_coa : '') ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form action="<?php echo $action; ?>" method="post">
                                <div class="form-group row">
                                    <label class="col" for="id_kelompok_coa">Id Kelompok Coa <?php echo form_error('id_kelompok_coa') ?></label>
                                    <div class="col">
                                        <input  type="text" class="form-control" name="id_kelompok_coa" id="id_kelompok_coa" placeholder="Id Kelompok Coa" value="<?php echo $id_kelompok_coa; ?>" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col" for="id_kategori">Id Kategori <?php echo form_error('id_kategori') ?></label>
                                    <div class="col">
                                        <?php echo cmb_dinamis('id_kategori','m_akuntansi_kategori','nama_kategori','id_kategori','id_kategori') ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col" for="nama_kelompok_coa">Nama Kelompok Coa <?php echo form_error('nama_kelompok_coa') ?></label>
                                    <div class="col">
                                        <input type="text" class="form-control" name="nama_kelompok_coa" id="nama_kelompok_coa" placeholder="Nama Kelompok Coa" value="<?php echo $nama_kelompok_coa; ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6 col-xs-12 mx-auto">
                                            <div class="row">
                                                <button type="submit" class="col btn btn-primary"><?php echo $button ?></button> 
                                                <a href="<?php echo base_url('m_kelompok_coa') ?>" class="col btn btn-link">Batal</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="uniqid" value="<?php echo $uniqid; ?>" /> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>


</body>
<script>
    $(document).ready(function() {

        $("#id_kategori").selectize({
           create: false
       });
    })
    
</script>

</html>