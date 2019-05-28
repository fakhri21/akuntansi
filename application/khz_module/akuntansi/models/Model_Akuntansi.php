<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Akuntansi extends CI_Model {

//list coa
function list_coa($kondisi)
{
    
    $this->db->select('a.*');
    $this->db->from('akuntansi_m_coa a');
    $this->db->join('akuntansi_m_kelompok_coa b', 'a.id_kelompok_coa = b.uniqid', 'left');
    switch ($kondisi) {
        case 'kb':
            $this->db->where('b.id_kelompok_coa=1011000 or b.id_kelompok_coa=1012000 ');
            break;
        
        case 'invkb':
            $this->db->where('b.id_kelompok_coa<>1011000 and b.id_kelompok_coa<>1012000 ');
            break;
        
        case 'stock':
            $this->db->where('b.id_kelompok_coa=1014000 ');
            break;
        
        default:
            # code...
            break;
    }
    
    $this->db->order_by('id_coa', 'asc');
    
    return $this->db->get()->result_array();
}

function list_voucher($status,$tipe)
{
    $this->db->select('a.id_voucher,
                        concat(id_tipe_voucher,DATE_FORMAT(a.waktu,"%y%m"),right(concat(prefix_number,id_voucher),4))as id_voucherjurnal,
                        uniqid');
		$this->db->from('akuntansi_h_voucher a');
		
        if (isset($status)) {
            $this->db->where('status', $status);
        }
		
        if (isset($status)) {
        $this->db->where('status', $status);
            $this->db->where('id_tipe_voucher', $tipe);
        }
        
        return $this->db->get()->result_array();
}


}

/* End of file ModelName.php */
