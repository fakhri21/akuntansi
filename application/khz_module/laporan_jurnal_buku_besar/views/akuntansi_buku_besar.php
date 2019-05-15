<html>
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
    .text-bold{
        font-weight: bold;
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
        width: 100%;
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
      <div>
        <h1 class="my-0 display-1">Laporan Buku Besar</h1>
        <div class="separator w-100-p mt-8"></div><br />
        <h2 class="my-0 mt-8"><?php echo  get_option( 'nama_perusahaan' ) ?></h2>
        <h3 class="my-0"><?php echo  get_option( 'sub_nama_perusahaan' ) ?></h3>
        <span>Periode: <?php echo $hari ?> <span>       
    </div>

</div>
<div>
   <div>
      <h4><?php echo $record[0]['nama_coa'] ?></h4>
  </div>

  <div>
      <h5></h5>


      <table class="table-style-two border" >
        <tr class="bg-light-blue">
            <th>Waktu</th> 
            <th>Id Jurnal</th> 
            <th style="width: 50%;">Keterangan</th>
            <th>Debit</th>
            <th>Kredit</th>
            <th class="text-bold" >Saldo</th>
        </tr>
        <tr>

            <td width="11%" id="waktu"></td> 
            <td class="text-center" id="id_jurnal"></td>
            <td class="text-bold" id="keterangan">Saldo Awal</td>
            <td class="text-right" id="debit"></td>
            <td class="text-right" id="kredit"></td>
            <td class="text-right text-bold" id="saldo"><?php echo 'Rp.'.number_format($record[0]['saldo_awal_ok']);?></td>

        </tr>

        <?php
        $total_kredit=0;
        $total_debit=0;
        $total_saldo=0;
        $no=0;
        foreach ($record as $recorddata) {
            $total_saldo=$recorddata['saldo'];
            $total_kredit=$total_kredit+$recorddata['kredit'];
            $total_debit=$total_debit+$recorddata['debit'];
            ?>

            <!-- Kategori -->
            <tr>

                <td width="11%" id="waktu"><?php echo $recorddata['waktu'];?></td> 
                <td class="text-center" id="id_jurnal"><?php echo $recorddata['id_detail'];?></td>
                <td id="keterangan"><?php echo $recorddata['keterangan'];?></td>
                <td class="text-right" id="debit"><?php echo 'Rp.'.number_format($recorddata['debit']);?></td>
                <td class="text-right" id="kredit"><?php echo 'Rp.'.number_format($recorddata['kredit']);?></td>
                <td class="text-right" id="saldo"><?php echo 'Rp.'.number_format($recorddata['saldo']);?></td>

            </tr>

            <?php }?>
            <tr>

                <td width="11%" id="waktu"></td> 
                <td class="text-center text-bold" id="id_jurnal">Total</td>
                <td id="keterangan"></td>
                <td class="text-right text-bold" id="debit"><?php echo 'Rp.'.number_format($total_debit);?></td>
                <td class="text-right text-bold" id="kredit"><?php echo 'Rp.'.number_format($total_kredit);?></td>
                <td class="text-right text-bold" id="saldo"><?php echo 'Rp.'.number_format($total_saldo);?></td>

            </tr>


        </table>


    </div>

</div><!-- panel -->

</div><!-- col -->
</html>