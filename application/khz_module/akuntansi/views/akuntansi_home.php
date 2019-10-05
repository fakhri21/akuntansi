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