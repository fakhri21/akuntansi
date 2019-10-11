<style>a:hover{text-decoration: none;}</style>
<script type="text/x-template" id="knb">
<div>
  <b-container>
    <b-row>
      <b-col md="12" sm="12">
        <b-button variant="primary" @click="goBack()" class="mt-2">
          <i class="fas fa-angle-left"></i> Kembali</b-button>
        <b-row class="pt-2 pb-5">
          <b-col md="4" sm="4" class="mb-2">
            <!-- vouhcer -->
            <voucher />
          </b-col>

          <b-col md="8" sm="8" class="mb-2">
          </b-col>

          <b-col md="4" sm="4">
            <inputan />
            <!-- Inputan -->
          </b-col>
          <b-col md="8" sm="8">
            <table_transaksi />
            <!-- Table transaksi -->
          </b-col>

        </b-row>

      </b-col>

    </b-row>
  </b-container>
</div>
</script>

<script>
Vue.component('knb', {
    template: '#knb',
    data: function () {
      return {
        
      }
    },
    methods: {
      goBack() {
        window.history.back();
      }
    },
    created: function () {}
  }) 
</script>

<script type="text/x-template" id="voucher">
  <b-card>
    <div v-show="selected_voucher!=null">
    <h4>Waktu / Tanggal : {{waktu_voucher}}</h4>
        <h4>ID VOUCHER : {{id_current_voucher}}</h4>
        <h4>TIPE VOUCHER : {{id_tipe_voucher}}</h4>
        <b-table striped hover
               :items="detail_voucher"
               :fields="fields"
        >
          <template slot="no" scope="row">
            {{row.index+1}}
          </template>
        </b-table>
    </div>
    <div class="">
      <b-form-select v-model="selected_voucher" id="search_voucher" placeholder="Voucher">
        <option v-for="voucher in options_voucher" v-bind:value="voucher">{{ voucher.id_voucherjurnal }}</option>
      </b-form-select>
      <div class="search-voucher-error" style="color:red;display:none;">Silahkan pilih kode voucher terlebih dahulu</div>
      <br>
      <button id="bukaUlang" class="btn btn-success" @click="current_voucher">
        <i class="fa fa-arrow-right"></i> Buka Ulang</button>
    </div>

    <div>
      <h4>
        <label>Id Voucher :</label>
        <span id="id_current_voucher">{{id_current_voucher}}</span>
      </h4>
    </div>   
    </b-card>
</script>

<script>
Vue.component('voucher', {
    template: '#voucher',
    data: function () {
      return {
        options_voucher:null,
        selected_voucher: null,
        waktu_voucher:"",
        id_tipe_voucher:"",
        id_current_voucher:"",
        detail_voucher:[],
        fields:[{key: "no",label: "No"},{key: "keterangan",label: "Keterangan"},{key: "nilai",label: "Nilai"}]
      }
    },
    methods: {
      refreshvoucher(){
        var _this = this;
        $.getJSON("<?php echo base_url('akuntansi/list_voucher/kb') ?>", function (json) {
          _this.options_voucher = json;
        });
      },
      current_voucher() {
        var _this=this
        uniqid_voucher=_this.selected_voucher.uniqid
        $.getJSON("<?php echo base_url('akuntansi/detail_voucher/') ?>"+uniqid_voucher, function (json) {
          _this.id_current_voucher=_this.selected_voucher.id_voucherjurnal
          _this.id_tipe_voucher=_this.selected_voucher.id_tipe_voucher
          _this.waktu_voucher=_this.selected_voucher.waktu
          _this.detail_voucher=json
        });  
      }
    },
    created: function () {
      var _this = this;
      _this.refreshvoucher()
    }
  }) 
</script>

<script type="text/x-template" id="inputan">
  <b-card>
    <h4>Transaksi</h4>
    <hr>
    <b-form-group label="Status">
      <b-form-select v-model="select_radio" @change="refreshpembayaran" :options="value_radio" name="radio-inline"></b-form-select>
    </b-form-group>
    <label>Paymen Type</label>
    <b-form-select  id="id_coa" v-model="items_jurnal.id_coa">
      <option v-for="payment in options_payment" v-bind:value="{ id_coa: payment.id_coa, nama_coa: payment.nama_coa }">{{ payment.nama_coa }} - {{ payment.id_coa }} </option>
    </b-form-select>
    <label>Untuk Pembayaran / {{select_radio}}</label>
    <b-form-select id="id_coa" v-model="items_jurnal.invid_coa" >
      <option v-for="payment in options_pembayaran" v-bind:value="{ id_coa: payment.id_coa, nama_coa: payment.nama_coa }">{{ payment.nama_coa }} - {{ payment.id_coa }} </option>
    </b-form-select>
    <label>Jumlah</label>
    <b-form-input v-model="items_jurnal.nilai"></b-form-input>
    <label>Keterangan</label>
    <b-form-input v-model="items_jurnal.keterangan"></b-form-input>
    <b-button variant="primary" @click="tambahjurnal">OK</b-button>
    <b-button variant="danger">Batal</b-button>
  </b-card>
</script>

<script>
Vue.component('inputan', {
    template: '#inputan',
    data: function () {
      return {
        selected: null,
        items_jurnal:{  
          id_coa:"",
          invid_coa:"",
          coa:"",
          nilai:"",
          keterangan:""
        },
        options_payment:{},
        options_pembayaran:[],
        value_radio: [{
            text: 'In',
            value: 'pendapatan'
          },
          {
            text: 'Out',
            value: 'pengeluaran'
          },
        ],
        select_radio: 'pendapatan'
      }
    },
    methods: {
      refreshpaymenttype(kondisi) {
        var _this = this;
        $.getJSON("<?php echo base_url('akuntansi/list_coa/') ?>"+kondisi, function (json) {
          _this.options_payment = json;
        });
      },
      refreshpembayaran(kondisi) {
        var _this = this;
        $.getJSON("<?php echo base_url('akuntansi/list_coa/') ?>"+kondisi, function (json) {
          _this.options_pembayaran = json;
          console.log(json)
        });
      },
      tambahjurnal(){
        var _this = this;
        var record=[]
        var inversrecord=[]
        
        if (_this.select_radio==="pendapatan") {
            // In
            record={
              'id_coa'    :_this.items_jurnal.id_coa.id_coa,
              'debit'     :_this.items_jurnal.nilai,
              'keterangan':_this.items_jurnal.keterangan,
            };
            inversrecord={
              'id_coa'     :_this.items_jurnal.invid_coa.id_coa,
              'kredit'     :_this.items_jurnal.nilai,
              'keterangan' :_this.items_jurnal.keterangan,
            }
        } else {
            // out
            record={
              'id_coa'    :_this.items_jurnal.id_coa.id_coa,
              'kredit'    :_this.items_jurnal.nilai,
              'keterangan':_this.items_jurnal.keterangan,
            };
            inversrecord={
              'id_coa'    :_this.items_jurnal.invid_coa.id_coa,
              'debit'     :_this.items_jurnal.nilai,
              'keterangan':_this.items_jurnal.keterangan,
            };

        }
        
        _this.items_jurnal.coa = _this.items_jurnal.id_coa.nama_coa +" / "+_this.items_jurnal.invid_coa.nama_coa
        _this.items_jurnal.record=record
        _this.items_jurnal.inversrecord=inversrecord
        data_jurnal.push(JSON.parse(JSON.stringify(_this.items_jurnal)))
      }
    },
    created: function () {
      var _this = this;
      _this.refreshpaymenttype('kb')
      _this.refreshpembayaran(_this.select_radio)

      console.log(_this.select_radio)
    }
  }) 
</script>

<script type="text/x-template" id="table_transaksi">
  <b-card>
    <h4>Transaksi</h4>
    <hr>
    <b-table
                    class="table table-striped table-inverse table-responsive"
                    id="my-table"
                    show-empty
                    :items="items"
                    :filter="keyword"
                    :fields="fields"
                    :current-page="currentPage"
                    :per-page="perPage"
                    
                    >
      <div slot="actions" slot-scope="row">
        <b-button size="sm" @click="hapusitem(row.index)">
          Hapus
        </b-button>
      </div>
    </b-table>

    <b-pagination v-model="currentPage" :total-rows="totalRows" :per-page="perPage" class="my-0" aria-controls="my-table">
    </b-pagination>
    <br>
    <button class="btn btn-primary" @click="simpan_jurnal">
      <i class="fa fa-save"></i> save</button>
    <button class="btn btn-success" >
      <i class="fa fa-refresh"></i> Refresh</button>
  </b-card>
</script>

<script>
Vue.component('table_transaksi', {
    template: '#table_transaksi',
    data: function () {
      return {
        selected: null,
        totalRows:"",
        currentPage: 1,
        perPage: 5,
        pageOptions: [5, 10, 15],
        keyword: "",
        items: data_jurnal,
        fields: [
        {
          key: "keterangan",
          label: "Keterangan",
          sortable: true
        },
        {
          key: "coa",
          label: "COA",
          sortable: true
        },
        {
          key: "nilai",
          label: "Nilai",
          sortable: true
        },
        {
          key: "actions",
          label: "Aksi",
          sortable: true
        }
        ]
      }
    },
    methods: {
      hapusitem(index){
        data_jurnal.splice(index,1)
      },
      simpan_jurnal(){
        var data={
          uniqid:uniqid_voucher,
          data:data_jurnal
        }
        $.post("<?php echo base_url('kasdanbank/index_post/simpan_kasbank') ?>",data,function (par) {
          alert(par);
          //data_jurnal=[]
          uniqid_voucher=null
        })
      }
    }
  }) 
</script>


  
  <!-- eksekusi vue -->
  <script type = "text/javascript" >
  var data_jurnal=[]
  var uniqid_voucher=null
  var aplikasi = new Vue({
    el: '#app',
    // define data - initial display text
    data: {
      nama: "Admin",
    },
    methods: {}
  })
</script>