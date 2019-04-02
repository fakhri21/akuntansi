<div class="neraca" style="padding: 30px 0px">

	<div class="container">
		<div class="row">

			<div class="col-md-10 col-md-push-1">

				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4>Laba Rugi</h4>
					</div>

					<div class="panel-body">

					
						<table class="table">
							<thead>
								<th style="width: 75%;">Name</th>
								<th>Balance</th>
                            </thead>
                            <?php
                            foreach ($kategori as $kategoridata) {
                                
                             ?>

                            <!-- Kategori -->
            				<tr>
                                
								<th id="kategori"><?php echo $kategoridata['nama_kategori'];?></th>
								<th id="v_kas"><?php echo $kategoridata['sum(kredit-debit)'];?></th>
                            </tr>
                            
                            <?php foreach ($record as $recorddata) { 
                                if ($kategoridata['nama_kategori']==$recorddata['nama_kategori']) {
                            ?>
                            

                           <!-- Akun -->
                            <tr>
								<td id="akun" style="padding-left: 30px;"><i class="fa fa-angle-double-right"></i> <?php echo $recorddata['nama_akun']?></td>
                                <td id="b_akun"><?php echo $recorddata['sum(kredit-debit)']; ?></td>
                            </tr>
                            <?php }}?>
							<?php }?>
							 <tr>
                                 <th>Total</th>
                                 <th><span id="total"><?php echo $total[0]['sum(kredit-debit)']; ?></span></th>
                            </tr>

						</table>
					</div>

				</div><!-- panel -->

			</div><!-- col -->
		</div><!-- row -->
	</div><!-- container -->
    
    <script>
        OSREC.CurrencyFormatter.formatAll(
  {
   selector: '#total,#v_kas,#b_akun', 
   currency: 'IDR'
  });
    </script>