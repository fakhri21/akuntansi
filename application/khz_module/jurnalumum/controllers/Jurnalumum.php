<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
class Jurnalumum extends REST_Controller {

 

    public function __construct()

    {

        parent::__construct();
        $this->load->model('Model_Jurnalumum');
        $this->load->library('datatables');
        $user = wp_get_current_user();
         /* if ( !in_array( 'akunting', (array) $user->roles ) ) {
                
                redirect(base_url('denied'));
            } */
         
    }
            
    
/* Jurnal Umum */
    public function index()
    {
        $status=get_option('buka_akuntansi');
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

        $keterangan=$_POST['keterangan']."<br>".
                        $record['id_coa'].$_POST['nama_coa']."(D)<br>".
                        $inversrecord['id_coa'].$_POST['invnama_coa']."C";

        $data = array(
            'id'      => uniqid(),
            'qty'     => 1,
            'price'   => $_POST['nilai'],
            'name'    => $_POST['keterangan'],
            'options' => array( 'item' => $record,
                                'invitem' => $inversrecord,
                                'id_session'=>$id_session,
                                'keterangan'=>$keterangan)
        );
        
        $this->cart->insert($data);

    }

    function simpan_jurnalumum()
    {
        
        if (isset($_POST['uniqid'])) {
            $uniqid=$_POST['uniqid'];
        } else {
            $uniqid=uniqid("JU",TRUE);
            //Header
             $data = array('id_tipe_voucher' =>'JU' );
            $this->Model_Jurnalumum->simpan_voucher('akuntansi_h_voucher',$data,$uniqid);
        }
        
        //Detail Pemesanan
        foreach ($this->cart->contents() as $items) {
        $id_session=$items['options']['id_session'];
            $this->Model_Jurnalumum->detail_voucher('akuntansi_detail_voucher',$items['options']['item'],$uniqid,$id_session);
            $this->Model_Jurnalumum->detail_voucher('akuntansi_detail_voucher',$items['options']['invitem'],$uniqid,$id_session);
        }
        
        $this->cart->destroy();

        echo base_url('verifikasi_jurnal/print_voucher/'.$uniqid.'');   
        
    }

    function index_post()
    {
		$method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
			$this->response(array('status' => 'Bad Request', 400));
		} else {
            $uniqid=uniqid("JU",TRUE);
            //Header
            $data = array('id_tipe_voucher' =>'JU' );
            $this->Model_Jurnalumum->simpan_voucher('akuntansi_h_voucher',$data,$uniqid);
        
                //Detail Pemesanan
                $id_session=uniqid("API",TRUE);
                
                $this->Model_Jurnalumum->detail_voucher('akuntansi_detail_voucher',$params['debit'],$uniqid,$id_session); //Debit
                $this->Model_Jurnalumum->detail_voucher('akuntansi_detail_voucher',$params['kredit'],$uniqid,$id_session);//Credit
            
                $this->response($params, 200);
		}
        
        
    }


}