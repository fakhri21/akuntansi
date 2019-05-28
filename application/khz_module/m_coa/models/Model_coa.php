<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_coa extends CI_Model
{

    public $table = 'akuntansi_m_coa';
    public $id = 'uniqid';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $data = $this->db->query(
            'SELECT
                akuntansi_m_kategori.uniqid,
                akuntansi_m_kategori.nama_kategori,
                akuntansi_m_kelompok_coa.uniqid as kel_uniqid,
                akuntansi_m_kelompok_coa.nama_kelompok_coa,
                akuntansi_m_coa.uniqid as coa_id,
                akuntansi_m_coa.id_coa,
                akuntansi_m_coa.nama_coa
            FROM
                akuntansi_m_kategori
            LEFT JOIN
                akuntansi_m_kelompok_coa
            ON 
                akuntansi_m_kategori.uniqid = akuntansi_m_kelompok_coa.id_kategori
            LEFT JOIN
                akuntansi_m_coa
            ON
                akuntansi_m_kelompok_coa.uniqid = akuntansi_m_coa.id_kelompok_coa');

        $tabel = $data->result_array();
        $result = [];
        $temp = [];
        $i=0;
        // echo '<pre>';
        // print_r($tabel);
        foreach ($tabel as $data) {
            $id_kat = $data['uniqid'];
            $kat = $data['nama_kategori'];

            $result[$id_kat] = array('id_kategori'=>$id_kat, 'nama_kategori'=>$kat, 'kelompok'=>array());
        }
        
        foreach ($tabel as $data) {
            $id_kat = $data['uniqid'];

            $id_kel = $data['kel_uniqid'];
            $kel = $data['nama_kelompok_coa'];

            $id_coa = $data['id_coa'];
            $coa = $data['nama_coa'];

            $result[$id_kat]['kelompok'][$id_kel] = array('id_kelompok'=>$id_kel, 'nama_kelompok'=>$kel, 'coa'=>array());
        }

        foreach ($tabel as $data) {
            $id_kat = $data['uniqid'];

            $id_kel = $data['kel_uniqid'];

            $uniqid = $data['coa_id'];
            $id_coa = $data['id_coa'];
            $coa = $data['nama_coa'];

            $result[$id_kat]['kelompok'][$id_kel]['coa'][] = array('uniqid' => $uniqid, 'id_coa'=>$id_coa, 'nama_coa'=>$coa);
        }
        // echo '<pre>';
        // print_r($result);

        return $result;
    }

    // get data by uniqid
    function get_coa($id)
    {
        $coa = $this->db->get_where('akuntansi_m_coa', array('uniqid' => $id));
        return $coa->result_array();
    }

    // get data by id
    function get_coa_id($id)
    {
        $coa = $this->db->get_where('akuntansi_m_coa', array('id_coa' => $id));
        return $coa->result_array();
    }

    function update_coa(){

        if(isset($_POST)){

            $data =  array(
                "id_kelompok_coa" => $_POST["id_kelompok_coa"],
                "nama_coa" => $_POST['nama_coa'],
                "saldo_awal" => $_POST['saldo_awal'],
                "saldo_normal_special" => $_POST['saldo_normal_special'],
                "quantity" => $_POST['quantity']
            );
            $this->db->set($data);
            $this->db->where('uniqid', $_POST['uniqid']);
            return $this->db->update('akuntansi_m_coa');
        }
    }

    function add_coa(){

        if(isset($_POST)){
           
            $data = array(
                'id_kelompok_coa' => $_POST['kelompok'],
                'uniqid'=>uniqid("COA",TRUE),
                'id_coa'=> $_POST['idCoa'],
                'nama_coa' => $_POST['nama_coa'],
                'saldo_awal' => $_POST['saldo_awal'],
                'saldo_normal_special' => $_POST['saldo_normal_special'],
                'quantity' => $_POST['quantity'],
            );

                $this->db->insert('akuntansi_m_coa', $data);
                return $this->db->insert_id();
        }
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('uniqid', $q);
	$this->db->or_like('id_coa', $q);
	$this->db->or_like('id_kategori', $q);
	$this->db->or_like('nama_coa', $q);
	$this->db->or_like('saldo_awal', $q);
	$this->db->or_like('saldo_normal_special', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('uniqid', $q);
	$this->db->or_like('id_coa', $q);
	$this->db->or_like('id_kategori', $q);
	$this->db->or_like('nama_coa', $q);
	$this->db->or_like('saldo_awal', $q);
	$this->db->or_like('saldo_normal_special', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->set('uniqid','UUID()',FALSE);
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Model_coa.php */
/* Location: ./application/models/Model_coa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-10 04:22:50 */
/* http://harviacode.com */