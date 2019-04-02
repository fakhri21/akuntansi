<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Admin extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

	private $column_user_order = array(null, 'ion_auth_users.username', 'ion_auth_users.email');
	private $column_user_search = array('ion_auth_users.username', 'ion_auth_users.email');
	private $order_user = array('ion_auth_users.id' => 'asc');

	private $column_product_order = array(null, 'nama_product', 'harga', 'deskripsi', 'gambar');
	private $column_product_search = array('nama_product', 'harga', 'deskripsi', 'gambar');
	private $order_product = array('id_product' => 'asc');

	private $column_pemesanan_order = array(null, 'a.id_pemesanan', 'a.waktu_pemesanan', 'a.status', 'b.username');
	private $column_pemesanan_search = array('a.id_pemesanan', 'a.waktu_pemesanan', 'a.status', 'b.username');
	private $pemesanan_order = array('id_pemesanan', 'asc');

	public function insert($data) {
		return $this->db->insert('product', $data);
	}

	public function getProduct() {
		return $this->db->get('product')->result();
	}

	public function edit($where) {
		$this->db->where($where);
		$get = $this->db->get('product');
		return $get->result();
	}

	public function update($data, $where) {
		$this->db->where($where);
		return $this->db->update('product', $data);
	}

	public function delete($where) {
		$this->db->where($where);
		return $this->db->delete('product');
	}

	public function profile($data, $where) {
		$this->db->where($where);
		return $this->db->update('ion_auth_users', $data);
	}

	public function get_user() {
		return $this->db->get('ion_auth_users');
	}

	public function get_pemesanan() {
		return $this->db->get('pemesanan');
	}

	public function get_count_product() {
		return $this->db->get('product')->num_rows();
	}

	private function dataTable($from, $column_search, $column_order, $order) {
		$this->db->from($from);
		$i = 0;
		foreach ($column_search as $item) {
			if (isset($_POST['search']['value'])) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($column_search)-1 == $i)
					$this->db->group_end();
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order_user)) {
			$order_data = $order;
			$this->db->order_by(key($order_data), $order_data[key($order_data)]);
		}
	}

	private function dataTableUser($from, $column_search, $column_order, $order) {
		$this->db->select('ion_auth_users.username,ion_auth_users.id, ion_auth_users.email, ion_auth_groups.name');
		$this->db->from($from);
		$this->db->join('ion_auth_users_groups', 'ion_auth_users_groups.user_id = ion_auth_users.id', 'inner');
		$this->db->join('ion_auth_groups', 'ion_auth_groups.id = ion_auth_users_groups.group_id', 'inner');
		$i = 0;
		foreach ($column_search as $item) {
			if (isset($_POST['search']['value'])) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($column_search)-1 == $i)
					$this->db->group_end();
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order_user)) {
			$order_data = $order;
			$this->db->order_by(key($order_data), $order_data[key($order_data)]);
		}
	}

	function get_dataTable_user() {
		$this->dataTableUser('ion_auth_users', $this->column_user_search, $this->column_user_order, $this->order_user);
		if (!empty($_POST['length']) != -1)
			$this->db->limit(isset($_POST['length']), isset($_POST['start']));
		$query = $this->db->get();
		return $query->result();
	}

	public function count_all_user() {
		$this->db->from('ion_auth_users');
		return $this->db->count_all_results();
	}

	function count_filtered_user() {
		$this->dataTableUser('ion_auth_users', $this->column_user_search, $this->column_user_order, $this->order_user);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function user_delete($where) {
		$this->db->where($where);
		return $this->db->delete('ion_auth_users');
	}

	public function user_detail($where) {
		$this->db->select('a.first_name, a.last_name, a.username, a.email, a.company, a.phone, c.name');
		$this->db->from('ion_auth_users a');
		$this->db->join('ion_auth_users_groups b', 'b.user_id = a.id', 'inner');
		$this->db->join('ion_auth_groups c', 'c.id = b.group_id');
		$this->db->where($where);
		$this->db->limit(1);
		return $this->db->get()->result();
	}

	function get_dataTable_product() {
		$this->dataTable('product', $this->column_product_search, $this->column_product_order, $this->order_product);
		if (!empty($_POST['length']) != -1)
			$this->db->limit(isset($_POST['length']), isset($_POST['start']));
		$query = $this->db->get();
		return $query->result();
	}

	public function count_all_product() {
		$this->db->from('product');
		return $this->db->count_all_results();
	}

	function count_filtered_product() {
		$this->dataTable('product', $this->column_product_search, $this->column_product_order, $this->order_product);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function product_delete($where) {
		$this->db->where($where);
		return $this->db->delete('product');
	}

	public function product_detail($where) {
		$this->db->where($where);
		$this->db->limit(1);
		return $this->db->get('product')->result();
	}

	private function dataTablePemesanan() {
		$this->db->select('a.waktu_pemesanan, a.status, a.id_pemesanan, b.username');
		$this->db->from('pemesanan a');
		$this->db->join('ion_auth_users b', 'b.id = a.id_user', 'inner');
		$i = 0;
		foreach ($this->column_pemesanan_search as $item) {
			if (isset($_POST['search']['value'])) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_pemesanan_search)-1 == $i)
					$this->db->group_end();
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_pemesanan_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->pemesanan_order)) {
			$order_data = $this->pemesanan_order;
			$this->db->order_by(key($order_data), $order_data[key($order_data)]);
		}
	}
	function detail_pemesanan($id_pemesanan)
	{
		$this->db->select('*');
		$this->db->from('t_detail_pemesanan');
		$this->db->join('pemesanan', 'pemesanan.id_pemesanan = t_detail_pemesanan.id_pemesanan', 'inner');
		$this->db->join('product', 'product.id_product = t_detail_pemesanan.id_product', 'inner');
		$this->db->join('metode_pembayaran', 't_detail_pemesanan.id_metode = metode_pembayaran.id_metode', 'inner');
		$this->db->where('t_detail_pemesanan.id_pemesanan='.$id_pemesanan.'');
		return array('record'=>$this->db->get()->result_array());
		
	}

	function get_dataTable_pemesanan() {
		$this->dataTablePemesanan();
		if (!empty($_POST['length']) != -1)
			$this->db->limit(isset($_POST['length']), isset($_POST['start']));
		$query = $this->db->get();
		return $query->result();
	}

	public function count_all_pemesanan() {
		$this->db->from('t_pemesanan');
		$this->db->join('t_detail_pemesanan', 't_pemesanan.id_pemesanan = t_detail_pemesanan.id_pemesanan');
		return $this->db->count_all_results();
	}

	function count_filtered_pemesanan() {
		$this->dataTablePemesanan();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function get_dataTable_pemesanan_user($where) {
		$this->dataTablePemesanan();
		if (!empty($_POST['length']) != -1)
			$this->db->limit(isset($_POST['length']), isset($_POST['start']));
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_all_pemesanan_user($where) {
		$this->db->from('t_pemesanan');
		$this->db->join('t_detail_pemesanan', 't_pemesanan.id_pemesanan = t_detail_pemesanan.id_pemesanan');
		$this->db->where($where);
		return $this->db->count_all_results();
	}

	function count_filtered_pemesanan_user($where) {
		$this->dataTablePemesanan();
		$this->db->where($where);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function konfirmasi_pemesanan($where, $data) {
		$this->db->where($where);
		return $this->db->update('pemesanan', $data);
	}
}