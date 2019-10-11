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

        /* 

    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
        background: #fff;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #111;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #00FFFF;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    */
    
    /** RTL **/

    /*
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }

    */
    </style>
</head>

<body>

    <div class="box-bon">
        <div class="header">
            <table class="table-header">
                
                <tr>
                    <td>ID VOUCHER</td>
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
                        <th style="background: #eceff1;">Jumlah Uang (rp)</th>
                    </tr>
                </thead>

                <tbody>
                    
                    <?php
                    $total=0;
                    $no=0;
                    foreach ($record as $recorddata) {
                    $total=$total+$recorddata['nilai'];
                    ?>
                    
                    <tr>
                        <td><?php echo ++$no;?></td>
                        <td style="width: 50%;"><?php echo $recorddata['keterangan'];?></td>
                        <td><?php echo number_format($recorddata['nilai']);?></td>
                    </tr>

                    <?php }?>


                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="2" style="text-align: center; background: #b2dfdb;">TOTAL</td>
                        <td style="background: #b2dfdb;"><?php echo number_format($total) ?></td>
                </tfoot>

            </table>
            
        </div>
    </div>


    
</body>
</html>
