<div class="container">
    <div class="row">
        <div class="col">
            <div class="box box-primary mb-2">
                <div class="box-body">
                    <a href="javascript:history.back()" class="btn btn-link btn-back"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>        
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"> Laporan Stock</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form class="col" id="laporan_stock" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>akuntansi/stock_sub">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="hari">Tanggal Awal</label>
                                            </div>
                                            <input type="text" name="hari" id="hari" class="form-control hari value=">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="hari_akhir">Tanggal Akhir</label>
                                            </div>
                                            <input type="text" name="hari_akhir" id="hari_akhir" class="form-control hari" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-2">
                                    Status
                                </div>
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" name="status" class="custom-control-input" value="0" checked>
                                                <label class="custom-control-label" for="customRadio1">Subleger Stock</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio2" name="status" class="custom-control-input" value="1">
                                                <label class="custom-control-label" for="customRadio2">Stockopname</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" id="coa-row">
                                <div class="col-2">
                                    <label for="coa">COA Stock</label>
                                </div>
                                <div class="col">
                                    <select id="coa" name="coa" value=""> </select>
                                </div>
                            </div> 
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6 mx-auto">
                                        <input type="submit" name="" value="Enter" class="btn btn-primary col">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(".hari").datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });

    $("document").ready(function () {
        $("#mytable").dataTable()
    })

</script>
<script>
    $.getJSON("akuntansi/list_coa/0",function (data) {
        $("#coa").selectize({
            valueField: 'id_coa',
            labelField: 'nama_coa',
            searchField: 'nama_coa',
            options: data,
            create: false
        });
    })   

    $('#customRadio1').on('click', function(){
        $('#coa-row').slideDown();
    });
    $('#customRadio2').on('click', function(){
        $('#coa-row').slideUp();
    });

</script>