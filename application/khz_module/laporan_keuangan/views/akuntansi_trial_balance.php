<html>

    
<style>
    *{
        font-family: sans-serif;
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
<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <div>
        <h1 class="my-0 display-1">Trial Balance</h1>
        <div class="separator w-100-p mt-8"></div><br />
        <h2 class="my-0 mt-8"><?php echo  get_option( 'nama_perusahaan' ) ?></h2>
        <h3 class="my-0"><?php echo  get_option( 'sub_nama_perusahaan' ) ?></h3>
        <span>Periode: <?php echo $hari ?> <span>       
    </div>

</head>
<body>
    <div>
  <table class="table-style-two border" >
    <tr class="bg-light-blue">
      <th>Deskripsi</th>
      <th>Saldo Debit</th>
      <th>Saldo Kredit</th>
  </tr>
  <?php echo $isi; ?>
</table>
</div>
</body>
</html>