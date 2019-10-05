<div id="app">
    <stock_opname></stock_opname>
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