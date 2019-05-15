    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akuntansi extends CI_Controller {

 

    public function __construct()

    {

        parent::__construct();
        $this->load->model(array('Model_Akuntansi'));
        $this->load->library(array('session','form_validation'));
        $this->load->library('datatables');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('exportexcel_helper');
        $this->load->vars(array('data_admin' => $this->data_admin));
        $user = wp_get_current_user();
         /* if ( !in_array( 'akunting', (array) $user->roles ) ) {
                
                redirect(base_url('denied'));
            } */
         
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
        }
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

    

}