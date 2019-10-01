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

 <div>
        <h1 class="my-0 display-1">Laporan Subleger Stock</h1>
        <div class="separator w-100-p mt-8"></div><br />
        <h2 class="my-0 mt-8">Cofee Blues Indonesia</h2>
        <h3 class="my-0">Outlet Medan</h3>   
    </div>

    <div class="box-bon">
        <div class="header">
        <h4>Sub Ledger</h4>
            <table class="table-header">
                
                <tr>
                    <td>ID COA</td>
                    <td>:</td>
                    <td><?php echo $record[0]['id_coa_stock'] ?></td>
                </tr>

                <tr>
                    <td>Nama Stock</td>
                    <td>:</td>
                    <td><?php echo $record[0]['nama_stock'] ?></td>
                </tr>

                <tr>
                    <td>Priode</td>
                    <td>:</td>
                    <?php if ($hari) { ?>
                    <td><?php echo $hari ?> s/d <?php echo $hari_akhir ?></td>
                        
                    <?php } ?>
                </tr>
            </table>
        </div>

        <div class="separator w-100-p mt-8"></div><br />

        <div class="isi">

            <table class="table-style-two" width="100%">
                
                <thead>
                    <tr>
                        <th  class="bg-light-blue" rowspan=2>Keterangan</th>
                        <th  class="bg-light-blue" rowspan=2 width="10%">Tanggal</th>
                        <th  class="bg-light-blue" colspan=3>Stock Masuk</th>
                        <th  class="bg-light-blue" colspan=3>Stock Keluar</th>
                        <th  class="bg-light-blue" colspan=3>Saldo</th>
                    </tr>
                        
                    <tr>
                        <th class="bg-light-blue">Qty</th>
                        <th class="bg-light-blue">Price</th>
                        <th class="bg-light-blue">Ammount</th>

                        <th class="bg-light-blue">Qty</th>
                        <th class="bg-light-blue">Price</th>
                        <th class="bg-light-blue">Ammount</th>

                        <th class="bg-light-blue">Qty</th>
                        <th class="bg-light-blue">Price</th>
                        <th class="bg-light-blue">Ammount</th>
                        
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td></td>
                        <td class="text-bold" width="10%">Saldo Awal</td>

                        <td></td>
                        <td></td>
                        <td></td>

                        <td></td>
                        <td></td>
                        <td></td>

                        <td class="text-bold text-right"><?php echo 'Rp.' . $record[0]['saldo_quantity_awal']?></td>
                        <td class="text-bold text-right"><?php echo 'Rp.' . $record[0]['saldo_price_awal']?></td>
                        <td class="text-bold text-right"><?php echo 'Rp.' . $record[0]['saldo_nilai_awal']?></td>
                        
                    </tr>
                <?php
                $total_debit=0; 
                $total_nilai_debit=0; 
                $total_kredit=0; 
                $total_nilai_kredit=0; 
                $total_saldo=0;
                $total_nilai_saldo=0;
                foreach ($record as $data) { 
                    $total_debit=$total_debit+$data['debit_stock'];
                    $total_nilai_debit=$total_nilai_debit+$data['total_nilai_debit'];

                    $total_kredit=$total_kredit+$data['kredit_stock'];
                    $total_nilai_kredit=$total_nilai_kredit+$data['total_nilai_kredit'];
                    
                    $total_saldo=$data['saldo_quantity_stock'];
                    $total_nilai_saldo=$data['saldo_nilai_stock'];
                ?>
                    <tr>
                        <td><?php echo $data['keterangan'] ?></td>
                        <td width="10%"><?php echo $data['waktu'] ?></td>
                        
                        <td class="text-right"><?php echo  number_format($data['debit_stock'],2) ?></td> <!-- Barang masuk -->
                        <td class="text-right"><?php echo 'Rp.' . number_format($data['harga_beli_debit'],2); ?></td>
                        <td class="text-right"><?php echo 'Rp.' . number_format($data['total_nilai_debit'],2);?> </td>
                        
                        <td class="text-right"><?php echo  number_format($data['kredit_stock'],2) ?></td> <!-- Barang Keluar -->
                        <td class="text-right"><?php echo 'Rp.' . number_format($data['harga_beli_kredit'],2); ?></td>
                        <td class="text-right"><?php echo 'Rp.' . number_format($data['total_nilai_kredit'],2);?> </td>
                        
                        <td class="text-right"><?php echo  number_format($data['saldo_quantity_stock'],2) ?></td>
                        <td class="text-right"><?php echo 'Rp.' . number_format($data['rata_nilai_stock'],2) ?></td> <!-- Barang Keluar -->
                        <td class="text-right"><?php echo 'Rp.' . number_format(abs($data['saldo_nilai_stock']),2) ?></td>
                        
                        
                    </tr>
                
                <?php } ?>
                    
                </tbody>

                
                    <tr class="text-bold">
                        <td colspan="2">TOTAL</td>
                        <td class="text-right"><?php echo 'Rp.' . number_format($total_debit,2) ?></td>
                        <td width="10%"></td>
                        <td class="text-right"><?php echo 'Rp.' . number_format($total_nilai_debit,2) ?></td>
                        
                        <td class="text-right"><?php echo 'Rp.' . number_format($total_kredit,2) ?></td>
                        <td ></td>
                        <td class="text-right"><?php echo 'Rp.' . number_format($total_nilai_kredit,2) ?></td>
                        
                        <td class="text-right"><?php echo 'Rp.' . number_format($total_saldo,2) ?></td>
                        <td ></td>
                        <td class="text-right"><?php echo 'Rp.' . number_format(abs($total_nilai_saldo),2) ?></td>
                         
                    </tr>    

            </table>
            
        </div>
    </div>


    
</body>
</html>
