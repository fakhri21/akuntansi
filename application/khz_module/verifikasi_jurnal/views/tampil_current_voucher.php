<?php
if ($detailvoucher) {
        $no=0;
?>
        <div class="modal-dialog modal-lg">
        <input type="hidden" id="uniqid" value="'.$uniqid.'" />
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><?php echo $detailvoucher[0]['id_voucherjurnal']; ?></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </div>
          <div class="modal-body">
            <div class="row">
            <div class="col-md-12">

            <table class="table">
              <thead>
                <tr>
                  <td style="width: 15px;">No.</td>
                  <td>Keterangan</td>
                  <td>Harga</td>
                  <td>Aksi</td>
                </tr>
              </thead>
              <tbody>;
            <?php
              foreach ($detailvoucher as $items) {
            ?>
              <tr>
              <td><?php echo ++$no;?></td>
              <td><?php echo $items['keterangan'];?></td>
              <td><?php echo abs($items['price']);?></td>
              <td><a href="<?php echo base_url('akuntansi/hapus_item/'.$items['id_session'].''); ?>"> Hapus </a></td>
              </tr>
            <?php  } ?>
              
              </tbody>
            </table>
          </div>

        </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="posting_jurnal()">Posting</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    <?php
      }
      else{
        ?> 
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tidak Ada Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Tidak ditemukan data</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    <?php  } ?>
?>