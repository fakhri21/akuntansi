<script type="text/x-template" id="hutang">
<div>
  <b-container>
  <b-row>
  
  <b-col md="12" sm="12">
  
  <b-row class="pt-5 pb-5">
  
  <b-col md="8" offset-md="2" sm="12" class="mb-2">
  <b-button variant="primary" @click="goBack()" class="mb-2"><i class="fas fa-angle-left"></i> Kembali</b-button>
  <h3 class="text-center mb-3">Piutang</h3>
  <b-card no-body>
  <b-tabs pills card>
  <b-tab title="Hutang" active>
  <b-form-group label="COA Hutang">
  <b-form-select v-model="selected" :options="options"></b-form-select>
  </b-form-group>
  <b-form-group label="COA Pembayaran">
  <b-form-select v-model="selected" :options="options"></b-form-select>
  </b-form-group>
  <b-button variant="success" class="mb-2"><i class="fas fa-check"></i> Proses</b-button>
  <b-button variant="danger" class="mb-2"><i class="fas fa-times"></i> Batalkan</b-button>
  
  </b-tab>
  <b-tab title="Bayar Hutang">

    <h4 class="text-center">List Hutang / Piutang</h4>
    <hr>
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

          <b-button variant="success" size="sm" class="mb-2"><i class="fas fa-check"></i>Proses</b-button>
          <b-button variant="danger" size="sm" class="mb-2"><i class="fas fa-times"></i> Batalkan</b-button>

      </b-col>

  </b-row>
  

  </b-tab>
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
template:'#hutang',
data: function () {
return {
selected: '',
select_radio: 'first',
value_radio: [
{ text: 'In', value: '1' },
{ text: 'Out', value: '2' },
],
currentPage: 1,
perPage: 5,
pageOptions: [5, 10, 15],
keyword: "",
filter:null,
rows:0,
items: [
{ list_hutang: "Lorem Ipsum", hutang:"2500000"},
{ list_hutang: "Lorem Ipsum", hutang:"2500000"},
],
fields: [
{ key: "list_hutang", label: "List Hutang", sortable: true },
{ key: "hutang", label: "Hutang", sortable: true },
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
methods: {
goBack(){
window.history.back();
}
}
})
</script>