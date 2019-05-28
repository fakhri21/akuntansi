    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock extends CI_Controller {

 

    public function __construct()

    {

        parent::__construct();
        $this->load->model(array('Model_Stock'));
        $this->load->library('datatables');
        $user = wp_get_current_user();
         /* if ( !in_array( 'akunting', (array) $user->roles ) ) {
                
                redirect(base_url('denied'));
            } */
         
    }
            
    /* Stock */
    function index()
    {
        $this->template->load('template_admin','akuntansi_panel_stock');
    }
    function masuk_stock()
    {
        $this->cart->destroy();
        $this->template->load('template_admin','akuntansi_stock');
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

            $keterangan=$_POST['keterangan']."<br>".
                        $inversrecord['id_coa'].$_POST['nama_coa_stock']."(Stock) <br>".
                        $record['id_coa'].$_POST['nama_coa']."(Payment)<br>";


        $data = array(
            'id'      => uniqid(),
            'qty'     => $_POST['quantity'],
            'price'   => $harga_kotor,
            'name'    => $_POST['keterangan'],
            'options' => array( 'diskon'=>$_POST['diskon']."%",
                                'pajak'=>$_POST['pajak']."%",
                                'stock' => $stock,
                                'record'=>$record,
                                'inversrecord'=>$inversrecord,
                                'keterangan'=>$keterangan
                                )
        );
        
        $this->cart->insert($data);
        
    }
    function simpan_stock()
    {
        $uniqid=uniqid("ST",TRUE);
         //Header
         $data = array('id_tipe_voucher' =>'ST' );
        $this->Model_Stock->simpan_voucher('akuntansi_h_voucher',$data,$uniqid);
        
        //Detail Voucher
        foreach ($this->cart->contents() as $items) {
            $this->Model_Stock->detail_voucher('akuntansi_detail_voucher',$items['options']['record'],$uniqid,$items['rowid']);
            $this->Model_Stock->detail_voucher('akuntansi_detail_voucher',$items['options']['inversrecord'],$uniqid,$items['rowid']);
            $this->Model_Stock->detail_stock('akuntansi_detail_stock',$items['options']['stock'],$uniqid);
        }
        $this->cart->destroy();
        
        //redirect('akuntansi/print_kasdanbank/'.$uniqid.'');
        echo base_url('stock/print_stock/'.$uniqid.'');
        //$this->print_kasdanbank();
    }
//Stock opname
    function stock_opname()
    {
        $this->cart->destroy();
        $this->template->load('template_admin','akuntansi_stockopname');
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
        $this->Model_Stock->simpan_voucher('akuntansi_h_voucher',$data,$uniqid);
        
        //Detail Voucher
        foreach ($this->cart->contents() as $items) {
           $feedback= $this->Model_Stock->stockopname('akuntansi_detail_voucher','akuntansi_detail_stock',$items['options'],$uniqid);
            print_r($feedback);
        }
        $this->cart->destroy();
    }
    function print_stock($uniqid)
    {
        $data_print = $this->Model_Stock->tampilstock($uniqid);
        $data['title']='Struk';
        $data['record']=$data_print;
	
        if ($data) {
        //print_r($data_print);

        require_once("dompdf/dompdf_config.inc.php");
        $dompdf = new DOMPDF();

        //Load html view
	    $html=$this->load->view('akuntansi_stock_detail', $data,TRUE);
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
      
       // $data['record']=$this->Model_Stock->laporanstock($hari,$hari_akhir);
        $this->template->load('template_admin','akuntansi_laporan_stock');
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
            $data['record']=$this->Model_Stock->laporan_stockopname($hari,$hari_akhir);
            $html=$this->load->view('akuntansi_stock_sub_opname',$data,TRUE);
        }
        else {
            $data['record']=$this->Model_Stock->substock($hari,$hari_akhir,$coa_stock);
            $html=$this->load->view('akuntansi_stock_sub',$data,TRUE);
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
            $data['record']=$this->Model_Stock->laporan_stockopname($hari,$hari_akhir);
            $html=$this->load->view('akuntansi_stock_sub_opname',$data,TRUE);
        }
        else {
            $data['record']=$this->Model_Stock->substock($hari,$hari_akhir,$coa_stock);
            $html=$this->load->view('akuntansi_stock_sub',$data,TRUE);
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

}