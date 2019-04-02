<div class="container">
    <div class="row mb-2">
        <div class="col">
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col">
            <div class="box box-primary">
                <div class="box-header">
                    <h1 class="display-4">Daftar Kelompok COA</h1>
                    <?php echo anchor(base_url('m_kelompok_coa/create'), '<div class="btn-custom-label"><i class=" fa fa-plus" aria-hidde="true"></i></div><span> Tambah Kelompok COA </span>', 'class="btn btn-primary btn-labeled-custom"'); ?>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered table-striped" id="mytable">
                                <thead>
                                    <tr>
                                        <th width="80px">No</th>
                                        <th>Id Kelompok Coa</th>
                                        <th>Nama Kelompok Coa</th>
                                        <th width="200px">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
$.fn.dataTable.ext.classes.sPageButton = 'btn btn-primary mx-1'; // Change Pagination Button Class
$.fn.dataTableExt.classes.sWrapper = "dataTables_wrapper col mt-2 dt-bootstrap";
$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
{
    return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
    };
};

var t = $("#mytable").dataTable({
    initComplete: function() {
        var api = this.api();
        $('#mytable_filter input')
        .off('.DT')
        .on('keyup.DT', function(e) {
            if (e.keyCode == 13) {
                api.search(this.value).draw();
            }
        });
    },
    oLanguage: {
        sProcessing: "loading..."
    },
    processing: true,
    serverSide: true,
    ajax: {"url": "m_kelompok_coa/json", "type": "POST"},
    columns: [
    {
        "data": "uniqid",
        "orderable": false
    },{"data": "id_kelompok_coa"},{"data": "nama_kelompok_coa"},
    {
        "data" : "action",
        "orderable": false,
        "className" : "text-center"
    }
    ],
    order: [[0, 'desc']],
    rowCallback: function(row, data, iDisplayIndex) {
        var info = this.fnPagingInfo();
        var page = info.iPage;
        var length = info.iLength;
        var index = page * length + (iDisplayIndex + 1);
        $('td:eq(0)', row).html(index);
    }
});
});
</script>