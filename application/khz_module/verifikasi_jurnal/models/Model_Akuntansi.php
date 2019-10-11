<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Akuntansi extends CI_Model {

/* Verifikasi Jurnal */
function jsondaftarjurnal() {
    $this->datatables->select('uniqid,id_voucher,concat(id_tipe_voucher,DATE_FORMAT(waktu,"%y%m"),right(concat(prefix_number,id_voucher),4))as id_voucherjurnal,DATE_FORMAT(waktu,"%d-%m-%Y") as waktu,status');
    $this->datatables->from('akuntansi_h_voucher');
    $this->datatables->add_column('action',"tes");
    return $this->datatables->generate();
}

function tampilvoucher($uniqid)
{
        $this->db->select('*,(debit+kredit) as nilai');
		$this->db->from('akuntansi_kumpulan_jurnal a');
		$this->db->where('a.uniqid_voucher',$uniqid);
        $this->db->group_by('id_session');
        $this->db->order_by('id_detail', 'asc');
        
        
        return $this->db->get()->result_array();
		
}

function ubahstatus($uniqid,$data)
{
    
    $this->db->where('uniqid', $uniqid);
    $this->db->where('status', 0);
    $this->db->update('akuntansi_h_voucher', $data);
    
}


}

/* End of file ModelName.php */
