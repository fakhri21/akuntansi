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






    
<div id="app">

  <div class="container">
    <div class="row">
      
      <div class="col-md-6 mt-3 mb-3">
          <b-alert variant="info" show dismissible><i class="fas fa-info-circle"></i> Halo {{nama}}, Selamat datang di Dashboard</b-alert>
      </div>

      <div class="col-md-6 mt-3 mb-3 text-right">
        <a href="<?php echo site_url();?>" class="btn btn-success right"><i class="fas fa-home"></i> Halaman Utama</a>
      </div>

    </div>
  </div>

  <transition name="custom-classes-transition"
        enter-active-class="animated slideInUp">
        <router-view></router-view>
  </transition>

  <!--dashboard></dashboard -->
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
  <!-- <div class="col-md-4 col-sm-6 col-xs-12 mb-4">
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
 -->
  
</div><!-- /row -->
</div><!-- /col 12 -->

<div class="col-md-12 col-sm-12 col-xs-12">
<div class="row">
  <div class="col-md-4 col-sm-6 col-xs-12 mb-4">
    <div class="box-akuntansi" >
      <a href="<?php echo base_url('laporan_keuangan')?>" class="text-center">
        <i class="fa fa-dollar fa-2x"></i>
        <h4>Laporan Keuangan</h4>
      </a>
    </div>
  </div>
  <div class="col-md-4 col-sm-6 col-xs-12 mb-4">
    <div class="box-akuntansi">
      <a href="<?php echo base_url('laporan_jurnal_buku_besar')?>"  class="text-center">
        <i class="fa fa-book fa-2x"></i>
        <h4>Laporan Jurnal & Buku Besar</h4>
      </a>
    </div>
  </div>
  <div class="col-md-4 col-sm-6 col-xs-12 mb-4">
    <div class="box-akuntansi">
      <a href="<?php echo base_url('verifikasi_jurnal')?>" class="text-center">
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
      <a href="<?php echo base_url('kasdanbank')?>" class="text-center">
        <i class="fa fa-bank fa-2x"></i>
        <h4>Kas &amp; Bank</h4>
      </a>
    </div>
  </div>
  <div class=" col-md-4 col-sm-6 col-xs-12 mb-4">
    <div class="box-akuntansi" >
      <a href="<?php echo base_url('jurnalumum')?>" class="text-center">
        <i class="fa fa-file-text-o fa-2x"></i>
        <h4>Jurnal umum</h4>
      </a>
    </div>
  </div>
  <div class="col-md-4 col-sm-6 col-xs-12 mb-4">
    <div class="box-akuntansi" >
      <a href="<?php echo base_url('stock')?>" class="text-center">
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

wadidaw