<style>a:hover{text-decoration: none;}</style>
<script type="text/x-template" id="jurnalumum">
<div>
  <b-container>
  <b-row>
  
  <b-col md="12" sm="12">

    <b-button variant="primary" @click="goBack()" class="mt-2"><i class="fas fa-angle-left"></i> Kembali</b-button>
  
  <b-row class="pt-2 pb-5">
  
  <b-col md="4" sm="4" class="mb-2">
    <b-card>
    <div class="">
        <b-form-select id="search_voucher" placeholder="Payment" ></b-form-select>
        <div class="search-voucher-error" style="color:red;display:none;">Silahkan pilih kode voucher terlebih dahulu</div>
        <button id="bukaUlang" class="btn btn-success" onclick="current_voucher()"><i class="fa fa-arrow-right"></i> Buka Ulang</button>
    </div>

    <div>
        <h4><label>Id Voucher :</label>
            <span id="id_current_voucher">KB19030013</span></h4>
        </div>
      </b-card>
  </b-col>

  <b-col md="8" sm="8" class="mb-2">
  </b-col>

  <b-col md="4" sm="4">
  <b-card>
  <h4>Jurnal Umum</h4><hr>

  <label>Akun Debit</label>
  <b-form-select id="id_coa" v-model="selected" :options="options"></b-form-select>
  <label>Akun Kredit</label>
  <b-form-select id="id_coa" v-model="selected" :options="options"></b-form-select>
  <label>Jumlah</label>
  <b-form-input></b-form-input>
  <label>Keterangan</label>
  <b-form-input></b-form-input>
  <b-form-group label="Status">
  <b-form-radio-group
  v-model="select_radio"
  :options="value_radio"
  name="radio-inline"
  ></b-form-radio-group>
  </b-form-group>
  <b-button variant="primary">OK</b-button>
  <b-button variant="danger">Batal</b-button>
  </b-card>
  </b-col>
  <b-col md="8" sm="8">
  <b-card>
    <h4>Data Kas & Bank</h4><hr>
      <b-table
        class="table table-striped table-inverse table-responsive"
        id="my-table"
        show-empty
        :items="items"
        :filter='keyword'
        :fields="fields"
        :current-page="currentPage"
        :per-page="perPage"
        @filtered="onFiltered"
        
        >
        
      </b-table>

    <b-pagination
        v-model="currentPage"
        :total-rows="rows"
        :per-page="perPage"
        class="my-0"
        aria-controls="my-table"
        >
    </b-pagination>
  <br>
  <button class="btn btn-primary" onclick="simpan_voucher()"><i class="fa fa-save"></i> save</button>
            <button class="btn btn-success" onclick="refresh_table('mytable')"><i class="fa fa-refresh"></i> Refresh</button>
  </b-card>
  </b-col>
  
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
options: [
{ value: null, text: 'Please select an option' },
{ value: 'a', text: 'This is First option' },
{ value: 'b', text: 'Selected Option' },
{ value: { C: '3PO' }, text: 'This is an option with object value' },
{ value: 'd', text: 'This one is disabled', disabled: true }
],
select_radio: 'first',
value_radio: [
{ text: 'In', value: '1' },
{ text: 'Out', value: '2' },
],


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
<!-- eksekusi vue -->
<script type="text/javascript">
var aplikasi=new Vue({
el: '#app',
// define data - initial display text
data: {
nama:"Admin",
},
methods: {}
})
</script>