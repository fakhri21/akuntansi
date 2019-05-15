    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jurnalumum extends CI_Controller {

 

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
            $this->Model_Jurnalumum->simpan_voucher('h_akuntansi_voucher',$data,$uniqid);
        }
        
        //Detail Pemesanan
        foreach ($this->cart->contents() as $items) {
        $id_session=$items['options']['id_session'];
            $this->Model_Jurnalumum->detail_voucher('detail_akuntansi_voucher',$items['options']['item'],$uniqid,$id_session);
        }
        
        $this->cart->destroy();

        echo base_url('verifikasi_jurnal/print_voucher/'.$uniqid.'');   
        
    }

    function print_jurnalumum($uniqid)
    {
        $data_print = $this->Model_Jurnalumum->tampilvoucher($uniqid);
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

}