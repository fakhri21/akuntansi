<div id="app">
    <jurnalumum></jurnalumum>
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
    {"data": "price",width:100},
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

   var cleaveNumeral = new Cleave('#nilai', {
    numeral: true,
    numeralThousandsGroupStyle: 'thousand'
    });

$.getJSON("akuntansi/list_voucher/JU",function (data) {
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
var d_coa=[];
$.getJSON("akuntansi/list_coa/1",function (data) {
    data
    $("#id_coa").selectize({
					valueField: 'id_coa',
					labelField: 'nama_coa',
					searchField: 'nama_coa',
					options: data,
					create: false
				});
    
    $("#invid_coa").selectize({
					valueField: 'id_coa',
					labelField: 'nama_coa',
					searchField: 'nama_coa',
					options: data,
					create: false
				});    

})

</script>

<script>
    var uniqid=null;
    var id_voucher_terpilih=null;


function current_voucher() { //voucher
        var id = $("#search_voucher").val()
        if(id){
            console.log($("#search_voucher"))
            id_voucher_terpilih= $("#search_voucher").text()
            $("#id_current_voucher").text(id_voucher_terpilih)  
            uniqid=id
            console.log('<?php echo base_url('verifikasi_jurnal/tampilcurrentvoucher/'); ?>'+id);
            $("#current_voucher").load('<?php echo base_url('verifikasi_jurnal/tampilcurrentvoucher/'); ?>'+id)
            $("#modal-current-voucher").modal('show');
        }else{
            $(".search-voucher-error").show();
        }
      }


function tambah_jurnalumum() {
	var data={
        'id_coa':$('#id_coa').val(),
        'nama_coa':$('#id_coa').text(),
				'nilai':numeral($('#nilai').val()).value(),
				'invid_coa':$('#invid_coa').val(),
				'invnama_coa':$('#invid_coa').text(),
				'keterangan':$('#keterangan').val()}

	$.post('jurnalumum/tambahjurnalumum/',data,function (response) {
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
        if(uniqid!=null){    
            data={'uniqid':uniqid}
        }
        $.post('jurnalumum/simpan_jurnalumum',data,function(params) {
        alertify.success("Berhasil Menyimpan")
        //alertify.success(params)
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