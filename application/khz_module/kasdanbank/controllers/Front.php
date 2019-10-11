<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

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
        $this->load->view('konten/konten_kas_dan_bank');
        }
    }

}

/* End of file Controllername.php */
