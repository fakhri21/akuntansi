<div class="neraca" style="padding: 30px 0px">
<div class="row">
    <div class="col-md-10 col-md-push-1">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4><i class="fa fa-book"></i> Kas</h4>
            </div>

            <div class="panel-body">
                <table class="table">
                    <thead>
                        <th>Keterangan</th>
                        <th>Waktu</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                    </thead>
                    <?php
                            $saldo=0;
                            foreach ($record as $recorddata) {
                                $saldo+=$recorddata['(debit-kredit)'];
                             ?>

                        <!-- Kategori -->
                        <tr>

                            <th id="Keterangan">
                                <?php echo $recorddata['keterangan'];?>
                            </th>
                            <th id="waktu">
                                <?php echo $recorddata['waktu'];?>
                            </th>
                            <th id="debit">
                                <?php echo $recorddata['debit'];?>
                            </th>
                            <th id="kredit">
                                <?php echo $recorddata['kredit'];?>
                            </th>
                            <th id="Saldo">
                                <?php echo $saldo ;?>
                            </th>
                        </tr>

                        <?php }?>


                </table>


            </div>

        </div>
        <!-- panel -->

    </div>
    <!-- col -->
</div>
</div>
<!-- row -->
<script>
    var record_data = <?php echo json_encode($record); ?>;
    
    OSREC.CurrencyFormatter.formatAll(
{
	selector: '#debit,#kredit,#saldo', 
	currency: 'IDR'
});

    var tampil = ["<div id='child1'>1</div>", "<div id='child2'>2</div>"]

    function tes() {
        var divkategori = $("#kategori").clone()
        var jumlahkategori = kategori_data.length

        var divakun = $("#record").clone()
        var jumlahakun = akun_data.length

        var i = 0

        function kat() {
            i = 0
            while (i < jumlahkategori) {
                divkategori.text(kategori_data[i].nama_kategori)
                $("#isi").append(divkategori)
                akun()
                i = i + 1;
            }
        }

        function akun() {
            var i = 0
            while (i < jumlahakun) {
                divkategori.text(akun_data[i].nama_akun)
                $("#kategori").append(divakun)
                i = i + 1;
            }
        }

        kat()

    }
</script>