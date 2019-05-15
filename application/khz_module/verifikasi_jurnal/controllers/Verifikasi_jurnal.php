    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verifikasi_jurnal extends CI_Controller {

    public function __construct()

    {

        parent::__construct();
        $this->load->model(array('Model_Akuntansi'));
        $this->load->library('datatables');
        $user = wp_get_current_user();
         /* if ( !in_array( 'akunting', (array) $user->roles ) ) {
                
                redirect(base_url('denied'));
            } */
         
    }
            
    /* Verifikasi Jurnal */
    public function jsondaftarjurnal()
    {
        header('Content-Type: application/json');
        echo $this->Model_Akuntansi->jsondaftarjurnal();
    }
    public function index()
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
    
    public function tampilcurrentvoucher($uniqid) 
    {
        $data_record = $this->Model_Akuntansi->tampilvoucher($uniqid);
        $data['title']='Struk';
        $data['record']=$data_record;
	
        if ($data) {
        //print_r($data_print);

        //Load html view
	    $html=$this->load->view('akuntansi_voucher_detail', $data);
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


}