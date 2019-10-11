<style>
/*design table 1*/
.table {
    font-family: sans-serif;
    color: #232323;
    border-collapse: collapse;
}

.table, th, td {
    border: 1px solid #999;
    padding: 8px 20px;
}

th{
    border: 1px solid #999;
    padding: 8px 20px;
}

</style>

<div class="panel panel-primary">
					<div class="panel-heading">
						<h4>Waktu / Tanggal : {{waktu_voucher}}</h4>
						<h4>ID VOUCHER : <?php echo $record[0]['id_voucherjurnal'] ?></h4>
						<h4>TIPE VOUCHER : <?php echo $record[0]['id_tipe_voucher'] ?></h4>
						<!-- <h4>NAMA PEMBUAT : <?php echo $record[0]['nama_coa'] ?></h4>
						 -->
					</div>

                    <div class="panel-body">
						<h5></h5>

						
						<table class="table" id="mytable">
							<tr>
								<th>No</th>
								<th style="width: 50%;">keterangan</th>
                                <th>Jumlah Uang (Rp)</th>
                            </tr>
                            <?php
                            $total=0;
                            $no=0;
                            foreach ($record as $recorddata) {
                             $total=$total+$recorddata['nilai'];
							 ?>

                            <!-- Kategori -->
            				<tr>
                                
								<td id="No"><?php echo ++$no;?></th>
								<td id="Keterangan"><?php echo $recorddata['keterangan'];?></th>
                                <td id="Jumlah"><?php echo number_format($recorddata['nilai']);?></th>
                                
                            </tr>
                            
                            <?php }?>
                            
                          
                        </table>
                            <h4>Total : <?php echo number_format($total) ?></h4>

					</div>
Diketahui, <br>
()
Disetujui, <br>
()

Disahkan, <br>
()				</div><!-- panel -->
