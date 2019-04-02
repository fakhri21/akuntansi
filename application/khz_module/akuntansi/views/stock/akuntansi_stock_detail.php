<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>
    
    <style>

    .box-bon{
        background: #fff;
        max-width: 800px;
        margin: auto;
        padding: 30px 40px;
        font-family: "Courier New";
    }

    .header{
        padding: 10px 20px;
        margin: 10px auto;
        background: #f9f9f9;
    }

    .table-header{
        width: 100%
    }

    .table-isi{
        width: 100%;
        border: 1px solid #eee;
    }

    </style>
</head>

<body>

    <div class="box-bon">
        <div class="header">
            <table class="table-header">
                
                <tr>
                    <td>Purchase Order</td>
                    <td>:</td>
                    <td><?php echo $record[0]['id_voucherjurnal'] ?></td>
                </tr>

                <tr>
                    <td>TYPE VOUCHER</td>
                    <td>:</td>
                    <td><?php echo $record[0]['id_tipe_voucher'] ?></td>
                </tr>

                <tr>
                    <td>WAKTU/TANGGAL</td>
                    <td>:</td>
                    <td><?php echo $record[0]['waktu'] ?></td>
                </tr>
            </table>
        </div>

        <hr>

        <div class="isi">

            <table class="table-isi">
                
                <thead>
                    <tr>
                        <th style="background: #eceff1;">NO</th>
                        <th style="background: #eceff1;">KET</th>
                        <th style="background: #eceff1;">QTY</th>
                        <th style="background: #eceff1;">Nilai (Rp)</th>
                        <th style="background: #eceff1;">Diskon</th>
                        <th style="background: #eceff1;">Pajak</th>
                        <th style="background: #eceff1;">Payment Type</th>
                        <th style="background: #eceff1;">Vendor</th>
                    </tr>
                </thead>

                <tbody>
                    
                    <?php
                    $grand_total=0;
                    $total_pajak=0;
                    $total_potongan=0;
                    $no=0;
                    foreach ($record as $recorddata) {
                    $total_pajak=$total_pajak+$recorddata['nilai_pajak'];
                    $total_potongan=$total_potongan+$recorddata['nilai_potongan'];
                    $grand_total=$grand_total+$recorddata['total_nilai_stock']+$total_pajak-$total_potongan;
                    ?>
                    
                    <tr>
                        <td><?php echo ++$no;?></td>
                        <td style="width: 50%;"><?php echo $recorddata['keterangan'];?></td>
                        <td style="width: 50%;"><?php echo $recorddata['debit_stock'];?></td>
                        <td><?php echo number_format($recorddata['harga_beli']);?></td>
                        <td><?php echo number_format($recorddata['persen_potongan']);?> %</td>
                        <td><?php echo number_format($recorddata['persen_pajak']);?> %</td>
                        <td><?php echo $recorddata['jenis_pembayaran'];?></td>
                        <td><?php echo $recorddata['nama_vendor'];?></td>
                    </tr>

                    <?php }?>


                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="2" style="text-align: center; background: #b2dfdb;">Diskon</td>
                        <td style="background: #b2dfdb;"><?php echo number_format($total_potongan) ?></td>
                        </tr>
                   
                        <tr>
                        <td colspan="2" style="text-align: center; background: #b2dfdb;">Pajak</td>
                        <td style="background: #b2dfdb;"><?php echo number_format($total_pajak) ?></td>
                        </tr>
                   
                       <tr> 
                        <td colspan="2" style="text-align: center; background: #b2dfdb;">TOTAL</td>
                        <td style="background: #b2dfdb;"><?php echo number_format($grand_total) ?></td>
                    </tr>
                </tfoot>

            </table>
            
        </div>
    </div>


    
</body>
</html>
