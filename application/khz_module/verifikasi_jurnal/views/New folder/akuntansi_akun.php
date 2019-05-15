<div class="col-md-8">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Data Akun</h3>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table">
                <tbody>
                    <th>No Akun</th>
                    <th>Nama Akun</th>
                    <th>Nama Kategori</th>
                    <th style="width: 20%;">Action</th>
                </tbody>

                <?php foreach ($record as $recorddata) { ?>
                
                <tr>
                    <td><?php echo $recorddata['no_akun']; ?></td>
                    <td><?php echo $recorddata['nama_akun']; ?></td>
                    <td><?php echo $recorddata['nama_kategori']; ?></td>
                    
                    <td>
                        <a class="btn btn-xs btn-warning" onclick="update(<?php echo $recorddata['no_akun']; ?>)"><i class="fa fa-edit"></i> Edit</a>
                        <a class="btn btn-xs btn-danger" onclick="delete_akun(<?php echo $recorddata['no_akun']; ?>)"><i class="fa fa-remove"></i> Delete</a>
                    </td>
                </tr>
                <?php }?>
            </table>
        </div>

        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
            </ul>
        </div>

    </div>

</div>


<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah dan Edit Akun</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group">
                <input type="number" id="no_akun" class="form-control" placeholder="No Akun" >                
            </div>
            
            <div class="form-group">
                <input type="text" id="nama_akun" class="form-control" placeholder="Nama Akun">
            </div>
            
            <div class="form-group">
                <select id="no_kategori">
                <?php foreach ($kategori as $kategoridata) { ?>
                <option value="<?php echo $kategoridata['no_kategori']; ?>"> <?php echo "".$kategoridata['no_kategori']." " .$kategoridata['nama_kategori']."";?></option>
                <?php }?>
                </select>
            </div>
            
            <div class="form-group">
                <button class="btn btn-success" onclick="add_akun()"><i class="fa fa-plus"></i> Tambah</button>
                <button class="btn btn-warning" onclick="update_akun()"><i class="fa fa-plus"></i> Edit</button>
            </div>
        </div>
        <!-- box body -->

    </div>
</div>
<!-- Box -->
<script>
    function delete_akun(no_akun) {
        $.post("delete_akun",{"no_akun":no_akun},function (response) {
        //location.reload()
        //alert(response)
        alertify.log("<i class='fa fa-remove'></i> Success Delete",function () {
                    
        })
        
    })
    }

//ambil no_akun
    function update(no_akun) {
        $('#no_akun').val(no_akun)
    }
//update akun ke database
    function update_akun() {
        var no_akun=$('#no_akun').val()
        var data={'nama_akun':$('#nama_akun').val(),
                'no_kategori':$('#no_kategori').val()}
        
        $.post("update_akun",{"no_akun":no_akun,"data":data},function () {
            alert("Berhasil Merubah")
            location.reload()
        })
    }

    function add_akun() {
        var data={'no_akun':$('#no_akun').val(),
                'nama_akun':$('#nama_akun').val(),
                'no_kategori':$('#no_kategori').val()}
                

        $.post("insert_akun",data,function (response) {
            location.reload()      
          alertify.log("<i class='fa fa-check'></i> Success Add",function () {
          })
        })
    }


</script>