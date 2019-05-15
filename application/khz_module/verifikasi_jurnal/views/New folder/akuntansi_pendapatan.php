<div id="form" style="padding: 30px 0px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-push-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4><i class="fa fa-dollar"></i> Pendapatan</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                <select id="akun_pendapatan">
                                <?php foreach ($pasiva as $pasivadata) { ?>
                                <option value="<?php echo $pasivadata['no_akun']; ?>"> <?php echo "".$pasivadata['no_akun']." " .$pasivadata['nama_akun']."";?></option>
                                <?php }?>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Akun Pendapatan</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="number" id="jumlah" oninput= placeholder="Jumlah" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <select id="bayar_ke">
                                    <?php foreach ($aktiva as $aktivadata) { ?>
                                    <option value="<?php echo $aktivadata['no_akun']; ?>"> <?php echo "".$aktivadata['no_akun']." " .$aktivadata['nama_akun']."";?></option>
                                    <?php }?>
                                    </select>
                                
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Akun Penerima</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <textarea id="keterangan" placeholder="Keterangan" class="form-control"></textarea>
                                </div>

                            </div>


                        </div>
                        <!-- row -->

                    </div>
                    <!-- panel body -->

                    <div class="panel-footer">
                        <button class="btn btn-success" onclick="tambah_pengeluaran()"><i class="fa fa-check"></i> Ok</button>
                        <button class="btn btn-danger" onclick="location.reload()"><i class="fa fa-remove"></i> Cancel</button>
                    </div>
                </div>
                <!-- panel default -->
            </div>
        </div>
    </div>
</div>
<!-- form -->

<script>
    
function tambah_pengeluaran() {
	var data={'no_akun':$('#akun_pendapatan').val(),
				'nilai':$('#jumlah').val(),
				'invno_akun':$('#bayar_ke').val(),
				'keterangan':$('#keterangan').val()}

	$.post('addpendapatan',data,function (response) {
		alert("Berahasil Menambahkan");
        location.reload()
	})
}

</script>