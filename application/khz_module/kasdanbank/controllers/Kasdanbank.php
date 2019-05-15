    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kasdanbank extends CI_Controller {

 

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
            //Header Kas Bank

            $data = array('id_tipe_voucher' =>'KB' );
            $this->Model_Kasdanbank->simpan_voucher('h_akuntansi_voucher',$data,$uniqid);
        }
        
        //Detail Voucher Kas Bank
        foreach ($this->cart->contents() as $items) {
            $this->Model_Kasdanbank->detail_voucher('detail_akuntansi_voucher',$items['options']['record'],$uniqid,$items['rowid']);
            $this->Model_Kasdanbank->detail_voucher('detail_akuntansi_voucher',$items['options']['inversrecord'],$uniqid,$items['rowid']);
        }
        $this->cart->destroy();
        echo base_url('verifikasi_jurnal/print_voucher/'.$uniqid.'');   
        //$this->print_kasdanbank($uniqid);
    }
}