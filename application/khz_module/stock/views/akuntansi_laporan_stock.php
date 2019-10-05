<div id="app">
    <stock></stock>
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
    $.getJSON("<?php echo base_url('akuntansi/list_coa/0')?>",function (data) {
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