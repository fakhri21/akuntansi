    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akuntansi extends CI_Controller {

 

    public function __construct()

    {

        parent::__construct();
        $this->load->model(array('Model_Admin','Model_Akuntansi'));
        $this->load->library(array('session','konfigurasi', 'form_validation'));
        $this->load->library('datatables');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('exportexcel_helper');
        $this->load->vars(array('data_admin' => $this->data_admin));
        $user = wp_get_current_user();
         if ( !in_array( 'akunting', (array) $user->roles ) ) {
                
                redirect(base_url('denied'));
            }
         
    }
    

    public function index()
    {
         $user = wp_get_current_user();
         
        $this->template->load('template_admin','akuntansi_home');
    }
    
/* Umum */    
    public function list_coa($kondisi)
    {
        $daftar_coa=$this->Model_Akuntansi->list_coa($kondisi);
        echo json_encode($daftar_coa);

    }
    
    public function list_voucher($tipe)
    {
        $daftar_voucher=$this->Model_Akuntansi->list_voucher(0,$tipe);
        echo json_encode($daftar_voucher);
    }
    public function cart()
    {
        $data['itemcart']=$this->cart->contents();
        $itemcart = array( 'data' =>array_values($data['itemcart']));
        echo json_encode($itemcart);
    }
    public function hapusitemcart($rowid)
    {
        if($this->cart->remove($rowid))
        {
            echo "Berhasil Menghapus";
        }
    } 
    public function hapus_item($id)
    {
        if($this->Model_Akuntansi->hapus_item('detail_akuntansi_voucher',$id))
        {
            echo "Berhasil Menghapus";
            echo '<script>
                history.go(-1)
                </script>';
        }
    } 
    public function tampilcurrentvoucher($uniqid)
    {
        
        $data['detailvoucher']=$this->Model_Akuntansi->tampilvoucher($uniqid);
        
        $this->load->view('tampil_current_voucher', $data);
        

    }
    public function tampilvoucher($data)
    {
        
        $voucher='';
            
            $voucher.= '<table class="table">
              <thead>
                <tr>
                  <td style="width: 15px;">No.</td>
                  <td>Keterangan</td>
                  <td>Price</td>
                </tr>
              </thead>
              <tbody>';
              $no=0;
              foreach ($data as $items) {
             $voucher.=' 
              <tr>
              <td>'.++$no.'</td>
              <td>'.$items['keterangan'].'</td>
              <td>'.abs($items['price']).'</td>
              </tr>';
              }
              $voucher.='
              </tbody>
            </table>';
            
            return $voucher;
    }
        
    /* Cash and Bank */
    public function kasdanbank()
    {
        $status=$this->konfigurasi->priode_harian_akuntansi();
        if ($status=='') {
            $this->session->set_flashdata('message_failed', 'Buka Akuntansi terlebih dahulu');
            redirect('tutup_buku','refresh');
        }
        else
        {
        $this->cart->destroy();
        $this->template->load('template_admin','akuntansi_kasbank');
        }
    }
    public function tambahkasbank($kondisi)
    {
        
        if ($kondisi==0) {
            # In
            $record=array('id_coa' =>$_POST['id_coa'] ,
                        'debit'=>$_POST['nilai'],
                        'keterangan'=>$_POST['keterangan'] );
            $inversrecord=array('id_coa' =>$_POST['invid_coa'] ,
                        'kredit'=>$_POST['nilai'],
                        'keterangan'=>$_POST['keterangan'] );

        } else {
            # Out
            $record=array('id_coa' =>$_POST['id_coa'] ,
                        'kredit'=>$_POST['nilai'],
                        'keterangan'=>$_POST['keterangan'] );
            $inversrecord=array('id_coa' =>$_POST['invid_coa'] ,
                        'debit'=>$_POST['nilai'],
                        'keterangan'=>$_POST['keterangan'] );

        }
        
        $data = array(
            'id'      => uniqid(),
            'qty'     => 1,
            'price'   => $_POST['nilai'],
            'name'    => $_POST['keterangan'],
            'options' => array( 'record' => $record, 
                                'inversrecord' => $inversrecord)
        );
        
        $this->cart->insert($data);
    }
    function simpan_kasbank()
    {
        if (isset($_POST['uniqid'])) {
            $uniqid=$_POST['uniqid'];
        } else {
            $uniqid=uniqid("KB",TRUE);
            //Header
             $data = array('id_tipe_voucher' =>'KB' );
            $this->Model_Akuntansi->simpan_voucher('h_akuntansi_voucher',$data,$uniqid);
        }
        
        //Detail Voucher
        foreach ($this->cart->contents() as $items) {
            $this->Model_Akuntansi->detail_voucher('detail_akuntansi_voucher',$items['options']['record'],$uniqid,$items['rowid']);
            $this->Model_Akuntansi->detail_voucher('detail_akuntansi_voucher',$items['options']['inversrecord'],$uniqid,$items['rowid']);
        }
        $this->cart->destroy();
        echo base_url('akuntansi/print_voucher/'.$uniqid.'');   
        //$this->print_kasdanbank($uniqid);
    }
    function print_kasdanbank($uniqid)
    {
        $data_print = $this->Model_Akuntansi->tampilvoucher($uniqid);
        $data['title']='Struk';
        $data['record']=$data_print;
	
        if ($data) {
        //print_r($data_print);

        require_once("dompdf/dompdf_config.inc.php");
        $dompdf = new DOMPDF();

        //Load html view
	    $html=$this->load->view('akuntansi_voucher_detail', $data,TRUE);
        $dompdf->load_html($html);
	    $dompdf->set_paper('A4', 'potrait');
	    $dompdf->render();
	    $dompdf->stream('tes.pdf',array('Attachment' =>0));
        
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('akuntansi/verifikasi_jurnal'));
        }    
    }

/* Jurnal Umum */
    public function jurnalumum()
    {
        $status=$this->konfigurasi->priode_harian_akuntansi();
        if ($status=='') {
            $this->session->set_flashdata('message_failed', 'Buka Akuntansi terlebih dahulu');
            redirect('tutup_buku','refresh');
        }
        else
        {
        $this->cart->destroy();
        $this->template->load('template_admin','akuntansi_jurnalumum');
        }
    }

    public function tambahjurnalumum()
    {       $id_session=uniqid("",TRUE);     
            $record=array('id_coa' =>$_POST['id_coa'] ,
                        'debit'=>$_POST['nilai'],
                        'keterangan'=>$_POST['keterangan'] );
            $inversrecord=array('id_coa' =>$_POST['invid_coa'] ,
                        'kredit'=>$_POST['nilai'],
                        'keterangan'=>$_POST['keterangan'] );

        $data = array(
            'id'      => uniqid(),
            'qty'     => 1,
            'price'   => $_POST['nilai'],
            'name'    => $_POST['keterangan'],
            'options' => array( 'item' => $record,
                                'id_session'=>$id_session)
        );
        
        $data2 = array(
            'id'      => uniqid(),
            'qty'     => 1,
            'price'   => $_POST['nilai'],
            'name'    => $_POST['keterangan'],
            'options' => array( 'item' => $inversrecord,
                                'id_session'=>$id_session)
        );
        
        $this->cart->insert($data);
        $this->cart->insert($data2);

    }

    function simpan_jurnalumum()
    {
        
        if (isset($_POST['uniqid'])) {
            $uniqid=$_POST['uniqid'];
        } else {
            $uniqid=uniqid("JU",TRUE);
            //Header
             $data = array('id_tipe_voucher' =>'JU' );
            $this->Model_Akuntansi->simpan_voucher('h_akuntansi_voucher',$data,$uniqid);
        }
        
        //Detail Pemesanan
        foreach ($this->cart->contents() as $items) {
        $id_session=$items['options']['id_session'];
            $this->Model_Akuntansi->detail_voucher('detail_akuntansi_voucher',$items['options']['item'],$uniqid,$id_session);
        }
        
        $this->cart->destroy();

        echo base_url('akuntansi/print_voucher/'.$uniqid.'');   
        
    }

    function print_jurnalumum($uniqid)
    {
        $data_print = $this->Model_Akuntansi->tampilvoucher($uniqid);
        $data['title']='Struk';
        $data['record']=$data_print;
	
        if ($data) {
        //print_r($data_print);

        require_once("dompdf/dompdf_config.inc.php");
        $dompdf = new DOMPDF();

        //Load html view
	    $html=$this->load->view('akuntansi_voucher_detail', $data,TRUE);
        $dompdf->load_html($html);
	    $dompdf->set_paper('A4', 'potrait');
	    $dompdf->render();
	    $dompdf->stream('tes.pdf',array('Attachment' =>0));
        
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('akuntansi/verifikasi_jurnal'));
        }    
    }

/* Stock */
    function panel_stock()
    {
        $this->template->load('template_admin','stock/akuntansi_panel_stock');
    }
    function stock()
    {
        $this->cart->destroy();
        $this->template->load('template_admin','stock/akuntansi_stock');
    }
    function tambahitem()
    {
            $harga_kotor=$_POST['nilai'];
            $potongan=$harga_kotor*$_POST['diskon']/100;
            $nilai_pajak=$harga_kotor*$_POST['pajak']/100;
            $total_bersih=($harga_kotor+$nilai_pajak-$potongan)*$_POST['quantity'];

            $stock=array( 'id_coa_stock' =>$_POST['id_coa_stock'] ,
                        'debit_stock'=>$_POST['quantity'],
                        'harga_beli'=>$harga_kotor,
                        'persen_potongan'=>$_POST['diskon'],
                        'nilai_potongan'=>$potongan,
                        'persen_pajak'=>$_POST['pajak'],
                        'nilai_pajak'=>$nilai_pajak,
                        'total_nilai_stock'=>$total_bersih,
                        'satuan'=>$_POST['satuan'],
                        'keterangan'=>$_POST['keterangan'],
                        'id_jenis_pembayaran' =>$_POST['id_coa'],
                        'id_vendor'=>$_POST['vendor'] );
            
            $record=array('id_coa' =>$_POST['id_coa'] ,
                        'kredit'=>$total_bersih,
                        'keterangan'=>$_POST['keterangan'] );
            $inversrecord=array('id_coa' =>$_POST['id_coa_stock'] ,
                        'debit'=>$total_bersih,
                        'keterangan'=>$_POST['keterangan'] );

        $data = array(
            'id'      => uniqid(),
            'qty'     => $_POST['quantity'],
            'price'   => $harga_kotor,
            'name'    => $_POST['keterangan'],
            'options' => array( 'diskon'=>$_POST['diskon']."%",
                                'pajak'=>$_POST['pajak']."%",
                                'stock' => $stock,
                                'record'=>$record,
                                'inversrecord'=>$inversrecord)
        );
        
        $this->cart->insert($data);
        
    }
    function simpan_stock()
    {
        $uniqid=uniqid("ST",TRUE);
         //Header
         $data = array('id_tipe_voucher' =>'ST' );
        $this->Model_Akuntansi->simpan_voucher('h_akuntansi_voucher',$data,$uniqid);
        
        //Detail Voucher
        foreach ($this->cart->contents() as $items) {
            $this->Model_Akuntansi->detail_voucher('detail_akuntansi_voucher',$items['options']['record'],$uniqid,$items['rowid']);
            $this->Model_Akuntansi->detail_voucher('detail_akuntansi_voucher',$items['options']['inversrecord'],$uniqid,$items['rowid']);
            $this->Model_Akuntansi->detail_stock('detail_akuntansi_stock',$items['options']['stock'],$uniqid);
        }
        $this->cart->destroy();
        
        //redirect('akuntansi/print_kasdanbank/'.$uniqid.'');
        echo base_url('akuntansi/print_stock/'.$uniqid.'');
        //$this->print_kasdanbank();
    }
//Stock opname
    function stock_opname()
    {
        $this->cart->destroy();
        $this->template->load('template_admin','stock/akuntansi_stockopname');
    }
    function tambahitemopname()
    {
            
            $stock=array('saldo_quantity_akhir'=>$_POST['quantity'],
                        'id_coa_stock' =>$_POST['id_coa_stock'] ,
                        //'harga_beli'=>$harga_kotor,
                        //'persen_potongan'=>$_POST['diskon'],
                        //'nilai_potongan'=>$potongan,
                        //'persen_pajak'=>$_POST['pajak'],
                        //'nilai_pajak'=>$nilai_pajak,
                        //'total_nilai_stock'=>$total_bersih,
                        //'satuan'=>$_POST['satuan'],
                        'keterangan'=>$_POST['keterangan'],
                        'id_jenis_pembayaran' =>$_POST['id_coa_hpp'],
                        //'id_vendor'=>$_POST['vendor'] 
                         );
            
            $record=array('id_coa' =>$_POST['id_coa_stock'] ,
                        'keterangan'=>$_POST['keterangan'] );
            $inversrecord=array('id_coa' =>$_POST['id_coa_hpp'] ,
                        'keterangan'=>$_POST['keterangan'] ); 

        $data = array(
            'id'      => uniqid(),
            'qty'     => $_POST['quantity'],
            'price'   => 1,
            'name'    => $_POST['keterangan'],
            'options' => array( //'diskon'=>$_POST['diskon']."%",
                                //'pajak'=>$_POST['pajak']."%",
                                'stock' => $stock,
                                'record'=>$record,
                                'inversrecord'=>$inversrecord
                                )
        );
        
        $this->cart->insert($data);
        
    }
    function simpan_stockopname()
    {
        $uniqid=uniqid("SO",TRUE);
         //Header
         $data = array('id_tipe_voucher' =>'SO',
                        'status'=>1, );
        $this->Model_Akuntansi->simpan_voucher('h_akuntansi_voucher',$data,$uniqid);
        
        //Detail Voucher
        foreach ($this->cart->contents() as $items) {
           $feedback= $this->Model_Akuntansi->stockopname('detail_akuntansi_voucher','detail_akuntansi_stock',$items['options'],$uniqid);
            print_r($feedback);
        }
        $this->cart->destroy();
    }
    function print_stock($uniqid)
    {
        $data_print = $this->Model_Akuntansi->tampilstock($uniqid);
        $data['title']='Struk';
        $data['record']=$data_print;
	
        if ($data) {
        //print_r($data_print);

        require_once("dompdf/dompdf_config.inc.php");
        $dompdf = new DOMPDF();

        //Load html view
	    $html=$this->load->view('stock/akuntansi_stock_detail', $data,TRUE);
        $dompdf->load_html($html);
	    $dompdf->set_paper('A4', 'potrait');
	    $dompdf->render();
	    $dompdf->stream('tes.pdf',array('Attachment' =>0));
         
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('akuntansi/verifikasi_jurnal'));
        }
    }
//Laporan stock
    public function laporanstock()
    {
      
       // $data['record']=$this->Model_Akuntansi->laporanstock($hari,$hari_akhir);
        $this->template->load('template_admin','stock/akuntansi_laporan_stock');
    }
    function stock_sub()
    {
        $stockopname=$_POST['status'];
        $hari=0;
        $hari_akhir=0;
        $data['hari']=0;
        $data['hari_akhir']=0;
        if ($_POST['hari'] && $_POST['hari_akhir']) {
            //$hari= stripslashes("\'".date_format(date_create($_POST['hari']),"Y-m-d")."\'");
            //$hari_akhir= stripslashes("\'".date_format(date_create($_POST['hari_akhir']),"Y-m-d")."\'");
            $hari= get_gmt_from_date($_POST['hari']);
            $hari_akhir= get_gmt_from_date($_POST['hari_akhir']);

            $data['hari']=$_POST['hari'];
            $data['hari_akhir']=$_POST['hari_akhir'];
        }
            $coa_stock= $_POST['coa'];

        if ($stockopname==1) {
            $data['record']=$this->Model_Akuntansi->laporan_stockopname($hari,$hari_akhir);
            $html=$this->load->view('stock/akuntansi_stock_sub_opname',$data,TRUE);
        }
        else {
            $data['record']=$this->Model_Akuntansi->substock($hari,$hari_akhir,$coa_stock);
            $html=$this->load->view('stock/akuntansi_stock_sub',$data,TRUE);
        }

        //print_r($data['record']);
          require_once("dompdf/dompdf_config.inc.php");
         $dompdf = new DOMPDF();
        //Load html view
	    $dompdf->load_html($html);
	    $dompdf->set_paper('A4', 'landscape');
	    $dompdf->render();
	    $dompdf->stream('tes.pdf',array('Attachment' =>0)); 
           
    }

    function excel_stock_sub()
    {
        $stockopname=$_POST['status'];
        $hari=0;
        $hari_akhir=0;
        $data['hari']=0;
        $data['hari_akhir']=0;
        if ($_POST['hari'] && $_POST['hari_akhir']) {
            //$hari= stripslashes("\'".date_format(date_create($_POST['hari']),"Y-m-d")."\'");
            //$hari_akhir= stripslashes("\'".date_format(date_create($_POST['hari_akhir']),"Y-m-d")."\'");
            $hari= stripslashes("\'".get_gmt_from_date($_POST['hari'])."\'");
            $hari_akhir= stripslashes("\'".get_gmt_from_date($_POST['hari_akhir'])."\'");

            $data['hari']=$_POST['hari'];
            $data['hari_akhir']=$_POST['hari_akhir'];
        }
            $coa_stock= $_POST['coa'];

        if ($stockopname==1) {
            $data['record']=$this->Model_Akuntansi->laporan_stockopname($hari,$hari_akhir);
            $html=$this->load->view('stock/akuntansi_stock_sub_opname',$data,TRUE);
        }
        else {
            $data['record']=$this->Model_Akuntansi->substock($hari,$hari_akhir,$coa_stock);
            $html=$this->load->view('stock/akuntansi_stock_sub',$data,TRUE);
        }

        //print_r($data['record']);
         require_once("dompdf/dompdf_config.inc.php");
         $dompdf = new DOMPDF();
        //Load html view
	    $dompdf->load_html($html);
	    $dompdf->set_paper('A4', 'landscape');
	    $dompdf->render();
	    $dompdf->stream('tes.pdf',array('Attachment' =>0)); 
          
    }

/* Verifikasi Jurnal */
    public function jsondaftarjurnal()
    {
        header('Content-Type: application/json');
        echo $this->Model_Akuntansi->jsondaftarjurnal();
    }
    public function verifikasi_jurnal()
    {
       $this->template->load('template_admin','akuntansi_voucher_list');
    }
    public function ubahstatus($uniqid,$status)
    {
        $data = array('status' =>$status , );

        $this->Model_Akuntansi->ubahstatus($uniqid,$data);        
        redirect(base_url('akuntansi/verifikasi_jurnal'),'refresh');
     
    }
    public function detail_voucher($uniqid) 
    {
        $data_record = $this->Model_Akuntansi->tampilvoucher($uniqid);
        $data['title']='Struk';
        $data['record']=$data_record;
	
        if ($data) {
        //print_r($data_print);

        //Load html view
	    $html=$this->template->load('template_admin','akuntansi_voucher_detail', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('akuntansi/verifikasi_jurnal'));
        }
    }
    public function print_voucher($uniqid) 
    {
        $data_print = $this->Model_Akuntansi->tampilvoucher($uniqid);
        $data['title']='Struk';
        $data['record']=$data_print;
	
        if ($data) {
        //print_r($data_print);

        require_once("dompdf/dompdf_config.inc.php");
        $dompdf = new DOMPDF();

        //Load html view
	    $html=$this->load->view('akuntansi_voucher_detail', $data,TRUE);
        $dompdf->load_html($html);
	    $dompdf->set_paper('A4', 'potrait');
	    $dompdf->render();
	    $dompdf->stream('tes.pdf',array('Attachment' =>0));
        
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('akuntansi/verifikasi_jurnal'));
        }
    }

    /* Laporan Jurnal buku besar */
    public function panel_laporan_jurnal_buku_besar()
    {
        $this->template->load('template_admin','laporan_jurnal_buku_besar/akuntansi_laporan_jurnal_buku_besar');
    }

    //Laporan Jurnal
    public function laporanjurnal()
    {
        $status=$_POST['status'];
        $hari=NULL;
        $hari_akhir=NULL;
        if ($_POST['hari'] && $_POST['hari_akhir']) {
            $hari= stripslashes("\'".get_gmt_from_date($_POST['hari'])."\'");
            $hari_akhir= stripslashes("\'".get_gmt_from_date($_POST['hari_akhir'])."\'");
            $data['hari'] = $_POST['hari'] .' s/d '.$_POST['hari_akhir'];
        }

        $data['record']=$this->Model_Akuntansi->laporanjurnal($hari,$hari_akhir);
        
        if (!$data['record']) {
                $this->session->set_flashdata('message_failed', 'Data Tidak Ditemukan');
                redirect(base_url('akuntansi/panel_laporan_jurnal_buku_besar'),'refresh');
                
        }

        if ($status=='pdf') {
            require_once("dompdf/dompdf_config.inc.php");
            $dompdf = new DOMPDF();
            //Load html view
            $html=$this->load->view('laporan_jurnal_buku_besar/akuntansi_laporan_jurnal',$data,TRUE);
            $dompdf->load_html($html);
            $dompdf->set_paper('A4', 'potrait');
            $dompdf->render();
            $dompdf->stream('tes.pdf',array('Attachment' =>0));
        }
        else {
                $namaFile = "Laporan_Jurnal.xls";
                $judul = "Laporan Jurnal";
                $tablehead = 4;
                $tablebody = $tablehead+1;
                $nourut = 1;
               
                    //penulisan header
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");
                header("Content-Disposition: attachment;filename=" . $namaFile . "");
                header("Content-Transfer-Encoding: binary ");

                xlsBOF();
                xlsWriteLabel(0, 0, "Laporan Jurnal");
                //xlsWriteLabel(1, 0, "Periode ".$hari."");

                $kolomhead = 0;

                xlsWriteLabel($tablehead, $kolomhead++, "Waktu");
                xlsWriteLabel($tablehead, $kolomhead++, "Id COA");
                xlsWriteLabel($tablehead, $kolomhead++, "COA");
                xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
                xlsWriteLabel($tablehead, $kolomhead++, "Id Jurnal");
                xlsWriteLabel($tablehead, $kolomhead++, "Debit");
                xlsWriteLabel($tablehead, $kolomhead++, "Kredit");
                
                $gt_tabelbody=0;
                $gt_kolombody=0;

                foreach ($data['record'] as $recorddata)//$this->Model_Admin->laporan_excel_penjualan($w_awal,$w_akhir) as $record) {
                {

                    $kolombody = 0;
                    
                    //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                    
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['waktu']);
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['id_coa']);
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['nama_coa']);
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['keterangan']);
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['id_row']);
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['debit']);
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['kredit']);
                $tablebody++;
                    
                     $kolombody = 0;

                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['waktu']);
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['inversid_coa']);
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['inversnama_coa']);
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['keterangan']);
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['id_row']);
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['invers_debit']);
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['invers_kredit']);
                $tablebody++; 
                }
                xlsEOF();
                exit();

        }
        
    }
    
    //Buku besar
    public function buku_besar()
    {
        $hari=NULL;
        $hari_akhir=NULL;
        $coa=NULL;
        $status=$_POST['status'];
        if ($_POST['hari'] && $_POST['hari_akhir']) {
            $hari= stripslashes("\'".get_gmt_from_date($_POST['hari'])."\'");
            $hari_akhir= stripslashes("\'".get_gmt_from_date($_POST['hari_akhir'])."\'");
            $data['hari'] = $_POST['hari'] .' s/d '.$_POST['hari_akhir'];
        }
            $coa=$_POST['coa'];

        $data['record']=$this->Model_Akuntansi->buku_besar($coa,$hari,$hari_akhir);
        
        if (!$data['record']) {
                $this->session->set_flashdata('message_failed', 'Data Tidak Ditemukan');
                redirect(base_url('akuntansi/panel_laporan_jurnal_buku_besar'),'refresh');
                
        }
            
        
        if ($status=='pdf') {
            require_once("dompdf/dompdf_config.inc.php");
            $dompdf = new DOMPDF();
            //Load html view
            $html=$this->load->view('laporan_jurnal_buku_besar/akuntansi_buku_besar',$data,TRUE);
            $dompdf->load_html($html);
            $dompdf->set_paper('A4', 'potrait');
            $dompdf->render();
            $dompdf->stream('tes.pdf',array('Attachment' =>0));
        }
        else {
                $namaFile = "Buku_besar.xls";
                $judul = "Buku Besar";
                $tablehead = 4;
                $tablebody = $tablehead+1;
                $nourut = 1;
               
                    //penulisan header
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");
                header("Content-Disposition: attachment;filename=" . $namaFile . "");
                header("Content-Transfer-Encoding: binary ");

                xlsBOF();
                xlsWriteLabel(0, 0, "Laporan Jurnal");
                xlsWriteLabel(1, 0, "Periode ".$data['hari']."");
                xlsWriteLabel(2, 0, "Coa ".$data['record'][0]['id_coa']." ".$data['record'][0]['nama_coa']."");
                xlsWriteLabel(2, 1, "".$data['record'][0]['id_coa']." ".$data['record'][0]['nama_coa']."");

                $kolomhead = 0;

                xlsWriteLabel($tablehead, $kolomhead++, "Waktu");
                xlsWriteLabel($tablehead, $kolomhead++, "Id jurnal");
                xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
                xlsWriteLabel($tablehead, $kolomhead++, "Debit");
                xlsWriteLabel($tablehead, $kolomhead++, "Kredit");
                xlsWriteLabel($tablehead, $kolomhead++, "Saldo");
                
                $gt_tabelbody=0;
                $gt_kolombody=0;
                $kolombody = 0;
                
                $total_kredit=0;
                $total_debit=0;
                $total_saldo=0;

                 $kolombody++;
                 $kolombody++;
                xlsWriteLabel($tablebody, $kolombody++,'Saldo Awal');
                 $kolombody++;
                 $kolombody++;
                            
                xlsWriteLabel($tablebody, $kolombody++,$data['record'][0]['saldo_awal_ok']);
                $tablebody++;
                
                foreach ($data['record'] as $recorddata)//$this->Model_Admin->laporan_excel_penjualan($w_awal,$w_akhir) as $record) {
                {

                    $kolombody = 0;
                    
                    $total_saldo=$recorddata['saldo'];
                    $total_kredit=$total_kredit+$recorddata['kredit'];
                    $total_debit=$total_debit+$recorddata['debit'];
                    
                    //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                    
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['waktu']);
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['id_detail']);
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['keterangan']);
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['debit']);
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['kredit']);
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['saldo']);
                    $tablebody++;
                }
                    $kolombody = 0;
                    xlsWriteLabel($tablebody, $kolombody++,'Total');
                    xlsWriteLabel($tablebody, $kolombody++,'');
                    xlsWriteLabel($tablebody, $kolombody++,'');
                    xlsWriteLabel($tablebody, $kolombody++,$total_debit);
                    xlsWriteLabel($tablebody, $kolombody++,$total_kredit);
                    xlsWriteLabel($tablebody, $kolombody++,$total_saldo);

                xlsEOF();
                exit();
        }
    }


    /* Laporan Keuangan */
    public function panel_laporan_keuangan()
    {
        $this->template->load('template_admin','laporan_keuangan/akuntansi_laporan_keuangan');
    }

    public function laporan_keuangan($bentuk='neraca')
    {
        $hari=NULL;
        $model=NULL;
        
        if ($_POST) {
               $hari= stripslashes("\'".get_gmt_from_date($_POST['hari'])."\'");
               $model=$_POST['model'];
        }
        // echo "<pre>";


        if ($bentuk=='neraca') {
   
            $data['isi']=$this->tampil_neraca($hari,$model);

        }
        elseif ($bentuk=='trial_balance') {
            $data['isi']=$this->tampil_trial_balance($hari);
        }
        else {
        //Laba Rugi
            $data['isi']=$this->tampil_laba_rugi($hari,$model);
        }
        
             if (!$data['isi']) {
                $this->session->set_flashdata('message_failed', 'Data Tidak Ditemukan');
                redirect(base_url('akuntansi/panel_laporan_keuangan'),'refresh');
            }
 
            $data['hari']=$_POST['hari'];
            
            require_once("dompdf/dompdf_config.inc.php");
            $dompdf = new DOMPDF();
            //Load html view
            $html=$this->load->view('laporan_keuangan/akuntansi_'.$bentuk.'',$data,TRUE);
            $dompdf->load_html($html);
            $dompdf->set_paper('A4', 'potrait');
            $dompdf->render();
            $dompdf->stream('tes.pdf',array('Attachment' =>0));
    }

    public function tampil_trial_balance($hari)
    {
        $record['isi']=$this->Model_Akuntansi->trial_balance($hari);
        
        $nilai_aktiva=0;
        $nilai_pasiva=0;

        $isi_html='';
                        
                            /* <!-- Kategori --> */
            			foreach ($record['isi'] as $data) { 
                        
        $isi_html.=
                        '   <tr>
                       			<td width="280px" id="akun" style="padding-left: 30px;">'.$data['id_nama_coa'].' </td>
								<td width="150px" id="v_kas">Rp.'.number_format($data['saldo_debit']).'</th>
								<td width="150px" id="v_kas">Rp.'.number_format($data['saldo_kredit']).'</th>
                            </tr> ';
                         }    

    
    if ($record) {
            return $isi_html;
        
        }
        else {
            return FALSE;
        }
    
    }

    public function tampil_neraca($hari,$model)
    {
        if ($model=='kelompok') {
            $record['aktiva']=$this->Model_Akuntansi->neraca_kelompok($hari);
            $record['pasiva']=$this->Model_Akuntansi->neraca_kelompok($hari,'<>1');
        } else {
            $record['aktiva']=$this->Model_Akuntansi->neraca($hari);
            $record['pasiva']=$this->Model_Akuntansi->neraca($hari,'<>1');
        }
        
       
       if ($record) {
            return $record;
        
        }
        else {
            return FALSE;
        }
    
    }

    public function tampil_laba_rugi($hari,$model) 
    {
         if ($model=='kelompok') {
            
            $record['pendapatan']=$this->Model_Akuntansi->labarugi_kelompok($hari,'4010000');
            $record['hpp']=$this->Model_Akuntansi->labarugi_kelompok($hari,'5000000');
            $record['biaya_adm']=$this->Model_Akuntansi->labarugi_kelompok($hari,'6000000');
            $record['biaya_penyusutan']=$this->Model_Akuntansi->labarugi_kelompok($hari,'7000000');
            $record['biaya_pajak']=$this->Model_Akuntansi->labarugi_kelompok($hari,'8010000');
         
         } else {
            $record['pendapatan']=$this->Model_Akuntansi->labarugi($hari,'4010000');
            $record['hpp']=$this->Model_Akuntansi->labarugi($hari,'5000000');
            $record['biaya_adm']=$this->Model_Akuntansi->labarugi($hari,'6000000');
            $record['biaya_penyusutan']=$this->Model_Akuntansi->labarugi($hari,'7000000');
            $record['biaya_pajak']=$this->Model_Akuntansi->labarugi($hari,'8010000');
         }
         
                        $pendapatan=0;
                        $pendapatan_sebelumnya=0;
                        
                        $biaya_adm=0;
                        $biaya_adm_sebelumnya=0;
                        
                        $hpp=0;
                        $hpp_sebelumnya=0;
                        
                        $biaya_penyusutan=0;
                        $biaya_penyusutan_sebelumnya=0;
                        
                        $biaya_pajak=0;
                        $biaya_pajak_sebelumnya=0;

                        $laba_penjualan=0;
                        $laba_penjualan_sebelumnya=0;
            
                        $laba_operasional=0;
                        $laba_operasional_sebelumnya=0;
                        $laba_sebelum_pajak=0;
                        $laba_sebelum_pajak_sebelumnya=0;
        $isi_html='';
        $isi_html.='    			   ';
                            if ($record['pendapatan']) {
        $isi_html.= '
                           <tr>
                                <td id="kategori" class="bg-light-blue text-center" colspan="4"><b>'.$record['pendapatan'][0]['nama_kategori'].'</b> </td>
                           </tr>';
                            foreach ($record['pendapatan'] as $data) {
        $isi_html.='                     
                            <tr>
								<td width="280px" id="akun" style="padding-left: 30px;"> '.$data['id_nama_coa'].' </td>
                                <td width="100px" id="b_akun">Rp.'.number_format($data['total_saldo_sebelumnya']).' </td>
                                <td width="100px" id="b_akun">Rp.'.number_format($data['total_saldo']).' </td>
                                <td width="100px" id="b_akun">Rp.'.number_format($data['total_saldo_berjalan']).' </td>
                            </tr>';
                            $pendapatan=$data['total_saldo']; 
                            $pendapatan_sebelumnya=$data['total_saldo_sebelumnya']; }
                            }
                           
                            if ($record['hpp']) { 
        $isi_html.='                    
                            <tr>
                                <td id="kategori" class="bg-light-blue text-center" colspan="4"><b>'.$record['hpp'][0]['nama_kategori'].'</b> </td>
                            </tr>';
                            
                            foreach ($record['hpp'] as $data) {
        $isi_html.='
                            <tr>
								<td width="280px" id="akun" style="padding-left: 30px;"> '.$data['id_nama_coa'].' </td>
                                <td width="100px" id="b_akun">Rp.'.number_format(abs($data['total_saldo_sebelumnya'])).' </td>
                                <td width="100px" id="b_akun">Rp.'.number_format(abs($data['total_saldo'])).' </td>
                                <td width="100px" id="b_akun">Rp.'.number_format(abs($data['total_saldo_berjalan'])).' </td>
                            </tr>';

                            $hpp=$data['total_saldo']; 
                            $hpp_sebelumnya=$data['total_saldo_sebelumnya']; }
                            }
        $isi_html.='                            
                                    <tr>
                                    <th width="280px">Total Laba Kotor</th>
                                    <th width="100px">Rp.'.number_format($laba_penjualan_sebelumnya=$pendapatan_sebelumnya+$hpp_sebelumnya,2).'</th>
                                    <th width="100px">Rp.'.number_format($laba_penjualan=$pendapatan+$hpp,2) .'</th>
                                    <th width="100px">Rp.'.number_format($laba_penjualan+$laba_penjualan_sebelumnya,2) .'</th>
                                    </tr>';
                            /* <!-- Laba kotor --> */        
                            
                            if ($record['biaya_adm']) {
        $isi_html.='
                            <tr>
                                <td id="kategori" class="bg-light-blue text-center" colspan="4"><b>'.$record['biaya_adm'][0]['nama_kategori'].'</b> </td>
                            </tr>';
                            foreach ($record['biaya_adm'] as $data) { 
        $isi_html.='
                            <tr>
                               <td width="280px" id="akun" style="padding-left: 30px;">'.$data['id_nama_coa'].' </td>
                                <td width="100px" id="b_akun">Rp.'.number_format(abs($data['total_saldo_sebelumnya'])).' </td>
                                <td width="100px" id="b_akun">Rp.'.number_format(abs($data['total_saldo'])).' </td>
                                <td width="100px" id="b_akun">Rp.'.number_format(abs($data['total_saldo_berjalan'])).' </td>
                            </tr>';
                            $biaya_adm=$data['total_saldo']; $biaya_adm_sebelumnya=$data['total_saldo_sebelumnya']; } }
        $isi_html.='
                                <tr>
                                <th width="280px">Total Laba Operasional</th>
                                <th width="100px">Rp.'.number_format($laba_operasional_sebelumnya=$laba_penjualan_sebelumnya+$biaya_adm_sebelumnya,2).'</th>
                                <th width="100px">Rp.'.number_format($laba_operasional=$laba_penjualan+$biaya_adm,2).'</th>
                                <th width="100px">Rp.'.number_format($laba_operasional+$laba_operasional_sebelumnya,2).'</th>
                                </tr>';
                            
                            if ($record['biaya_penyusutan']) {
        $isi_html.= '
                            <tr>
                                <td id="kategori" class="bg-light-blue text-center" colspan="4"><b>'.$record['biaya_penyusutan'][0]['nama_kategori'].'</b> </td>
                            </tr>';
                            foreach ($record['biaya_penyusutan'] as $data) { 

        $isi_html.='
                            <tr>
                                <td width="280px" id="akun" style="padding-left: 30px;"> '.$data['id_nama_coa'].' </td>
                                <td width="100px" id="b_akun"> Rp.'.number_format(abs($data['total_saldo_sebelumnya'])).' </td>
                                <td width="100px" id="b_akun"> Rp.'.number_format(abs($data['total_saldo'])).' </td>
                                <td width="100px" id="b_akun"> Rp.'.number_format(abs($data['total_saldo_berjalan'])).' </td>
                            </tr>';
                            
                            $biaya_penyusutan=$data['total_saldo'];  $biaya_penyusutan_sebelumnya=$data['total_saldo_sebelumnya'];} }
        $isi_html.='                    
                            <tr>
                            <th width="280px">Total Laba Sebelum Pajak</th>
                            <th width="100px">Rp.'.number_format($laba_sebelum_pajak_sebelumnya=$laba_operasional_sebelumnya+$biaya_penyusutan_sebelumnya,2) .'</th>
                            <th width="100px">Rp.'.number_format($laba_sebelum_pajak=$laba_operasional+$biaya_penyusutan,2) .'</th>
                            <th width="100px">Rp.'.number_format($laba_sebelum_pajak_sebelumnya+$laba_sebelum_pajak,2) .'</th>
                            </tr>
                       
        ';
        if ($record['biaya_pajak']) {
        $isi_html.= '
                            <tr>
                                <td id="kategori" class="bg-light-blue text-center" colspan="4"><b>'.$record['biaya_pajak'][0]['nama_kategori'].'</b> </td>
                            </tr>';
                            foreach ($record['biaya_pajak'] as $data) { 

        $isi_html.='
                            <tr>
                                <td width="280px" id="akun" style="padding-left: 30px;"> '.$data['id_nama_coa'].' </td>
                                <td width="100px" id="b_akun"> Rp.'.number_format(abs($data['total_saldo_sebelumnya'])).' </td>
                                <td width="100px" id="b_akun"> Rp.'.number_format(abs($data['total_saldo'])).' </td>
                                <td width="100px" id="b_akun"> Rp.'.number_format(abs($data['total_saldo_berjalan'])).' </td>
                            </tr>';
                            
                            $biaya_pajak=$data['total_saldo'];  $biaya_pajak_sebelumnya=$data['total_saldo_sebelumnya'];}     
        $isi_html.='                    
                            <tr>
                            <th width="280px">Total Laba Sesudah Pajak</th>
                            <th width="100px">Rp.'.number_format($laba_sesudah_pajak_sebelumnya=$laba_sebelum_pajak+$biaya_pajak_sebelumnya,2) .'</th>
                            <th width="100px">Rp.'.number_format($laba_sesudah_pajak=$laba_sebelum_pajak+$biaya_pajak ,2) .'</th>
                            <th width="100px">Rp.'.number_format($laba_sesudah_pajak_sebelumnya+$laba_sesudah_pajak,2) .'</th>
                            </tr>               
        ';
        
        }

        if ($record) {
            return $isi_html;
        
        }
        else {
            return FALSE;
        }
    }

    public function excel_laporan_keuangan($bentuk='neraca')
    {
        $hari=NULL;
        
        if ($_POST) {
               $hari= stripslashes("\'".date_format(date_create($_POST['hari']),"Y-m-d")."\'");
            
        }

        if ($bentuk=='neraca') {
        //Neraca
        
            $data['record']['aktiva']=$this->Model_Akuntansi->neraca($hari);
            $data['record']['pasiva']=$this->Model_Akuntansi->neraca($hari,'<>1');
            
                $namaFile = "Laporan_neraca.xls";
                $judul = "Laporan Neraca";
                $tablehead = 4;
                $tablebody = $tablehead+1;
                $nourut = 1;
                
                //penulisan header
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");
                header("Content-Disposition: attachment;filename=".$namaFile ."");
                header("Content-Transfer-Encoding: binary ");

                xlsBOF();
                xlsWriteLabel(0, 0, "Laporan Neraca");
                xlsWriteLabel(1, 0, "Periode ".$_POST['hari']."");

                $kolomhead = 0;
                xlsWriteLabel($tablehead, $kolomhead++, "Deskripsi");
                xlsWriteLabel($tablehead, $kolomhead++, " ");
                xlsWriteLabel($tablehead, $kolomhead++, "Bulan Sebelumnya");
                xlsWriteLabel($tablehead, $kolomhead++, $_POST['hari']);
                xlsWriteLabel($tablehead, $kolomhead++, "Berjalan");
                

                foreach ($data['record']['aktiva'] as $record)//$this->Model_Admin->laporan_excel_penjualan($w_awal,$w_akhir) as $record) {
                {

                    $kolombody = 0;
                    
                    //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                    
                    xlsWriteLabel($tablebody, $kolombody++,$record['nama_kategori']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['id_nama_coa']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_sebelumnya']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_berjalan']);
                      
                $tablebody++;
                
                }

                foreach ($data['record']['pasiva'] as $record)//$this->Model_Admin->laporan_excel_penjualan($w_awal,$w_akhir) as $record) {
                {

                    $kolombody = 0;
                    
                    //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                    
                    xlsWriteLabel($tablebody, $kolombody++,$record['nama_kategori']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['id_nama_coa']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_sebelumnya']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_berjalan']);
                      
                $tablebody++;
                
                }   
                xlsEOF();
                exit();

        }
        else {
        //Laba Rugi
            $namaFile = "Laporan_laba_rugi.xls";
            $judul = "Laporan laba rugi";
       
            $data['record']['pendapatan']=$this->Model_Akuntansi->labarugi($hari,40);
            $data['record']['hpp']=$this->Model_Akuntansi->labarugi($hari,60);
            $data['record']['biaya_adm']=$this->Model_Akuntansi->labarugi($hari,51);
            $data['record']['biaya_penyusutan']=$this->Model_Akuntansi->labarugi($hari,52);

                $tablehead = 4;
                $tablebody = $tablehead+1;
                $nourut = 1;
                
                //penulisan header
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");
                header("Content-Disposition: attachment;filename=" . $namaFile . "");
                header("Content-Transfer-Encoding: binary ");

                xlsBOF();
                xlsWriteLabel(0, 0, "Laporan Laba rugi");
                xlsWriteLabel(1, 0, "Periode ".$_POST['hari']."");

                $kolomhead = 0;
                xlsWriteLabel($tablehead, $kolomhead++, "Deskripsi");
                $kolomhead++;
                xlsWriteLabel($tablehead, $kolomhead++, "Bulan Sebelumnya");
                xlsWriteLabel($tablehead, $kolomhead++, $_POST['hari']);
                xlsWriteLabel($tablehead, $kolomhead++, "Berjalan");

                
                        $pendapatan=0;
                        $pendapatan_sebelumnya=0;
                        $hpp=0;
                        $hpp_sebelumnya=0;
                        
                        $biaya_adm=0;
                        $biaya_adm_sebelumnya=0;
                        $biaya_penyusutan=0;
                        $biaya_penyusutan_sebelumnya=0;

                        $laba_kotor=0;
                        $laba_kotor_sebelumnya=0;
                        $laba_operasional=0;
                        $laba_operasional_sebelumnya=0;
                        $laba_sebelum_pajak=0;
                        $laba_sebelum_pajak_sebelumnya=0;

                foreach ($data['record']['pendapatan'] as $record)//$this->Model_Admin->laporan_excel_penjualan($w_awal,$w_akhir) as $record) {
                {

                    $kolombody = 0;
                    $pendapatan=$record['total_saldo'];
                    $pendapatan_sebelumnya=$record['total_saldo_sebelumnya'];

                    //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                    
                    xlsWriteLabel($tablebody, $kolombody++,$record['nama_kategori']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['id_nama_coa']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_sebelumnya']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_berjalan']);
                      
                $tablebody++;
                
                }

                foreach ($data['record']['hpp'] as $record)//$this->Model_Admin->laporan_excel_penjualan($w_awal,$w_akhir) as $record) {
                {

                    $kolombody = 0;
                    $hpp=$record['total_saldo'];
                    $hpp_sebelumnya=$record['total_saldo_sebelumnya'];

                    //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                    
                    xlsWriteLabel($tablebody, $kolombody++,$record['nama_kategori']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['id_nama_coa']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_sebelumnya']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_berjalan']);
                      
                $tablebody++;
                
                }

                    $kolombody = 1;
                    xlsWriteLabel($tablebody,  $kolombody++, 'Laba Kotor');
                    xlsWriteNumber($tablebody, $kolombody++, $laba_kotor_sebelumnya=$pendapatan_sebelumnya+$hpp_sebelumnya);
                    xlsWriteNumber($tablebody, $kolombody++, $laba_kotor=$pendapatan+$hpp);
                    xlsWriteNumber($tablebody, $kolombody++, $laba_kotor+$laba_kotor_sebelumnya);
                    $tablebody++;
                

                /* Akhir Laba Kotor */
    
                foreach ($data['record']['biaya_adm'] as $record)//$this->Model_Admin->laporan_excel_penjualan($w_awal,$w_akhir) as $record) {
                {

                    $kolombody = 0;
                    $biaya_adm=$record['total_saldo'];
                    $biaya_adm_sebelumnya=$record['total_saldo_sebelumnya'];

                    //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                    
                    xlsWriteLabel($tablebody, $kolombody++,$record['nama_kategori']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['id_nama_coa']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_sebelumnya']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_berjalan']);
                    $tablebody++;
                }

                    $kolombody = 1;
                    xlsWriteLabel($tablebody,  $kolombody++, 'Laba Operasional');
                    xlsWriteNumber($tablebody, $kolombody++, $laba_operasional_sebelumnya=$laba_kotor_sebelumnya+$biaya_adm_sebelumnya);
                    xlsWriteNumber($tablebody, $kolombody++, $laba_operasional=$laba_kotor+$biaya_adm);
                    xlsWriteNumber($tablebody, $kolombody++, $laba_operasional+$laba_operasional_sebelumnya);
                    $tablebody++;
                
            
            /* Akhir Laba Operasional  */
            
                foreach ($data['record']['biaya_penyusutan'] as $record)//$this->Model_Admin->laporan_excel_penjualan($w_awal,$w_akhir) as $record) {
                {

                    $kolombody = 0;
                    $biaya_penyusutan=$record['total_saldo'];
                    $biaya_penyusutan_sebelumnya=$record['total_saldo_sebelumnya'];

                    //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                    
                    xlsWriteLabel($tablebody, $kolombody++,$record['nama_kategori']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['id_nama_coa']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_sebelumnya']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_berjalan']);
                      
                $tablebody++;
                
                }

                    $kolombody = 1;
                    xlsWriteLabel($tablebody, $kolombody++, 'Laba Sebelum Pajak');
                    xlsWriteNumber($tablebody, $kolombody++, $laba_sebelum_pajak_sebelumnya=$laba_operasional_sebelumnya+$biaya_penyusutan_sebelumnya);
                    xlsWriteNumber($tablebody, $kolombody++, $laba_sebelum_pajak=$laba_operasional+$biaya_penyusutan);
                    xlsWriteNumber($tablebody, $kolombody++, $laba_sebelum_pajak+$laba_sebelum_pajak_sebelumnya);
                    $tablebody++;
                
                    
                    /*Akhir Laba Sebelum Pajak  */
                xlsEOF();
                exit();
        }
            
        
            if (!$data['record']) {
                $this->session->set_flashdata('message_failed', 'Data Tidak Ditemukan');
                redirect(base_url('akuntansi/panel_laporan_keuangan'),'refresh');
            }

            $data['hari']=$_POST['hari'];
            //print_r($data);
            $this->template->load('template_admin','laporan_keuangan/akuntansi_'.$bentuk.'',$data);
            
    }
    

}