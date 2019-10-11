<style>a:hover{text-decoration: none;}</style>
<script type="text/x-template" id="jurnal">
<div>
  <b-container>
  <b-row>
  <b-col md="12" sm="12" col="12">
  <b-button variant="primary" @click="goBack()"><i class="fas fa-angle-left"></i> Kembali</b-button>
  </b-col>
  <div class="col-md-4" v-for="link in datalink">
    <a v-bind:href="link.link">
      <b-card :bg-variant="link.warna" text-variant="white" style="margin: 10px 0px;">
      <h2 class="text-center"><i :class="link.icon"></i></h2>
      <h3 class="text-center">{{link.judul}}</h3>
      </b-card>
    </a>
  </div>
  
  </b-row>
  </b-container>
</div>
</script>
<script>
Vue.component('jurnal', {
  template:'#jurnal',
  data: function () {
  return {
    datalink : [
{link:"<?php echo base_url();?>kasdanbank/front", judul:"Transaksi", warna:"danger", icon:"fas fa-money-check-alt"},
{link:"<?php echo base_url();?>jurnalumum/front", judul:"Jurnal Umum", warna:"info", icon:"fas fa-book-open" },
{link:"#/stock", judul:"Stock", warna:"success", icon:"fas fa-box-open"},
{link:"<?php echo base_url();?>m_coa", judul:"Chart of Account", warna:"warning", icon:"fas fa-list-alt"},
{link:"<?php echo base_url();?>hutang", judul:"Kartu Hutang", warna:"secondary", icon:"fas fa-comments-dollar"},
{link:"<?php echo base_url();?>piutang", judul:"Kartu Piutang", warna:"primary", icon:"fas fa-hand-holding-usd"},
{link:"<?php echo base_url();?>verifikasi_jurnal", judul:"Kartu Transaksi", warna:"primary", icon:"fas fa-hand-holding-usd"},
],
}
},
methods : {
goBack() {
window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/')
}
},
created: function () {}
})
</script>
<script type="text/x-template" id="laporan">
<div>
  <b-container>
  <b-row>
  <b-col md="12" sm="12" col="12" class="mb-3">
  <b-button variant="primary" @click="goBack()"><i class="fas fa-angle-left"></i> Kembali</b-button>
  </b-col>
  <b-col md="6" sm="6" col="12">
  <b-card>
  <b-row>
  <b-col md="12" sm="12" col="12" class="mt-3">
  <h3> Laporan Umum </h3>
  <hr>
  </b-col>
  <b-col md="6" sm="6" v-for="link in lapumum">
  <a v-bind:href="link.link">
    <b-card :bg-variant="link.warna" text-variant="white" style="margin: 10px 0px;">
    <h4 class="text-center"><i :class="link.icon"></i></h4>
    <h6 class="text-center">{{link.judul}}</h6>
    </b-card>
  </a>
  </b-col>
  </b-row>
  </b-card>
  </b-col>
  <b-col md="6" sm="6" col="12">
  <b-card>
  <b-row>
  <b-col md="12" sm="12" col="12" class="mt-3">
  <h3> Laporan Keuangan </h3>
  <hr>
  </b-col>
  <b-col md="6" sm="6" v-for="link in lapkeuangan">
  <a v-bind:href="link.link">
    <b-card :bg-variant="link.warna" text-variant="white" style="margin: 10px 0px;">
    <h4 class="text-center"><i :class="link.icon"></i></h4>
    <h6 class="text-center">{{link.judul}}</h6>
    </b-card>
  </a>
  </b-col>
  </b-row>
  </b-card>
  </b-col>
  </b-row>
  </b-container>
</div>
</script>
<script>
Vue.component('laporan', {
template:'#laporan',
data: function () {
return {
lapumum : [
{link:"<?php echo base_url('laporan_jurnal_buku_besar')?>", judul:"Laporan Jurnal & Buku Besar", warna:"primary", icon:"fas fa-file-signature"},
{link:"", judul:"Laporan Hutang Piutang", warna:"danger", icon:"fas fa-comment-dollar"},
],
lapkeuangan : [
{link:"", judul:"Laporan Laba Rugi", warna:"warning", icon:"fas fa-file-invoice-dollar"},
{link:"", judul:"Laporan Posisi Keuangan", warna:"secondary", icon:"fas fa-file-medical-alt"},
{link:"", judul:"Laporan Trial Balance", warna:"success", icon:"fas fa-file-invoice"},
{link:"", judul:"Laporan Arus Kas", warna:"info", icon:"fas fa-file-contract"},
{link:"", judul:"Laporan Perubahan Modal", warna:"info", icon:"fas fa-file-invoice"},
],
}
},
methods : {
goBack() {
window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/')
}
},
created: function () {}
})
</script>
<script type="text/x-template" id="buku">
<div>
  <b-container>
  <b-row>
  <b-col md="12" sm="12" col="12">
  <b-button variant="primary" @click="goBack()"><i class="fas fa-angle-left"></i> Kembali</b-button>
  </b-col>

  <b-col md="4" sm="4" class="mt-3">
  <b-card>
  <div>

    <h4>Buku Harian</h4>
    <hr>
    <b-form-checkbox v-model="checked" name="check-button" switch>
    Klik untuk membuka buku <b>(Status: {{ status }})</b>
    </b-form-checkbox>
  </div>
  <b-alert show class="mt-3">status buku saat ini <span><b>Tutup</b></span></b-alert>
  </b-card>
  </b-col>

  <b-col md="4" sm="4" class="mt-3">
  <b-card>
  <div>

    <h4>Buku Bulanan</h4>
    <hr>
    <b-form-checkbox v-model="checked" name="check-button" switch>
    Klik untuk membuka buku <b>(Status: {{ status }})</b>
    </b-form-checkbox>
  </div>
  <b-alert show class="mt-3">status buku saat ini <span><b>Tutup</b></span></b-alert>
  </b-card>
  </b-col>

  <b-col md="4" sm="4" class="mt-3">
  <b-card>
  <div>

    <h4>Buku Tahunan</h4>
    <hr>
    <b-form-checkbox v-model="checked" name="check-button" switch>
    Klik untuk membuka buku <b>(Status: {{ status }})</b>
    </b-form-checkbox>
  </div>
  <b-alert show class="mt-3">status buku saat ini <span><b>Tutup</b></span></b-alert>
  </b-card>
  </b-col>
  
  </b-row>
  </b-container>
</div>
</script>
<script>
Vue.component('buku', {
template:'#buku',
data: function () {
return {
status:0,
}
},
methods : {
goBack() {
window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/')
}
},
created: function () {}
})
</script>

<script type="text/x-template" id="stock">
<div>
  <b-container>
  <b-row>
  <b-col md="12" sm="12" col="12">
  <b-button variant="primary" @click="goBack()"><i class="fas fa-angle-left"></i> Kembali</b-button>
  </b-col>
  <div class="col-md-4" v-for="link in datalink">
    <a v-bind:href="link.link">
      <b-card :bg-variant="link.warna" text-variant="white" style="margin: 10px 0px;">
      <h2 class="text-center"><i :class="link.icon"></i></h2>
      <h3 class="text-center">{{link.judul}}</h3>
      </b-card>
    </a>
  </div>
  
  </b-row>
  </b-container>
</div>
</script>
<script>
Vue.component('stock', {
template:'#stock',
data: function () {
return {
datalink : [
{link:"<?php echo base_url();?>stock/laporanstock", judul:"Laporan Stock", warna:"danger", icon:"fas fa-money-check-alt"},
{link:"<?php echo base_url();?>stock/masuk_stock", judul:"Masuk Stock", warna:"info", icon:"fas fa-book-open" },
{link:"<?php echo base_url();?>stock/stock_opname", judul:"Stock Opname", warna:"success", icon:"fas fa-book-open" },
],
}
},
methods : {
goBack() {
window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/')
}
},
created: function () {}
})
</script>


<script type="text/x-template" id="home">
<div>
  <b-container>
  <b-row>
  <div class="col-md-4" v-for="link in datalink">
    <router-link :to="link.link" style="text-decoration: none;">
    <b-card :bg-variant="link.warna" text-variant="white" style="margin: 10px 0px;">
    <h2 class="text-center"><i :class="link.icon"></i></h2>
    <h3 class="text-center">{{link.judul}}</h3>
    </b-card>
    </router-link>
  </div>
  
  </b-row>
  </b-container>
</div>
</script>


<script>
Vue.component('home', {
template:'#home',
data: function () {
return {
datalink : [
{link:"jurnal", judul:"Pencatatan & Jurnal", warna:"danger", icon:"fas fa-book"},
{link:"laporan", judul:"Laporan", warna:"info", icon:"fas fa-file-alt" },
{link:"buku", judul:"Buku", warna:"success", icon:"fas fa-book-open"},
{link:"buku", judul:"Customer", warna:"primary", icon:"fas fa-user"},
{link:"buku", judul:"Supplier", warna:"secondary", icon:"fas fa-user"},
],
}
},
methods : {},
created: function () {}
})
</script>
<!-- define routes -->
<script>
const routes = [
{ path: '/', component: 'home' },
{ path: '/jurnal', component: 'jurnal' },
{ path: '/laporan', component: 'laporan' },
{ path: '/buku', component: 'buku' },
{ path: '/stock', component: 'stock' }
]
const router = new VueRouter({
routes // short for `routes: routes`
})
</script>
<!-- eksekusi vue -->
<script type="text/javascript">
var aplikasi=new Vue({
router,
el: '#app',
// define data - initial display text
data: {
nama:"Admin",
},
methods: {}
})
</script>