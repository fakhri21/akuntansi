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

                            <h1 class="display-4">Laporan Laba Rugi</h1>
                            <div class="separator"></div>
                            <h2><?php echo  get_option( 'nama_perusahaan' ) ?></h2>
		                        <h4><?php echo  get_option( 'sub_nama_perusahaan' ) ?></h4>
		                       
                            <p class="lead mb-0">Periode : <?php echo $hari ?>  </p>
                       
                            <table>
                            <tr class='bg-light-blue'>
                              <th>Deskripsi</th>
                              <th>Previous Month</th>
                              <th>Current Month</th>
                              <th>Year To Date</th>
                            </tr>
                                <?php echo $isi; ?>
                            </table>
                            
                        