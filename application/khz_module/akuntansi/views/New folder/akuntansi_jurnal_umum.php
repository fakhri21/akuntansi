<div id="form" style="padding: 30px 0px;">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-push-2">
				<table class="table table-bordered">
					
					<tr class="info">
						<th>No jurnal</th>
						<th>Waktu</th>
						<th>Keterangan</th>
						<th>Akun</th>
						<th>Debit</th>
						<th>Kredit</th>
					</tr>
					<?php foreach ($record as $recorddata) { ?>
					
					<tr>
						<td><?php echo $recorddata['no_transaksi'];?></td>
						<td><?php echo $recorddata['waktu'];?></td>
						<td><?php echo $recorddata['keterangan'];?></td>
						<td><?php echo $recorddata['no_akun']; echo " ".$recorddata['nama_akun']."";?></td>
						<th id="debit"><?php echo $recorddata['debit'];?></th>
						<th id="kredit"><?php echo $recorddata['kredit'];?></th>
						
					</tr>
					<?php } ?>

				</table>
			</div>
		</div>
	</div>
	</div><!-- form -->

<script>
    OSREC.CurrencyFormatter.formatAll(
  {
   selector: '#debit,#kredit', 
   currency: 'IDR'
  });
</script>