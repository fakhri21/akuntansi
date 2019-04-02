<div class="col-md-8">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Data Kategori</h3>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table">
                <tbody>
                    <th>No Kategori</th>
                    <th>Nama Kategori</th>
                    <th>Nama pos</th>
                    <th style="width: 20%;">Action</th>
                </tbody>

                <?php foreach ($record as $recorddata) { ?>
                
                <tr>
                    <td><?php echo $recorddata['no_kategori']; ?></td>
                    <td><?php echo $recorddata['nama_kategori']; ?></td>
                    <td><?php echo $recorddata['nama_pos']; ?></td>
                    
                    <td>
                        <a class="btn btn-xs btn-warning" onclick="update_kategori()"><i class="fa fa-edit"></i> Edit</a>
                        <a class="btn btn-xs btn-danger" onclick="delete_kategori(<?php echo $recorddata['no_kategori']; ?>)"><i class="fa fa-remove"></i> Delete</a>
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
            <h3 class="box-title">Tambah Kategori</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group">
                <input type="number" id="no_kategori" class="form-control" placeholder="No Kategori" >
            </div>
            
            <div class="form-group">
                <input type="text" id="nama_kategori" class="form-control" placeholder="Nama Kategori">
            </div>
            
            <div class="form-group">
                <select id="no_pos">
                <?php foreach ($pos as $posdata) { ?>
                <option value="<?php echo $posdata['no_pos']; ?>"> <?php echo "".$posdata['no_pos']." " .$posdata['nama_pos']."";?></option>
                <?php }?>
                </select>
            </div>
            
            <div class="form-group">
                <button class="btn btn-success" onclick="add_kategori()"><i class="fa fa-plus"></i> Tambah</button>
            </div>
        </div>
        <!-- box body -->

    </div>
</div>
<!-- Box -->
<script>
    function delete_kategori(no_kategori) {
        $.post("delete_kategori",{"no_kategori":no_kategori},function (response) {
        //location.reload()
        //alert(response)
        alert("<i class='fa fa-remove'></i> Success Delete",function () {
        })
        location.reload()
        
    })
    }

    function update_kategori(no_kategori) {
        
        $.post("update_kategori",{"no_kategori":no_kategori},function () {
          alertify.log("<i class='fa fa-check'></i> Success Change",function () {
            location.reload()      
          })
        })
    }

    function add_kategori() {
        var data={'no_kategori':$('#no_kategori').val(),
                'nama_kategori':$('#nama_kategori').val(),
                'no_pos':$('#no_pos').val()}
                

        $.post("insert_kategori",{'data':data},function (response) {
                  
          alert("<i class='fa fa-check'></i> Success Add",function () {
          })
          location.reload()
        })
    }


</script>