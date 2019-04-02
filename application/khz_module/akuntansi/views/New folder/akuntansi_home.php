
<!--

    <a class="btn btn-primary" href="">Jurnal Umum</a>
    <a class="btn btn-primary" href="<?php echo base_url('admin/akuntansi/laporan_kas');?>">Kas</a>
    <a class="btn btn-primary" href="<?php echo base_url('admin/akuntansi/neraca');?>">Neraca</a>
    <a class="btn btn-primary" href="<?php echo base_url('admin/akuntansi/laba_rugi');?>">Laba-rugi</a>
    <a class="btn btn-primary" href="<?php echo base_url('admin/akuntansi/pendapatan');?>">Pendapatan</a>
    <a class="btn btn-primary" href="<?php echo base_url('admin/akuntansi/pengeluaran');?>">Pengeluaran</a>

-->

<div class="col-md-3">
    <div class="btn-group btn-block">
    <button type="button" class="btn btn-primary btn-lg btn-block dropdown-toggle" style="width:100%" data-toggle="dropdown">
    <i class="fa fa-file"></i> Laporan <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu">
      <li><a href="<?php echo base_url('akuntansi/laba_rugi');?>">Laba-Rugi</a></li>
      <li><a href="<?php echo base_url('akuntansi/neraca');?>">Neraca</a></li>
      <li><a href="<?php echo base_url('akuntansi/');?>">Persediaan</a></li>
      <li><a href="<?php echo base_url('akuntansi/jurnal_umum');?>">Jurnal Umum</a></li>
    </ul>
  </div>
</div>

<div class="col-md-3">

<div class="btn-group btn-block">
    <button type="button" class="btn btn-success btn-lg btn-block dropdown-toggle" style="width:100%" data-toggle="dropdown">
    <i class="fa fa-book"></i> Buku Besar <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu">
		<?php foreach ($akun as $akundata) { ?>
      <li><a href="buku_besar/<?php echo $akundata['no_akun']; ?>"><?php echo "" .$akundata['nama_akun']."";?></a></li>
	  <?php }?>
    </ul>
  </div>
</div>

<div class="col-md-3">
    <div class="btn-group btn-block">
    <button type="button" class="btn btn-warning btn-lg btn-block dropdown-toggle" style="width:100%" data-toggle="dropdown">
    <i class="fa fa-dollar"></i> Kas &amp; Bank <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu">
      <li><a href="<?php echo base_url('akuntansi/pendapatan');?>">Pendapatan</a></li>
      <li><a href="<?php echo base_url('akuntansi/pengeluaran');?>">Pengeluaran</a></li>
    </ul>
  </div>
</div>

<div class="col-md-3">
    <div class="btn-group btn-block">
    <button type="button" class="btn btn-danger btn-lg btn-block dropdown-toggle" style="width:100%" data-toggle="dropdown">
    <i class="fa fa-square"></i> Persediaan <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu">
      <li><a href="<?php echo base_url('akuntansi/');?>">Masuk Barang</a></li>
      <li><a href="<?php echo base_url('akuntansi/');?>">Keluar Barang</a></li>
    </ul>
  </div>
</div>
