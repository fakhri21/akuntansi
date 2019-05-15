<div class="neraca" style="padding: 30px 0px">

	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-push-1">
				<div class="panel panel-primary">
					<div class="panel-heading">
                        <h4>Neraca</h4>
					</div>
                    <div class="panel-body">
						<table class="table">
							<thead>
                                <th style="width: 75%;">Name</th>
                                <th>Balance</th>
                            </thead>

                            <!-- Kategori -->
            				<tr>
                                
								<th id="kategori"></th>
								<th id="v_kas"></th>
                            </tr>
                            
                           <!-- Akun -->
                            <tr>
								<td id="akun" style="padding-left: 30px;"><i class="fa fa-angle-double-right"></i> </td>
                                <td id="b_akun"></td>
                            </tr>
                            
                            <tr>
                                <th>Total</th>
                                <th><span id="total"></span></th>
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
   selector: '#v_kas,#b_akun,#total', 
   currency: 'IDR'
  });
  
</script>
</html>