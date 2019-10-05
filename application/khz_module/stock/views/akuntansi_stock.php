<div id="app">
    <masuk_stock></masuk_stock>
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
    {"data": "options.keterangan",width:100},
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

$.getJSON(base_url+"akuntansi/list_coa/kb",function (data) {
    $("#id_coa").selectize({
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
var uniqid=null;
var id_voucher_terpilih=null;

function current_voucher() { //voucher
        var id=$("#search_voucher").val()
        id_voucher_terpilih=$("#search_voucher").text()
        $("#id_current_voucher").text(id_voucher_terpilih)

        uniqid=id
        $("#current_voucher").load('<?php echo base_url('verifikasi_jurnal/tampilcurrentvoucher/'); ?>'+id+'')
      }

    
function tambah_item() {
        /* var type=$("#type").val() */
        var data={
            'id_coa':$('#id_coa').val(),
            'nama_coa':$('#id_coa').text(),
				'nilai':numeral($('#nilai').val()).value(),
				'id_coa_stock':$('#id_coa_stock').val(),
				'nama_coa_stock':$('#id_coa_stock').text(),
				'quantity':$('#quantity').val(),
				'satuan':$('#satuan').val(),
				'diskon':$('#diskon').val(),
                'pajak':$('#pajak').val(),
                'vendor':$('#vendor').val(),
				'keterangan':$('#keterangan').val()}

	$.post(base_url+'stock/tambahitem/',data,function (response) {
        alertify.success("Berahasil Menambahkan");
        refresh_table("mytable");
	})
}

function refresh_table(id) {
        $('#'+id+'').DataTable().ajax.reload()
}

function hapusitemcart(rowid) {
        var data={tes:'0'};
        $.post(base_url+"akuntansi/hapusitemcart/"+rowid+"",data,function (pesan) {
          alertify.success(pesan)
          refresh_table("mytable")
        })
}

function simpan_voucher() {
        var data={tes:'0'}
        $.post(base_url+'stock/simpan_stock',data,function(params) {
        alertify.success("Berhasil melakukan pembayaran")
        location.href=params
        })
}

function posting_jurnal() {
        var data={tes:'0'}
        if(uniqid!=null){    
            data={'uniqid':uniqid}
        }
        
        $.post(base_url+'akuntansi/ubahstatus/'+uniqid+'/1',data,function(params) {
        alertify.success("Berhasil Memposting")
        window.location.reload()
        })
}

</script>