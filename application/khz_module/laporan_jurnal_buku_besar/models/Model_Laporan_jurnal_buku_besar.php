<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Laporan_jurnal_buku_besar extends CI_Model {

//Laporan Jurnal
function laporanjurnal($hari,$hari_akhir)
{
    
    $this->db->select(' DATE_FORMAT(waktu,"%d-%m-%Y") as waktu,
                        id_coa,inversid_coa,
                        nama_coa,inversnama_coa,
                        debit,invers_debit,
                        kredit,invers_kredit,
                        keterangan,
                        (@row:=@row+1) as id_row');
    $this->db->from('laporan_jurnal,(select @row:=0)as r');
    $this->db->where('status',1);
    if ($hari<>NULL) {
        $this->db->where('date(eod) between date('.$hari.') and date('.$hari_akhir.')' );
    }
    else{
        $this->db->where('eod',0);
    } 
    
    return $this->db->get()->result_array();
    
}

//Buku besar
function buku_besar($coa,$hari,$hari_akhir)
{    
    $this->db->select('DATE_FORMAT(waktu,"%d-%m-%Y") as waktu,id_detail,keterangan,debit,kredit,id_coa,nama_coa,(x.saldo_sebelumnya+buku_besar.saldo_awal)as saldo_awal_ok,(x.saldo_sebelumnya+buku_besar.saldo_awal+@s:=@s+nilai_voucher) as saldo');
    if ($hari<>NULL) {
        $this->db->from('buku_besar,
                    (select @s:=0) as v_saldo,
                    (select sum(if(DATE(eod)<DATE('.$hari.'),(nilai_voucher),0)) as saldo_sebelumnya from buku_besar where id_coa='.$coa.' ) as x 
                    ');
        $this->db->where('eod between date('.$hari.') and date('.$hari_akhir.')' );
    
    }
    else {
        $this->db->from('buku_besar,
                    (select @s:=0) as v_saldo0,
                    (select sum(if(DATE(eod)<curdate() and date(eod)>0,(nilai_voucher),0)) as saldo_sebelumnya from buku_besar where id_coa='.$coa.' ) as x 
                    ');    
        $this->db->where('eod',0);
    }
    $this->db->where('status',1);
    $this->db->where('id_coa',$coa);
    $this->db->order_by('id_detail', 'asc');
    
    
    return $this->db->get()->result_array();   
}

}

/* End of file ModelName.php */
