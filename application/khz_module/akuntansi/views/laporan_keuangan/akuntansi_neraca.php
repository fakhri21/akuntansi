<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta name="generator" content=
  "HTML Tidy for Linux (vers 25 March 2009), see www.w3.org" />

  <title></title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style type="text/css">
/*<![CDATA[*/
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
  /*]]>*/
  </style>
</head>

<body>
  <div class="header">
    <h1 class="my-0 display-1">Laporan Neraca</h1>

    <div class="separator w-100-p mt-8"></div><br />

    <h2 class="my-0 mt-8"><?php echo  get_option( 'nama_perusahaan' ) ?></h2>

    <h3 class="my-0"><?php echo  get_option( 'sub_nama_perusahaan' ) ?></h3><span>Periode: <?php echo $hari ?>

  </div>

  <div>
    <span><?php 
    foreach ($isi as $type => $data) { ?></span>

    <table>
      <tr class="bg-light-blue">
        <th colspan="4" class="display-2"><?php echo $type;?></th>
      </tr>

      <tr class="bg-light-blue">
        <th>Deskripsi</th>

        <th>Previous Month</th>

        <th>Current Month</th>

        <th>Year To Date</th>
      </tr><?php
      foreach ($data as $value) {
      if (!is_null($value['nama_kategori'])) {?>

      <tr class="bg-dark-grey">
        <th colspan="4"><?php  echo $value['nama_kategori'];?></th>
      </tr><?php } ?>

      <tr>
        <td width="350px"><?php echo $value['id_nama_coa'];?></td>

        <td width="100px" class="amount">
        <?php echo 'Rp.'.number_format(abs($value['total_saldo_sebelumnya']));?></td>

        <td width="100px" class="amount"><?php echo 'Rp.'.number_format(abs($value['total_saldo']));?></td>

        <td width="100px" class="amount">
        <?php echo 'Rp.'.number_format(abs($value['total_saldo_berjalan']));?></td>
      </tr><?php } ?>
    </table>
<span><?php
}
if (abs(end($isi['aktiva'])['total_saldo'])==abs(end($isi['pasiva'])['total_saldo'])) { ?>
</span>
</pre>

    <h3 class="balance">Balanced</h3>
    <pre>
 
<?php }
?>
</pre>
  </div>
</body>
</html>
