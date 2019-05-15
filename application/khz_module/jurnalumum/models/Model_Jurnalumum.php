<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Jurnalumum extends CI_Model {

/* Voucher Akuntansi */
function list_voucher($status,$tipe)
{
    $this->db->select('a.id_voucher,
                        concat(id_tipe_voucher,DATE_FORMAT(a.waktu,"%y%m"),right(concat(prefix_number,id_voucher),4))as id_voucherjurnal,
                        uniqid');
		$this->db->from('h_akuntansi_voucher a');
		
        if (isset($status)) {
            $this->db->where('status', $status);
        }
		
        if (isset($status)) {
        $this->db->where('status', $status);
            $this->db->where('id_tipe_voucher', $tipe);
        }
        
        return $this->db->get()->result_array();
}

function simpan_voucher($table,$data,$uniqid)
{
    $this->db->set('uniqid',$uniqid);
	$this->db->insert($table,$data);
}

function detail_voucher($table,$data,$uniqid,$session)
{
    $this->db->set('uniqid','UUID_SHORT()',FALSE);
    $this->db->set('uniqid_voucher',$uniqid);
    $this->db->set('id_session',$session);
    $this->db->insert($table,$data);
}

function hapus_item($table,$uniqid)
{
    $this->db->where('id_session', $uniqid);
    $this->db->delete($table);
    
}

}

/* End of file ModelName.php */
