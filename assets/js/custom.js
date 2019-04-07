$(document).ready(function() {
	var data_pemesanan = $('#tableUser').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": base_url+"admin/get_user_dataTable",
			"type": "POST"
		},
		"columnDefs": [
			{
				"targets": [0],
				"orderable": false,
			}
		],
	});

	var data_product = $('#tableProduct').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": base_url+"admin/get_product_dataTable",
			"type": "POST"
		},
		"columnDefs": [
			{
				"targets": [0],
				"orderable": false,
			}
		],
	});

	var data_pemesanan = $('#tablePemesanan').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": base_url+"admin/get_pemesanan_dataTable",
			"type": "POST"
		},
		"columnDefs": [
			{
				"targets": [0],
				"orderable": false,
			}
		],
	});

	var pemesanan_berhasil_user = $('#tablePemesananBerhasil').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": base_url+"user/get_pemesanan",
			"type": "POST",
			"data": {
				"action": "berhasil"
			}
		},
		"columnDefs": [
			{
				"targets": [0],
				"orderable": false,
			}
		],
	});

	var pemesanan_gagal_user = $('#tablePemesananGagal').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": base_url+"user/get_pemesanan",
			"type": "POST",
			"data": {
				"action": "gagal"
			}
		},
		"columnDefs": [
			{
				"targets": [0],
				"orderable": false,
			}
		],
	});

	var pemesanan_user = $('#tablePemesananUser').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": base_url+"user/get_pemesanan",
			"type": "POST",
		},
		"columnDefs": [
			{
				"targets": [0],
				"orderable": false,
			}
		],
	});

	var data_pemesanan_waiter = $('#tablePemesananWaiter').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": base_url+"waiters/get_pemesanan_dataTable",
			"type": "POST"
		},
		"columnDefs": [
			{
				"targets": [0],
				"orderable": false,
			}
		],
	});

	$('#uploadImgProduct').on('change', function() {
		var countFiles = $(this)[0].files.length;
		var imgFiles = $(this)[0].value;
		var ext = imgFiles.substring(imgFiles.lastIndexOf('.') + 1).toLowerCase();
		var show_image = $("#showImage");
		show_image.empty();
		if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg") {
			if (typeof(FileReader) != "undefined") {
				for (var i = 0; i < countFiles; i++) {
					var reader = new FileReader();
					reader.onload = function(e) {
						$("<img />", {
							"src": e.target.result,
							"class": "img-responsive",
							"width": "100",
							"height": "100"
						}).appendTo(show_image);
					}
					show_image.show();
					reader.readAsDataURL($(this)[0].files[i]);
				}
			} else {
				alert("Browser tidak support FileReader");
			}
		} else {
			alert("Pilih data gambar");
		}
	});
});

/* ------- KONFIRMASI BUTTON ------- */
var i = 0;
$(document).on('click', '.btnKonfir',function() {
	if (i == 0) {
	var statusForm = '<input type="hidden" id="id_pemesanan" value=""/>';
		statusForm +=    '<select class="form-control" name="status" id="statusKonfirmasi">';
		statusForm +=     '  	<option value="1">Aktif</option>';
		statusForm +=		'<option value="0">Tidak Aktif</option>';
		statusForm += 			'<option value="2">Cancel</option>';
		statusForm +=	'</select>';
	var statusBtn = '<button type="button" class="btn btn-primary btn-flat" id="btnKonfirmasi">Update</button>';
		$("#modal-content").html(statusForm);
		$("#modal-btn").html(statusBtn);
		var getStatus = $(this).data('id');
		$("#id_pemesanan").val(getStatus);
		i++;
	}
});

$(document).on('click', '#btnKonfirmasi', function() {
	var id = $("#id_pemesanan").val();
	var status = $("#statusKonfirmasi").val();
	if (status != null) {
		$.ajax({
			type: 'post',
			data: {
				id: id,
				status: status
			},
			url: base_url + 'admin/konfirmasi_pemesanan',
			success: function(data) {
				$("#modalKonfirmasi").modal('hide');
				$("#tablePemesanan").DataTable().ajax.reload();
			}
		});
	} else {
		alert('Something Wrong');
	}
});
var x = 0;
$(document).on('click', '.btnDeletePemesanan',function() {
	var getId = $(this).data('id');
	if (x == 0) {
		var deleteMessage = '<p><b>Apakah Anda Yakin Menghapus Data #'+getId+' .?</b></p>';
			deleteMessage += '<input type="hidden" name="id_pemesanan" id="id_pemesanan">';
		var deleteBtn = '<button type="button" class="btn btn-danger btn-flat" id="btnHapusPemesanan">Hapus</button>';

		$("#id_pemesanan").val(getId);
		$(".modal-delete").html(deleteMessage);
		$("#modal-fdelete").html(deleteBtn);
		x++;
	}
});
$(document).on('click', '#btnHapusPemesanan', function() {
	var id = $('#id_pemesanan').val();

	$.ajax({
		type: 'post',
		url: base_url+'admin/hapus_pemesanan',
		data: {
			id: id
		},
		success: function(data) {
			$("#modalKonfirmasi").modal('hide');
			$("#tablePemesanan").DataTable().ajax.reload();
		}
	});
});
var y = 0;
$(document).on('click', '.btnDetail', function() {
	var getId = $(this).data('id');
	if (y == 0) {
		$.ajax({
			type: 'post',
			url: base_url + 'admin/detail_pemesanan',
			data: {
				id: getId
			},
			success: function(data) {

			}
		});
	}
});
