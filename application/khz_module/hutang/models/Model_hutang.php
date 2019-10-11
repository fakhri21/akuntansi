<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_hutang extends CI_Model {

/* Voucher Akuntansi */
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

function simpan_voucher($table,$data,$uniqid)
{
    $this->db->set('uniqid',$uniqid);
	$this->db->insert($table,$data);
}

function detail_voucher($table,$data,$data_hutang,$uniqid,$session)
{
    $uniqid_detail=uniqid("",TRUE);
    $this->db->set('uniqid',$uniqid_detail);
    $this->db->set('uniqid_voucher',$uniqid);
    $this->db->set('id_session',$session);
    $this->db->insert($table,$data);

    if($data_hutang!=NUll){
        $this->detail_hutang('akuntansi_detail_hutang',$data_hutang,$uniqid_detail);
    }
}

function detail_hutang($table,$data,$uniqid_detail)
{
    $this->db->set('uniqid','UUID_SHORT()',FALSE);
    $this->db->set('uniqid_detail_voucher',$uniqid_detail);
    $this->db->insert($table,$data);
}

function hapus_item($table,$uniqid)
{
    $this->db->where('id_session', $uniqid);
    $this->db->delete($table);
    
}

}

/* End of file ModelName.php */
