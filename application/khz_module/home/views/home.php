<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <form id="mainform" action="<?php echo base_url('home/print_pdf') ?>" method="post">
        <input type="number" name="tes" value="" placeholder="Input angka">
        </form>
        <input type="submit" onclick="kirim()" name="" value="Tampil">
        <input type="submit" onclick="print()" name="" value="Print">

        <br>
        <br>
        <br>

        Hasil    
        <div id="hasil">
            
        </div>

        


    </body>
<footer>
    <a href="<?php echo base_url('karyawan') ?>"> Ke Soal No 2</a>

</footer>
    <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
    <script>
        function kirim() {
            $.post("<?php echo base_url('home/hasil_angka') ?>",$("#mainform").serialize(),function(hasil) {
            $("#hasil").html(hasil);
        })
        }


        function print() {
            
            var fileName = "hasil.txt";
            var textToWrite = $('#hasil').html().replace('br', 'rn');
      var textFileAsBlob = new Blob([textToWrite], { type: 'text/plain' });

       var downloadLink = document.createElement('a');
        downloadLink.download = fileName;
        downloadLink.innerHTML = 'Download File';

        downloadLink.href = window.URL.createObjectURL(textFileAsBlob);
          downloadLink.click(function(){
          	document.body.removeChild(event.target);
          }); 
		  
          downloadLink.style.display = 'none';
          document.body.appendChild(downloadLink);
          downloadLink.click();
	

        }
    </script>
</html>