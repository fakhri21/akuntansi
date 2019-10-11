<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;    
class Hutang extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_hutang');
        $this->load->library('datatables');
        $user = wp_get_current_user();
         /* if ( !in_array( 'akunting', (array) $user->roles ) ) {
                
                redirect(base_url('denied'));
            } */
        
    }

    function index_get()
    {
        # code...
    }

    function index_post()
    {
		$method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
			$this->response(array('status' => 'Bad Request', 400));
		} else {
            $uniqid=$_POST['uniqid'];
            $jurnal=$_POST['data'];
            switch ($aksi) {
                case 'value':
                    # code...
                    break;
                
                default:
                    $this->simpan_jurnalhutang($uniqid,$jurnal);
                    break;
            }
            
            $pesan="Berhasil Menyimpan";
            $this->response($pesan, 200);
		}   
    }

    function simpan_jurnalhutang($uniqid,$jurnal)
    {
        
        if ($uniqid!=NULL) {
            $uniqid=$uniqid;
        } else {
            $uniqid=uniqid("HT",TRUE);
            //Header
             $data = array('id_tipe_voucher' =>'HT' );
            $this->Model_hutang->simpan_voucher('akuntansi_h_voucher',$data,$uniqid);
        }
        
        //Detail Pemesanan
        foreach ($jurnal as $items) {
            $id_session=uniqid("",TRUE);
            $this->Model_hutang->detail_voucher('akuntansi_detail_voucher',$items['record'],$items['hutang'],$uniqid,$id_session);
            $this->Model_hutang->detail_voucher('akuntansi_detail_voucher',$items['inversrecord'],NULL,$uniqid,$id_session);
        }   
    }
    
    
    
    

}
