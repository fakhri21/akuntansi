<style>a:hover{text-decoration: none;}</style>
<script type="text/x-template" id="jurnalumum">
<div>
  <b-container>
    <b-row>

      <b-col md="12" sm="12">

        <b-button variant="primary" @click="goBack()" class="mt-2">
          <i class="fas fa-angle-left"></i> Kembali</b-button>

        <b-row class="pt-2 pb-5">

          <b-col md="4" sm="4" class="mb-2">
            <voucher />
          </b-col>

          <b-col md="8" sm="8" class="mb-2">
          </b-col>

          <b-col md="4" sm="4">
            <inputan />
          </b-col>
          <b-col md="8" sm="8">
            <table_transaksi />
          </b-col>

        <laporan_jurnalumum />
        </b-row>

      </b-col>

    </b-row>
  </b-container>
</div>
</script>
<script>
Vue.component('jurnalumum', {
template:'#jurnalumum',
data: function () {
return {
selected: null,



items: [
      
      {kolom1:"isi",kolom2:"isi",kolom3:"isi",kolom4:"isi",kolom5:"isi"},
      {kolom1:"isi",kolom2:"isi",kolom3:"isi",kolom4:"isi",kolom5:"isi"},

      ],
      
      fields: [
        { key: "kolom1", label: "kolom1", sortable: true },
        { key: "kolom2", label: "kolom2", sortable: true },
        { key: "kolom3", label: "kolom3", sortable: true },
        { key: "kolom4", label: "kolom4", sortable: true },
        { key: "kolom5", label: "kolom5", sortable: true }
      ]

}
},


methods : {
goBack(){
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
      </b-form-select><div class="search-voucher-error" style="color:red;display:none;">Silahkan pilih kode voucher terlebih dahulu</div>
      <button id="bukaUlang" class="btn btn-success" @click="current_voucher">
        <i class="fa fa-arrow-right"></i> Buka Ulang</button>
    </div>

    <div>
        <h4><label>Id Voucher :</label>
            <span id="id_current_voucher">{{id_current_voucher}}</span></h4>
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
        $.getJSON("<?php echo base_url('akuntansi/list_voucher/ju') ?>", function (json) {
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
  <h4>Jurnal Umum</h4>
  <hr>

  <b-form-group label="Status">
      <b-form-select v-model="select_radio" @change="refreshtype(select_radio)" :options="value_radio" name="radio-inline"></b-form-select>
  </b-form-group>
  <label>Akun Debit / {{select_radio.text_debit}}</label>
  <b-form-select  id="id_coa" v-model="items_jurnal.id_coa">
      <option v-for="payment in options_debit" v-bind:value="{ id_coa: payment.id_coa, nama_coa: payment.nama_coa }">{{ payment.nama_coa }} - {{ payment.id_coa }} </option>
  </b-form-select>
  <label>Akun Kredit / {{select_radio.text_kredit}}</label>
  <b-form-select id="id_coa" v-model="items_jurnal.invid_coa" >
      <option v-for="payment in options_kredit" v-bind:value="{ id_coa: payment.id_coa, nama_coa: payment.nama_coa }">{{ payment.nama_coa }} - {{ payment.id_coa }} </option>
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
        options_debit:{},
        options_kredit:[],
        value_radio: [{
            text: 'Penambahan Modal',
            value: {
                    text_debit  :'Sumber dana',
                    debit       :'kb',
                    text_kredit :'Modal',
                    kredit      :'modal',
                    }
          },
          {
            text: 'Pengalihan Asset',
            value: {
                    text_debit  :'Jenis Aktiva Tetap',
                    debit       :'akt_tetap',
                    text_kredit :'Sumber Dana',
                    kredit      :'kb',
                    }
          },
          
        ],
        select_radio: {
            text: 'Pengalihan Asset',
            value: {
                    text_debit  :'Jenis Aktiva Tetap',
                    debit       :'akt_tetap',
                    text_kredit :'Sumber Dana',
                    kredit      :'kb',
                    }
          },
      }
    },
    methods: {
      refreshtype(kondisi) {
        var _this = this;
        $.getJSON("<?php echo base_url('akuntansi/list_coa/') ?>"+kondisi.debit, function (json) {
          _this.options_debit = json;
        });
        $.getJSON("<?php echo base_url('akuntansi/list_coa/') ?>"+kondisi.kredit, function (json) {
          _this.options_kredit = json;
        });
      },
      
      tambahjurnal(){
        var _this = this;
        var record=[]
        var inversrecord=[]

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

        _this.items_jurnal.coa = _this.items_jurnal.id_coa.nama_coa +" / "+_this.items_jurnal.invid_coa.nama_coa
        _this.items_jurnal.record=record
        _this.items_jurnal.inversrecord=inversrecord
        data_jurnal.push(JSON.parse(JSON.stringify(_this.items_jurnal)))
      }
    },
    created: function () {
      var _this = this;
      _this.refreshtype(_this.select_radio)
    }
  }) 
</script>

<script type="text/x-template" id="table_transaksi">
  <b-card>
  <h4>Jurnal</h4>
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

  <b-pagination v-model="currentPage" :total-rows="rows" :per-page="perPage" class="my-0" aria-controls="my-table">
  </b-pagination>
  <br>
  <button class="btn btn-primary" @click="simpan_jurnal">
    <i class="fa fa-save"></i> save</button>
  <button class="btn btn-success" onclick="refresh_table('mytable')">
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
        $.post("<?php echo base_url('jurnalumum/index_post/simpan') ?>",data,function (par) {
          alert(par);
          //data_jurnal=[]
          uniqid_voucher=null
        })
      }
    },
    created: function () {
      
    }
  }) 
</script>

<script type="text/x-template" id="laporan_jurnalumum">

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
</script>

<script>
Vue.component('laporan_jurnalumum', {
  template: '#laporan_jurnalumum',
  data: function () {
    return {
      lapumum: [{
          link: "<?php echo base_url('laporan_jurnal_buku_besar')?>",
          judul: "Laporan Jurnal & Buku Besar",
          warna: "primary",
          icon: "fas fa-file-signature"
        }
      ],
    }
  },
  methods: {
    goBack() {
      window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/')
    }
  },
  created: function () {}
})
</script>

<!-- eksekusi vue -->
<script type="text/javascript">
var data_jurnal=[]
var uniqid_voucher=null
var aplikasi=new Vue({
el: '#app',
// define data - initial display text
data: {
nama:"Admin",
},
methods: {}
})
</script>