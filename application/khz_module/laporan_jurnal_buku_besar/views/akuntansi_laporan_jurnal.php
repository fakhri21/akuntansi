<style>
    *{
        font-family: sans-serif;
    }
    .text-center{
        text-align: center;
    }

    .text-right{
        text-align: right;
    }
    .my-0{
        margin-top: 0;
        margin-bottom: 0;
    }
    .display-1{
        font-size: 50px;
        font-weight: 100;
    }
    .display-2{
        font-size: 25px;
        font-weight: 100;
        text-transform: uppercase;
    }
    .separator{
        border-top: 1px solid #474747;
    }
    .w-100-p{
        max-width: 100%;
    }
    .mt-4{
        margin-top: 4px !important;
    }
    .mt-8{
        margin-top: 8px !important;
    }
    .mt-16{
        margin-top: 16px !important;
    }
    .bg-light-blue{
        background: rgb(0, 42, 79) !important;
        color: white;
    }
    .bg-dark-grey{
        background: rgb(68, 68, 68);
        color:white;
    }
    .text-white{
        color: white;
    }

    table{
        border-collapse: collapse;
        border-radius: 10px;
        font-size: 12px;
    }
    td{
        padding: 8px 4px;
    }
    tr:nth-child(even){
        background: rgb(249, 249, 249);
    }
    .balance{
        background: rgb(73, 255, 134);
        padding: 4px 16px;
        boder: 1px solid rgb(73, 255, 134);
        text-align: center;
        font-weight: 100;

    }
    .success{
        background: rgb(73, 255, 134);
        width: 100px;
        float: right;
        margin-left: auto;
    }
    .text-center{
        text-align: center;
    }
    .amount{
        font-size:5vw;
    }

</style>

    <div>
        <h1 class="my-0 display-1">Laporan Jurnal</h1>
        <div class="separator w-100-p mt-8"></div><br />
        <h2 class="my-0 mt-8"><?php echo  get_option( 'nama_perusahaan' ) ?></h2>
        <h3 class="my-0"><?php echo  get_option( 'sub_nama_perusahaan' ) ?></h3>
        <span>Periode: <?php echo $hari ?> <span>       
    </div>


<div  style="padding: 30px 0px">

			<div>
            	<div>
					
                    <div>
						<h5></h5>

						
						<table class="table-style-two border" >
                            <tr class="bg-light-blue">
                                <th>Waktu</th> 
                                <th>Id coa</th> 
                                <th>COA</th> 
								<th style="widtd: 50%;">Keterangan</th>
                                <th>Id jurnal</th>
                                <th>Debit</th>
                                <th>Kredit</td>
                            </tr>
                            <?php
                            $debit=0;
                            $kredit=0;
                            foreach ($record as $recorddata) {
                             ?>

                            <!-- Kategori -->
            				<tr>
                                
                                <td id="waktu" width="11%"><?php echo $recorddata['waktu'];?></th> 
								<td id="id_coa" width="8%"><?php echo $recorddata['id_coa'];?></th>
								<td id="id_coa"><?php echo $recorddata['nama_coa'];?></th>
								<td id="keterangan"><?php echo $recorddata['keterangan'];?></th>
								<td class="text-center" id="id_detail"><?php echo $recorddata['id_row'];?></th>
								<td class="text-right" id="debit"><?php echo 'Rp.' . number_format($recorddata['debit']);?></th>
								<td class="text-right" id="kredit"><?php echo 'Rp.' . number_format($recorddata['kredit']);?></th>
                                
                            </tr>
                            
            				<tr>
                                
                                <td id="waktu" width="11%"><?php echo $recorddata['waktu'];?></th> 
								<td id="id_coa" width="8%"><?php echo $recorddata['inversid_coa'];?></th>
								<td id="id_coa"><?php echo $recorddata['inversnama_coa'];?></th>
								<td id="keterangan"><?php echo $recorddata['keterangan'];?></th>
								<td class="text-center" id="id_detail"><?php echo $recorddata['id_row'];?></th>
								<td class="text-right" id="debit"><?php echo 'Rp.' . number_format($recorddata['invers_debit']);?></th>
								<td class="text-right" id="kredit"><?php echo 'Rp.' . number_format($recorddata['invers_kredit']);?></th>
                                
                            </tr>
                            
                            <?php }?>
                            
                          
                        </table>
                            

					</div>

				</div><!-- panel -->

			</div><!-- col -->
		
</html>