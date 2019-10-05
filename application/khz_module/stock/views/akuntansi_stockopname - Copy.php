<div id="app">
    <stock_opname></stock_opname>
</div>

<div class="col-md-4 col-sm-6 col-xs-12">
    <div class="box box-primary">

        <div class="box-header with-border">
            <h3>Stock Opname</h3>
        </div>

        <div class="box-body">

            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Item Stock</label>
                        <select id="id_coa_stock" oninput= placeholder="Stock" ></select> <button type="button" onclick="cek_coa()" class="btn btn-2 info">Check</button>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Saldo Quantity Akhir</label>
                        <input type="number" id="quantity" oninput= placeholder="" class="form-control">
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Current Quantity</label>
                        <span id="current_quantity">0000</span>
                    </div>
                </div>
                
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Current Value</label>
                        <span id="current_value">0000</span>
                    </div>
                </div>
                
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Current Price</label>
                        <span id="current_price">0000</span>
                    </div>
                </div>
                
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>HPP</label>
                        <select id="id_coa_hpp" oninput= placeholder="" ></select>
                    </div>
                </div>
                
                
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea id="keterangan" placeholder="Keterangan" class="form-control"></textarea>
                    </div>
                </div>
<!-- 
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Status</label><br>
                        <label class="radio-inline"><input id="type" type="radio" name="status" value="0">In</label>
                        <label class="radio-inline"><input id="type" type="radio" name="status" value="1">Out</label>
                    </div>
                </div>
 -->
                <div class="col-md-12">
                    <button class="btn btn-success" onclick="tambah_item()"><i class="fa fa-check"></i> Ok</button>
                    <button class="btn btn-danger" onclick="location.reload()"><i class="fa fa-remove"></i> Cancel</button>
                </div>

            </div><!-- row -->
        </div><!-- box-body -->

    </div><!-- box -->
</div><!-- col -->



<div class="col-md-8 col-sm-6 col-xs-12">
    <div class="box box-primary">

        <div class="box-heading">
            <h3></h3>

        </div>

        <div class="box-body">
                <!--Table  -->
                <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                          <tr>
                            <th>No</th>
                            <td>Keterangan</td>
                            <td>Qty</td>
                            <td style="width: 70px;">Aksi</td>
                          </tr>
                        </thead>
                              
                </table>

                <button class="btn btn-primary" onclick="simpan_voucher()"><i class="fa fa-save"></i> save</button>
                <button class="btn btn-success" onclick="refresh_table('mytable')"><i class="fa fa-refresh"></i> Refresh</button>

            </div>

        </div>
    </div>
                        
<script>
    $(document).ready(function() {
      $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };
                
    //datatables
    table = $('#mytable').DataTable({
    "order": [], //Initial no order.
    // Load data for the table's content from an Ajax source
    "ajax": {
    "url": '<?php echo base_url('akuntansi/cart'); ?>',
    "type": "POST"
    },
    //Set column definition initialisation properties.
    "columns": [
    {"data": "rowid",width:170},
    {"data": "name",width:100},
    {"data": "qty",width:100},
    {"data": "rowid",width:100}
    
    ],
    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        var aksi="<button onclick=hapusitemcart('"+data.rowid+"')>Hapus</button>"
                        $('td:eq(0)', row).html(index); //Index
                        $('td:eq(3)', row).html(aksi); //Aksi

                    }
    
    });
    
    });
</script>

<script>
var base_url="<?php echo base_url(); ?>";

$.getJSON(base_url+"akuntansi/list_coa/0",function (data) {
    $("#id_coa_hpp").selectize({
					valueField: 'id_coa',
					labelField: 'nama_coa',
					searchField: 'nama_coa',
					options: data,
					create: false
				});
  
})

$.getJSON(base_url+"akuntansi/list_coa/stock",function (data) {    
    $("#id_coa_stock").selectize({
					valueField: 'id_coa',
					labelField: 'nama_coa',
					searchField: 'nama_coa',
					options: data,
					create: false
				});    

})

$.getJSON(base_url+"akuntansi/list_voucher/ST",function (data) {
    data
    $("#search_voucher").selectize({
					valueField: 'uniqid',
					labelField: 'id_voucherjurnal',
					searchField: 'id_voucherjurnal',
					options: data,
					create: false
				});
})

</script>

<script>
/* content */

function cek_coa() {
    var data={	'id_coa_stock':$('#id_coa_stock').val(),
			}

	$.post(base_url+'stock/cek_stock/',data,function (hasil) {
        $("#current_quantity").text(hasil.quantity_akhir)
        $("#current_value").text(hasil.nilai_akhir)
        $("#current_price").text(hasil.current_price)
	})
}

/* Aksi */    
function tambah_item() {
        /* var type=$("#type").val() */
        var data={'id_coa_hpp':$('#id_coa_hpp').val(),
				'nilai':$('#nilai').val(),
				'id_coa_stock':$('#id_coa_stock').val(),
				'quantity':$('#quantity').val(),
				'keterangan':$('#keterangan').val(),
                'current_quantity':$('#current_quantity').text(),
                'current_value':$('#current_value').text(),
                'current_price':$('#current_price').text()
                }

	$.post(base_url+'stock/tambahitemopname/',data,function (response) {
        alert("Berahasil Menambahkan");
        refresh_table("mytable");
	})
}

function refresh_table(id) {
        $('#'+id+'').DataTable().ajax.reload()
}

function hapusitemcart(rowid) {
        var data={tes:'0'};
        $.post(base_url+"akuntansi/hapusitemcart/"+rowid+"",data,function (pesan) {
          alert(pesan)
          refresh_table("mytable")
        })
}

function simpan_voucher() {
        var data={tes:'0'}
        $.post(base_url+'stock/simpan_stockopname',data,function(params) {
        alert("Berhasil melakukan pembayaran")
        })
}


</script>