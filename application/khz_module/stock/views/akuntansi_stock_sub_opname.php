<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>

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
            font-size: 15px;
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
</head>

<body>

    <div class="box-bon">
        <div class="header">
            <div>
                <h1 class="my-0 display-1">Laporan Stock Opname</h1>
                <div class="separator w-100-p mt-8"></div><br />
                <h2 class="my-0 mt-8">Cofee Blues Indonesia</h2>
                <h3 class="my-0">Outlet Medan</h3>
                <span>Periode: <?php echo $hari ?> <span>       
                </div>
            </div>

            <div class="isi">

                <table class="table-style-two" width="100%">

                    <thead>
                        <tr>
                            <th rowspan=2 class="bg-light-blue">NO</th>
                            <th rowspan=2 class="bg-light-blue">Keterangan</th>
                            <th colspan=3 class="bg-light-blue">Stock Awal</th>
                            <th colspan=3 class="bg-light-blue">Pembelian</th>
                            <th colspan=3 class="bg-light-blue">Stock Akhir</th>
                            <th colspan=3 class="bg-light-blue">Pemakaian Bahan</th>
                        </tr>

                        <tr>
                            <th  class="bg-light-blue">Qty</th>
                            <th  class="bg-light-blue">Price</th>
                            <th  class="bg-light-blue">Ammount</th>

                            <th  class="bg-light-blue">Qty</th>
                            <th  class="bg-light-blue">Price</th>
                            <th  class="bg-light-blue">Ammount</th>

                            <th class="bg-light-blue">Qty</th>
                            <th class="bg-light-blue">Price</th>
                            <th class="bg-light-blue">Ammount</th>

                            <th class="bg-light-blue">Qty</th>
                            <th class="bg-light-blue">Price</th>
                            <th class="bg-light-blue">Ammount</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                        $no=0;

                        foreach ($record as $data) { 
                            ?>
                            <tr>
                                <td><?php echo ++$no ?></td>
                                <td style="width: 50%;"><?php echo $data['nama_stock'] ?></td>

                                <td class="text-right"><?php echo 'Rp.' . number_format($data['saldo_quantity_awal']) ?></td> <!-- Barang awal -->
                                <td class="text-right"><?php echo 'Rp.' . number_format($data['saldo_price_awal']); ?> </td>
                                <td class="text-right"><?php echo 'Rp.' . number_format($data['saldo_nilai_awal']); ?> </td>

                                <td class="text-right"><?php echo 'Rp.' . number_format($data['debit_stock']) ?></td> <!-- Barang masuk -->
                                <td class="text-right"><?php echo 'Rp.' . number_format($data['price_debit']); ?></td>
                                <td class="text-right"><?php echo 'Rp.' . number_format($data['total_debit']);?></td>

                                <?php if ($data['kredit_stock']) { ?>    
                                <td class="text-right"><?php echo 'Rp.' . number_format($data['saldo_quantity_akhir']) ?></td>
                                <td class="text-right"><?php echo 'Rp.' . number_format($data['rata_nilai_stock']) ?></td> <!-- Barang Akhir -->
                                <td class="text-right"><?php echo 'Rp.' . number_format($data['total_nilai_stock']) ?></td>  
                                <?php } else { ?>

                                <td class="text-right"><?php echo 'Rp.' . number_format(0,2) ?></td>
                                <td class="text-right"><?php echo 'Rp.' . number_format(0,2) ?></td> <!-- Barang Akhir -->
                                <td class="text-right"><?php echo 'Rp.' . number_format(0,2) ?></td>      

                                <?php } ?> 

                                <td class="text-right"><?php echo 'Rp.' . number_format(abs($data['kredit_stock'])) ?></td> <!-- Barang Keluar -->
                                <td class="text-right"><?php echo 'Rp.' . number_format(abs($data['price_kredit']));?></td>
                                <td class="text-right"><?php echo 'Rp.' . number_format(abs($data['total_kredit']));?></td>

                            </tr>

                            <?php } ?>

                        </tbody>
<!-- 
<tr>
<td colspan="2" style="text-align: center; background: #b2dfdb;">TOTAL</td>

<td></td>
<td></td>
<td></td>

<td style="background: #b2dfdb;"><?php echo number_format($total_debit,2) ?></td>
<td style="background: #b2dfdb;"><?php echo number_format($total_price_debit,2) ?></td>
<td style="background: #b2dfdb;"><?php echo number_format($total_ammount_debit,2) ?></td>

<td style="background: #b2dfdb;"><?php echo number_format($total_kredit,2) ?></td>
<td style="background: #b2dfdb;"><?php echo number_format($total_price_kredit,2) ?></td>
<td style="background: #b2dfdb;"><?php echo number_format($total_ammount_kredit,2) ?></td>

<td style="background: #b2dfdb;"><?php echo number_format($total_saldo,2) ?></td>
<td style="background: #b2dfdb;"><?php echo number_format($total_price_saldo,2) ?></td>
<td style="background: #b2dfdb;"><?php echo number_format($total_ammount_saldo,2) ?></td>
</tr>    
-->
</table>

</div>
</div>



</body>
</html>
