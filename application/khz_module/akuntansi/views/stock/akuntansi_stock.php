<div class="col-md-4 col-sm-4 col-xs-12">

<!-- Modal Current Voucher -->
    <div id="modal-current-voucher" class="modal fade" role="dialog">

    </div>
<div class="">
                <select id="search_voucher" oninput= placeholder="kode voucher" ></select>
                <button class="btn btn-success" data-toggle="modal" data-target="#modal-current-voucher" onclick="current_voucher()"><i class="fa fa-post"></i> Buka Ulang</button>
                
</div>
<div>
              <h4><label>Id Voucher :</label>
              <span id="id_current_voucher">ST19030013</span></h4>
              
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12"></div>

<div class="col-md-4 col-sm-6 col-xs-12">
    <div class="box box-primary">

        <div class="box-header with-border">
            <h3>Stock</h3>
        </div>

        <div class="box-body">

            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Item Stock</label>
                        <select id="id_coa_stock" oninput= placeholder="Stock"> </select>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" id="quantity" oninput= placeholder="" class="form-control">
                    </div>
                </div>
                
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Satuan</label>
                        <select id="satuan" ></select>
                    </div>
                </div>
                
            </div><!-- row -->
        </div><!-- box-body -->

    </div><!-- box -->
</div><!-- col -->



<div class="col-md-8 col-sm-6 col-xs-12">
    <div class="box box-primary">
        
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Harga</label>
                        <input id="nilai" oninput= placeholder="Rp" class="form-control">
                    </div>
                </div>
                
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Diskon</label>
                        <input type="number" id="diskon" oninput= placeholder="%" class="form-control">
                    </div>
                </div>
                
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Pajak</label>
                        <input type="number" id="pajak" oninput= placeholder="Rp" class="form-control">
                    </div>
                </div>
                
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Vendor</label>
                        <select id="vendor"></select>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Payment Type</label>
                        <select id="id_coa" oninput= placeholder="Payment"> </select>
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
                            <td>Satuan</td>
                            <td style="width: 50px;">Price @</td>
                            <td style="width: 50px;">Discount</td>
                            <td style="width: 50px;">Tax</td>
                            <td style="width: 50px;">Net</td>
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
    {"data": "options.stock.satuan",width:100},
    {"data": "price",width:100},
    {"data": "options.diskon",width:100},
    {"data": "options.pajak",width:100},
    {"data": "options.stock.total_nilai_stock",width:100},
    {"data": "rowid",width:100}
    
    ],
    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        var aksi="<button onclick=hapusitemcart('"+data.rowid+"')>Hapus</button>"
                        $('td:eq(0)', row).html(index); //Index
                        $('td:eq(8)', row).html(aksi); //Aksi

                    }
    
    });
    
    });

var cleaveNumeral = new Cleave('#nilai', {
    numeral: true,
    numeralThousandsGroupStyle: 'thousand'
});

</script>

<script>
var base_url="<?php echo base_url(); ?>";

$.getJSON("akuntansi/list_coa/kb",function (data) {
    $("#id_coa").selectize({
					valueField: 'id_coa',
					labelField: 'nama_coa',
					searchField: 'nama_coa',
					options: data,
					create: false
                });
})
    
$.getJSON("akuntansi/list_coa/stock",function (data) {    
    $("#id_coa_stock").selectize({
					valueField: 'id_coa',
					labelField: 'nama_coa',
					searchField: 'nama_coa',
					options: data,
					create: false
				});    

})


$.getJSON(""+base_url+"m_satuan/json",function (data) {
    $("#satuan").selectize({
					valueField: 'id_satuan',
					labelField: 'nama_satuan',
					searchField: 'nama_satuan',
					options: data.data,
					create: false
				});
    
})

$.getJSON(""+base_url+"m_vendor/json",function (data) {
    $("#vendor").selectize({
					valueField: 'id_vendor',
					labelField: 'nama_vendor',
					searchField: 'nama_vendor',
					options: data.data,
					create: false
				});
    
})

$.getJSON("akuntansi/list_voucher/ST",function (data) {
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
var uniqid=null;
var id_voucher_terpilih=null;

function current_voucher() { //voucher
        var id=$("#search_voucher").val()
        id_voucher_terpilih=$("#search_voucher").text()
        $("#id_current_voucher").text(id_voucher_terpilih)

        uniqid=id
        $("#modal-current-voucher").load('<?php echo base_url('akuntansi/tampilcurrentvoucher/'); ?>'+id+'')
      }

    
function tambah_item() {
        /* var type=$("#type").val() */
        var data={'id_coa':$('#id_coa').val(),
				'nilai':numeral($('#nilai').val()).value(),
				'id_coa_stock':$('#id_coa_stock').val(),
				'quantity':$('#quantity').val(),
				'satuan':$('#satuan').val(),
				'diskon':$('#diskon').val(),
                'pajak':$('#pajak').val(),
                'vendor':$('#vendor').val(),
				'keterangan':$('#keterangan').val()}

	$.post('akuntansi/tambahitem/',data,function (response) {
        alertify.success("Berahasil Menambahkan");
        refresh_table("mytable");
	})
}

function refresh_table(id) {
        $('#'+id+'').DataTable().ajax.reload()
}

function hapusitemcart(rowid) {
        var data={tes:'0'};
        $.post("akuntansi/hapusitemcart/"+rowid+"",data,function (pesan) {
          alertify.success(pesan)
          refresh_table("mytable")
        })
}

function simpan_voucher() {
        var data={tes:'0'}
        $.post('akuntansi/simpan_stock',data,function(params) {
        alertify.success("Berhasil melakukan pembayaran")
        location.href=params
        })
}

function posting_jurnal() {
        var data={tes:'0'}
        if(uniqid!=null){    
            data={'uniqid':uniqid}
        }
        
        $.post('akuntansi/ubahstatus/'+uniqid+'/1',data,function(params) {
        alertify.success("Berhasil Memposting")
        window.location.reload()
        })
}

</script>