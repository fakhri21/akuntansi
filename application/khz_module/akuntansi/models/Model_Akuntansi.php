<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Akuntansi extends CI_Model {

//list coa
function list_coa($kondisi)
{ 
    $this->db->select('a.*');
    $this->db->from('akuntansi_coa a');
    
    switch ($kondisi) {
        case 'kb':
            $this->db->where('id_kelompok_coa=1011000 or id_kelompok_coa=1012000 ');
            break;
        
        case 'invkb':
            $this->db->where('id_kelompok_coa<>1011000 and id_kelompok_coa<>1012000 ');
            break;
        
        case 'piutang':
            $this->db->where('left(id_kelompok_coa,4)=1013');
            break;
        
        case 'stock':
            $this->db->where('id_kelompok_coa=1014000');
            break;
            
        case 'sewa':
            $this->db->where('left(id_kelompok_coa,4)=1015');
            break;
            
        case 'akt_tetap':
            $this->db->where('left(id_kelompok_coa,3)=102');
            break;
                
        case 'kewajiban':
            $this->db->where('left(id_kelompok_coa,3)=201 or left(id_kelompok_coa,4)=202');
            break;
            
        case 'modal':
            $this->db->where('left(id_kelompok_coa,4)=3010 or left(id_kelompok_coa,4)=3011');
            break;
            
        case 'pengeluaran':
            $this->db->where('left(id_kelompok_coa,3)=601 or left(id_kelompok_coa,3)=800');
            break;

        case 'pendapatan':
            $this->db->where('left(id_kelompok_coa,3)=401');
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
                        waktu,
                        id_tipe_voucher,
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

function detail_voucher($uniqid)
{
        $this->db->select('*,(debit+kredit) as nilai');
		$this->db->from('akuntansi_kumpulan_jurnal a');
		$this->db->where('a.uniqid_voucher',$uniqid);
        $this->db->group_by('id_session');
        $this->db->order_by('id_detail', 'asc');
        
        
        return $this->db->get()->result_array();
		
}



}

/* End of file ModelName.php */
