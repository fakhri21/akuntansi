<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Tutup_Buku extends CI_Model
{

    public $table = 'h_transaksi';
    public $id = 'uniqid';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    public function buka_akuntansi_bulan()
    {
        $this->db->where_in('nama_konfigurasi','buka_akuntansi_bulan');
        $this->db->set('isi','last_day(CURRENT_DATE())',FALSE);
        $this->db->update('konfigurasi');
        
    }

    public function buka_akuntansi($batas_bulan)
    {
        $this->db->where_in('option_name','buka_akuntansi');
        $this->db->set('option_value','IF(CURRENT_DATE()>date('.$batas_bulan.'),'.$batas_bulan.',CURRENT_DATE())',FALSE);
        $this->db->update('wp_apporder_options');
        
    }

    public function eod($table,$data)
    {
        $this->db->where('DATE(eod)<=DATE(0)');
        $this->db->set('eod',$data);
        $this->db->update($table);

    }

    public function eom($table,$data)
    {
        $this->db->where('DATE(eom)<=DATE(0)');
        $this->db->set('eom',$data);
        $this->db->update($table);

        $this->db->where_in('nama_konfigurasi','buka_akuntansi_bulan');
        $this->db->set('isi','NULL',FALSE);
        $this->db->update('konfigurasi');
    }
    
    public function eoy($table,$data)
    {
        $this->db->where('YEAR(eoy)<=YEAR(0) ');
        $this->db->update($table, $data);
        
    }

    public function get_coa_neraca()
    {
        
        $this->db->select('*');
        $this->db->from('daftar_coa_neraca');
        $coa=$this->db->get()->result_array();
        return $coa;
        
    }
    
    public function reset_saldo_awal($id_coa)
    {
            
        $this->db->select('(buku_besar.saldo_awal+@s:=@s+nilai_voucher) as saldo');
            $this->db->from('buku_besar,
                        (select @s:=0) as v_saldo
                        ');
        $this->db->where('status',1);
        $this->db->where('id_coa='.$id_coa.'');
        
        $saldo_setahun= $this->db->get()->row_array();
        
        
        $this->db->where('id_coa', $id_coa);
        $this->db->set('saldo_awal',$saldo_setahun['saldo'],FALSE);
        $this->db->update('m_coa');
    }

    public function get_ikhtisarrugilaba($hari)
    {
        
        $this->db->select('sum(kredit-debit) as nilai');
        $this->db->where('eod',$hari);
        $this->db->where('pos','laba rugi');
        $this->db->from('laporan_keuangan');
        $coa['nilai']=$this->db->get()->row_array();
        return $coa;
        
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

    
    

}

/* End of file Model_kategori.php */
/* Location: ./application/models/Model_kategori.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-02-02 07:57:08 */
/* http://harviacode.com */