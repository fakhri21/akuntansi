<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Kasdanbank extends REST_Controller {

 

    public function __construct()

    {

        parent::__construct();
        $this->load->model(array('Model_Kasdanbank'));
        $this->load->library('datatables');
        $user = wp_get_current_user();
         /* if ( !in_array( 'akunting', (array) $user->roles ) ) {
                
                redirect(base_url('denied'));
            } */
         
    }
            
    /* Cash and Bank */
    public function tambahkasbank($kondisi)
    {
        
        if ($kondisi=="pendapatan") {
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
        $keterangan=$_POST['keterangan']."<br>".
                        $record['id_coa'].$_POST['nama_coa']."<br>".
                        $inversrecord['id_coa'].$_POST['invnama_coa'];

        $data = array(
            'id'      => uniqid(),
            'qty'     => 1,
            'price'   => $_POST['nilai'],
            'name'    => $_POST['keterangan'],
            'options' => array( 'record' => $record, 
                                'inversrecord' => $inversrecord,
                                'keterangan'=>$keterangan)
        );
        
        $this->cart->insert($data);
        echo $name;
    }
    function simpan_kasbank($uniqid,$jurnal)
    {
        if ($uniqid!=NULL) {
            $uniqid=$uniqid;
        } else {
            $uniqid=uniqid("KB",TRUE);
            //Header Kas Bank

            $data = array('id_tipe_voucher' =>'KB' );
            $this->Model_Kasdanbank->simpan_voucher('akuntansi_h_voucher',$data,$uniqid);
        }
        
        //Detail Voucher Kas Bank
        
        foreach ($jurnal as $items) {
            $rowid=uniqid("",TRUE);
            //foreach ($this->cart->contents() as $items) {
            $this->Model_Kasdanbank->detail_voucher('akuntansi_detail_voucher',$items['record'],$uniqid,$rowid);
            $this->Model_Kasdanbank->detail_voucher('akuntansi_detail_voucher',$items['inversrecord'],$uniqid,$rowid);
        }
        //$this->cart->destroy();
        //echo base_url('verifikasi_jurnal/print_voucher/'.$uniqid.'');   
        //$this->print_kasdanbank($uniqid);
    }

    function index_get()
    {
        # code...
    }

    function index_post($aksi)
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
                    $this->simpan_kasbank($uniqid,$jurnal);
                    break;
            }
            
            $pesan="Berhasil Menyimpan";
            $this->response($pesan, 200);
		}
        
        
    }

    
}