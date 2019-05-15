<style>
.box-akuntansi{
width: 100%;
height: 110px;
background: #fff;
border-bottom: 2px solid #42a5f5;
display: flex;
align-items: center;
justify-content: center;
}
</style>

<div class="col-md-12 mt-5 mb-5">
  <a href="<?php echo site_url();?>" class="btn btn-primary"><i class="fa fa-angle-left"></i> Halaman Utama</a >
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
<div class="row">
  <div class="col-md-4 col-sm-6 col-xs-12 mb-4">
    <div class="box-akuntansi" >
      <a href="<?php echo base_url('m_coa')?>" class="my-auto text-center">
        <i class="fa fa-book fa-2x"></i>
        <h4>Chart of Account</h4>
      </a>
    </div>
  </div>
  <div class="col-md-4 col-sm-6 col-xs-12 mb-4">
    <div class="box-akuntansi" >
      <a href="<?php echo base_url('m_kelompok_coa')?>" class="text-center">
        <i class="fa fa-book fa-2x"></i>
        <h4>Kelompok COA</h4>
      </a>
    </div>
  </div>
  <div class="col-md-4 col-sm-6 col-xs-12 mb-4">
    <div class="box-akuntansi" >
      <a href="<?php echo base_url('m_akuntansi_kategori')?>" class="text-center">
        <i class="fa fa-book fa-2x"></i>
        <h4>Kategori COA</h4>
      </a>
    </div>
  </div>

  
</div><!-- /row -->
</div><!-- /col 12 -->

<div class="col-md-12 col-sm-12 col-xs-12">
<div class="row">
  <div class="col-md-4 col-sm-6 col-xs-12 mb-4">
    <div class="box-akuntansi" >
      <a href="<?php echo base_url('akuntansi/panel_laporan_keuangan')?>" class="text-center">
        <i class="fa fa-dollar fa-2x"></i>
        <h4>Laporan Keuangan</h4>
      </a>
    </div>
  </div>
  <div class="col-md-4 col-sm-6 col-xs-12 mb-4">
    <div class="box-akuntansi">
      <a href="<?php echo base_url('akuntansi/panel_laporan_jurnal_buku_besar')?>"  class="text-center">
        <i class="fa fa-book fa-2x"></i>
        <h4>Laporan Jurnal & Buku Besar</h4>
      </a>
    </div>
  </div>
  <div class="col-md-4 col-sm-6 col-xs-12 mb-4">
    <div class="box-akuntansi">
      <a href="<?php echo base_url('akuntansi/verifikasi_jurnal')?>" class="text-center">
        <i class="fa fa-book fa-2x"></i>
        <h4>Voucher Akuntansi</h4>
      </a>
    </div>
  </div>
  
</div><!-- /row -->
</div><!-- /col 12 -->

<div class="col-md-12">
<div class="row">
  
  <div class="col-md-4 col-sm-6 col-xs-12 mb-4">
    <div class="box-akuntansi" >
      <a href="<?php echo base_url('akuntansi/kasdanbank')?>" class="text-center">
        <i class="fa fa-bank fa-2x"></i>
        <h4>Kas &amp; Bank</h4>
      </a>
    </div>
  </div>
  <div class=" col-md-4 col-sm-6 col-xs-12 mb-4">
    <div class="box-akuntansi" >
      <a href="<?php echo base_url('akuntansi/jurnalumum')?>" class="text-center">
        <i class="fa fa-file-text-o fa-2x"></i>
        <h4>Jurnal umum</h4>
      </a>
    </div>
  </div>
  <div class="col-md-4 col-sm-6 col-xs-12 mb-4">
    <div class="box-akuntansi" >
      <a href="<?php echo base_url('akuntansi/panel_stock')?>" class="text-center">
        <i class="fa fa-cube fa-2x"></i>
        <h4>Stock</h4>
      </a>
    </div>
  </div>
  
</div>

</div>
<div class="col-md-4 col-sm-6 col-xs-12 mb-4">
  <div class="box-akuntansi" >
    <a href="<?php echo base_url('tutup_buku')?>" class="text-center">
      <i class="fa fa-close fa-2x"></i>
      <h4>Tutup Buku</h4>
    </a>
  </div>
</div>