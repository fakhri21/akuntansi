<style>a:hover{text-decoration: none;}</style>
<script type="text/x-template" id="stock">
<div>
  <b-container>
  <b-row>
  
  <b-col md="12" sm="12">
  
  <b-row class="pt-5 pb-5">
  
  <b-col md="8" offset-md="2" sm="12" class="mb-2">
    <b-button variant="primary" @click="goBack()" class="mb-2"><i class="fas fa-angle-left"></i> Kembali</b-button>

    <b-card>

        <h3>Laporan Stock</h3><hr>

        <b-form>
          <b-form-group>
            <b-input placeholder="Pilih tanggal awal"></b-input>
          </b-form-group>
          
          <b-form-group>
            <b-input placeholder="Pilih tanggal Akhir" id="hari"></b-input>
          </b-form-group>

          <b-form-group label="Status">
            <b-form-radio v-model="selected" name="some-radios" value="A">Subleger Stock</b-form-radio>
            <b-form-radio v-model="selected" name="some-radios" value="B">Stock Opname B</b-form-radio>
          </b-form-group>

          <b-form-group label="COA Stock">
            <b-form-select v-model="selected" :options="options"></b-form-select>
          </b-form-group>

          <b-button variant="primary">Tampilkan Laporan</b-button>

        </b-form>

    </b-card>
  </b-col>  
  
  </b-row>
  
  </b-col>
  
  </b-row>
  </b-container>
</div>
</script>
<script>
Vue.component('stock', {
template:'#stock',
data: function () {
return {
selected: '',
select_radio: 'first',
value_radio: [
{ text: 'In', value: '1' },
{ text: 'Out', value: '2' },
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




<script type="text/x-template" id="masuk_stock">
<div>
  <b-container>
  <b-row>
  
  <b-col md="12" sm="12">
  
  <b-row class="pt-5 pb-5">

    <b-col md="12" sm="12">
        <b-button variant="primary" @click="goBack()" class="mb-2"><i class="fas fa-angle-left"></i> Kembali</b-button>
    </b-col>

    <b-col md="4" sm="12" class="mb-2">
    

    <b-card class="mb-3">
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

    <b-card>

      <b-row>
      <b-col md="8" sm="8"><h3 class="pull-left">Stock</h3></b-col>
      <b-col md="4" sm="4" class="text-right"><b-button variant="primary" size="sm" v-b-toggle.collapse-1><i class="fas fa-plus" style="font-size:15px;"></i></b-button></b-col>
      </b-row>

        <b-collapse id="collapse-1">
        <hr>
        <b-form>
          <b-form-group label="Item Stock">
            <b-form-select v-model="selected" :options="options"></b-form-select>
          </b-form-group>

          <b-form-group label="Quantity">
            <b-input type="number" placeholder="Quantity"></b-input>
          </b-form-group>

          <b-form-group label="Satuan">
            <b-form-select v-model="selected" :options="options"></b-form-select>
          </b-form-group>

          <b-form-group label="Harga">
            <b-input type="number" placeholder="Masukkan Harga"></b-input>
          </b-form-group>

          <b-form-group label="Diskon">
            <b-input type="number" placeholder="Masukkan Diskon"></b-input>
          </b-form-group>

          <b-form-group label="Pajak">
            <b-input type="number" placeholder="Masukkan Pajak"></b-input>
          </b-form-group>

          <b-form-group label="Vendor">
            <b-form-select v-model="selected" :options="options"></b-form-select>
          </b-form-group>

          <b-form-group label="Payment">
            <b-form-select v-model="selected" :options="options"></b-form-select>
          </b-form-group>

          <b-form-group label="Keterangan">
            <b-form-textarea></b-form-textarea>
          </b-form-group>

          <b-button variant="success"><i class="fas fa-plus"></i> Tambah</b-button>
          <b-button variant="danger"><i class="fas fa-times"></i> Batal</b-button>

        </b-form>
        </b-collapse>

    </b-card>
  </b-col>

  <b-col md="8" sm="8"><b-card>
      
    <h4>Data Stock</h4><hr>
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
  </b-card></b-col>  
  
  </b-row>
  
  </b-col>
  
  </b-row>
  </b-container>
</div>
</script>
<script>
Vue.component('masuk_stock', {
template:'#masuk_stock',
data: function () {
return {
selected: '',
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



<script type="text/x-template" id="stock_opname">
<div>
  <b-container>
  <b-row>
  
  <b-col md="12" sm="12">
  
  <b-row class="pt-5 pb-5">

    <b-col md="12" sm="12">
        <b-button variant="primary" @click="goBack()" class="mb-2"><i class="fas fa-angle-left"></i> Kembali</b-button>
    </b-col>

    <b-col md="4" sm="12" class="mb-2">
  

    <b-card>

      <b-row>
      <b-col md="8" sm="8"><h4 class="pull-left">Stock Opname</h4></b-col>
      <b-col md="4" sm="4" class="text-right"><b-button variant="primary" size="sm" v-b-toggle.collapse-1><i class="fas fa-plus" style="font-size:15px;"></i></b-button></b-col>
      </b-row>

        <b-collapse id="collapse-1">
        <hr>
        <b-form>
          <b-form-group label="Item Stock">
            <b-form-select v-model="selected" :options="options"></b-form-select>
            <b-button variant="primary" size="sm" class="m2">Check</b-button>
          </b-form-group>

          <b-form-group label="Saldo Quantity Akhir">
            <b-input type="number" placeholder="Quantity"></b-input>
          </b-form-group>

          <b-form-group label="Current Quantity">
            <span>00000</span>
          </b-form-group>

          <b-form-group label="Current Value">
            <span>00000</span>
          </b-form-group>

          <b-form-group label="Current Price">
            <span>00000</span>
          </b-form-group>

          <b-form-group label="HPP">
            <b-form-select v-model="selected" :options="options"></b-form-select>
          </b-form-group>

          <b-form-group label="Keterangan">
            <b-form-textarea></b-form-textarea>
          </b-form-group>

          <b-button variant="success"><i class="fas fa-plus"></i> Tambah</b-button>
          <b-button variant="danger"><i class="fas fa-times"></i> Batal</b-button>

        </b-form>
        </b-collapse>

    </b-card>
  </b-col>

  <b-col md="8" sm="8"><b-card>
      <h4>Data Stock</h4><hr>
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
  </b-card></b-col>  
  
  </b-row>
  
  </b-col>
  
  </b-row>
  </b-container>
</div>
</script>
<script>
Vue.component('stock_opname', {
template:'#stock_opname',
data: function () {
return {
selected: '',
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
methods: {

  goBack(){
    window.history.back();
  }

}
})
</script>