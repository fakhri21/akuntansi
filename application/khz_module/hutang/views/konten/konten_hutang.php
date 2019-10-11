<script type="text/x-template" id="hutang">
<div>
  <b-container>
    <b-row>

      <b-col md="12" sm="12">

        <b-row class="pt-5 pb-5">

          <b-col md="8" offset-md="2" sm="12" class="mb-2">
            <b-button variant="primary" @click="goBack()" class="mb-2">
              <i class="fas fa-angle-left"></i> Kembali</b-button>
            <h3 class="text-center mb-3">Hutang</h3>
            <b-card no-body>
              <b-tabs pills card>
                <inputan />
                <bayar_hutang />
              </b-tabs>
            </b-card>
          </b-col>

        </b-row>

      </b-col>

    </b-row>
  </b-container>
</div>
</script>
<script>
Vue.component('hutang', {
  template: '#hutang',
  data: function () {
    return {
      selected: '',
      select_radio: 'first',
      value_radio: [{
          text: 'In',
          value: '1'
        },
        {
          text: 'Out',
          value: '2'
        },
      ],
      currentPage: 1,
      perPage: 5,
      pageOptions: [5, 10, 15],
      keyword: "",
      filter: null,
      rows: 0,
      items: [{
          list_hutang: "Lorem Ipsum",
          hutang: "2500000"
        },
        {
          list_hutang: "Lorem Ipsum",
          hutang: "2500000"
        },
      ],
      fields: [{
          key: "list_hutang",
          label: "List Hutang",
          sortable: true
        },
        {
          key: "hutang",
          label: "Hutang",
          sortable: true
        },
      ]
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

<script type="text/x-template" id="inputan">
<b-tab title="Hutang" active>
  <b-form-group label="Jenis Hutang">
    <b-form-select  id="id_coa" v-model="items_jurnal.id_coa">
        <option v-for="payment in options_debit" v-bind:value="{ id_coa: payment.id_coa, nama_coa: payment.nama_coa }">{{ payment.nama_coa }} - {{ payment.id_coa }} </option>
    </b-form-select>
  </b-form-group>
  <b-form-group label="Penyimpanan">
    <b-form-select id="id_coa" v-model="items_jurnal.invid_coa" >
        <option v-for="payment in options_kredit" v-bind:value="{ id_coa: payment.id_coa, nama_coa: payment.nama_coa }">{{ payment.nama_coa }} - {{ payment.id_coa }} </option>
    </b-form-select>
  </b-form-group>
  <label>Jumlah</label>
  <b-form-input v-model="items_jurnal.nilai"></b-form-input>
  <b-form-group label="Supplier">
    <b-form-select id="supplier" v-model="items_jurnal.supplier" >
        <option v-for="payment in options_people" v-bind:value="101010103">{{ payment.nama_ }} - {{ payment.id_coa }} </option>
    </b-form-select>
  </b-form-group>
  <b-form-group label="Tanggal Jatuh Tempo">
    <b-form-input v-model="items_jurnal.tgl_jatuh_tempo"></b-form-input>
  </b-form-group>
  <label>Keterangan</label>
  <b-form-input v-model="items_jurnal.keterangan"></b-form-input>
  <b-button variant="success" @click="tambahjurnal" class="mb-2">
    <i class="fas fa-check"></i> Proses</b-button>
  <b-button variant="danger" class="mb-2">
    <i class="fas fa-times"></i> Batalkan</b-button>
</b-tab>
</script>

<script>
Vue.component('inputan', {
  template: '#inputan',
  data: function () {
    return {
      selected: '',
      items_jurnal:{  
          id_coa:"",
          invid_coa:"",
          coa:"",
          nilai:"",
          supplier:"",
          tgl_jatuh_tempo:"",
          keterangan:""
        },
        options_debit:{},
        options_kredit:[],
      
    }
  },
  methods: {
    refreshtype() {
        var _this = this;
        $.getJSON("<?php echo base_url('akuntansi/list_coa/hutang') ?>", function (json) {
          _this.options_debit = json;
        });
        $.getJSON("<?php echo base_url('akuntansi/list_coa/kb') ?>", function (json) {
          _this.options_kredit = json;
        });
      },
      
      tambahjurnal(){
        var _this = this;
        var uniqid=null
        var data_=[]
        var record=[]
        var inversrecord=[]

        record={
          'id_coa'    :_this.items_jurnal.id_coa.id_coa,
          'kredit'     :_this.items_jurnal.nilai,
          'keterangan':_this.items_jurnal.keterangan,
        };
        inversrecord={
          'id_coa'     :_this.items_jurnal.invid_coa.id_coa,
          'debit'     :_this.items_jurnal.nilai,
          'keterangan' :_this.items_jurnal.keterangan,
        };
        hutang={
          'kredit'     :_this.items_jurnal.nilai,
          'id_people' :_this.items_jurnal.supplier,
          'tgl_jatuh_tempo' :_this.items_jurnal.tanggal_jatuh_tempo,
          'keterangan' :_this.items_jurnal.keterangan,
        }

        _this.items_jurnal.hutang = hutang
        _this.items_jurnal.record=record
        _this.items_jurnal.inversrecord=inversrecord

        data_jurnal.push(JSON.parse(JSON.stringify(_this.items_jurnal)))
        _this.simpan_jurnal(data_jurnal)
      },
      simpan_jurnal(data_){
        var data={
          uniqid:null,
          data:data_
        }
        $.post("<?php echo base_url('hutang/index_post/simpan') ?>",data,function (par) {
          alert(par);
        })

      }
  },
  created: function () {
    var _this = this;
    _this.refreshtype()
  }
})
</script>

<script type="text/x-template" id="bayar_hutang">
<b-tab title="Bayar Hutang">

  <h4 class="text-center">List Hutang</h4>
  <hr>
  <b-table class="table table-striped table-inverse table-responsive" id="my-table" show-empty :items="items" :filter='keyword'
    :fields="fields" :current-page="currentPage" :per-page="perPage" @filtered="onFiltered">

  </b-table>
  <b-pagination v-model="currentPage" :total-rows="rows" :per-page="perPage" class="my-0" aria-controls="my-table">
  </b-pagination>

  <hr>

  <b-row>
    <b-col md="8" sm="12">
      <b-button disabled size="sm" class="mb-2">ID Hutang/Piutang</b-button>
      <b-button disabled size="sm" class="mb-2">COA Hutang/Piutang</b-button>

      <b-form-group label="Nilai">
        <b-input placeholder="Masukkan Harga"></b-input>
      </b-form-group>

      <b-form-group label="Keterangan">
        <b-form-textarea></b-form-textarea>
      </b-form-group>

      <b-form-group label="Pembayaran">
        <b-form-select></b-form-select>
      </b-form-group>

      

      <b-button variant="success" size="sm" class="mb-2">
        <i class="fas fa-check"></i>Proses</b-button>
      <b-button variant="danger" size="sm" class="mb-2">
        <i class="fas fa-times"></i> Batalkan</b-button>

    </b-col>

  </b-row>

</b-tab>
</script>

<script>
Vue.component('bayar_hutang', {
  template: '#bayar_hutang',
  data: function () {
    return {
      selected: '',
      select_radio: 'first',
      value_radio: [{
          text: 'In',
          value: '1'
        },
        {
          text: 'Out',
          value: '2'
        },
      ],
      currentPage: 1,
      perPage: 5,
      pageOptions: [5, 10, 15],
      keyword: "",
      filter: null,
      rows: 0,
      items: [{
          list_hutang: "Lorem Ipsum",
          hutang: "2500000"
        },
        {
          list_hutang: "Lorem Ipsum",
          hutang: "2500000"
        },
      ],
      fields: [
                {key: "no",label: "No",sortable: true},
                {key: "tanggal",label: "tanggal",sortable: true},
                {key: "tgl_jatuh_tempo",label: "Jatuh Tempo",sortable: true},
                {key: "nama",label: "Nama",sortable: true},
                {key: "nilai",label: "Nilai",sortable: true},
              
              ] 
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

<!-- eksekusi vue -->
<script type="text/javascript">
var data_jurnal=[]

var aplikasi=new Vue({
el: '#app',
// define data - initial display text
data: {
nama:"Admin",
},
methods: {
goBack(){
window.history.back();
}
}
})
</script>