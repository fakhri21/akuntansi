<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_vendor extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_vendor');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('m_vendor/m_vendor_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Model_vendor->json();
    }

    public function read($id) 
    {
        $row = $this->Model_vendor->get_by_id($id);
        if ($row) {
            $data = array(
		'uniqid' => $row->uniqid,
		'id_vendor' => $row->id_vendor,
		'name' => $row->name,
		'email' => $row->email,
		'alamat' => $row->alamat,
		'no_telp' => $row->no_telp,
		'whatsapp' => $row->whatsapp,
	    );
            $this->load->view('m_vendor/m_vendor_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_vendor'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('m_vendor/create_action'),
	    'uniqid' => set_value('uniqid'),
	    'id_vendor' => set_value('id_vendor'),
	    'name' => set_value('name'),
	    'email' => set_value('email'),
	    'alamat' => set_value('alamat'),
	    'no_telp' => set_value('no_telp'),
	    'whatsapp' => set_value('whatsapp'),
	);
        $this->load->view('m_vendor/m_vendor_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_vendor' => $this->input->post('id_vendor',TRUE),
		'name' => $this->input->post('name',TRUE),
		'email' => $this->input->post('email',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
		'whatsapp' => $this->input->post('whatsapp',TRUE),
	    );

            $this->Model_vendor->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('m_vendor'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Model_vendor->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('m_vendor/update_action'),
		'uniqid' => set_value('uniqid', $row->uniqid),
		'id_vendor' => set_value('id_vendor', $row->id_vendor),
		'name' => set_value('name', $row->name),
		'email' => set_value('email', $row->email),
		'alamat' => set_value('alamat', $row->alamat),
		'no_telp' => set_value('no_telp', $row->no_telp),
		'whatsapp' => set_value('whatsapp', $row->whatsapp),
	    );
            $this->load->view('m_vendor/m_vendor_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_vendor'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('uniqid', TRUE));
        } else {
            $data = array(
		'id_vendor' => $this->input->post('id_vendor',TRUE),
		'name' => $this->input->post('name',TRUE),
		'email' => $this->input->post('email',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
		'whatsapp' => $this->input->post('whatsapp',TRUE),
	    );

            $this->Model_vendor->update($this->input->post('uniqid', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('m_vendor'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Model_vendor->get_by_id($id);

        if ($row) {
            $this->Model_vendor->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('m_vendor'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_vendor'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_vendor', 'id vendor', 'trim|required');
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');
	$this->form_validation->set_rules('whatsapp', 'whatsapp', 'trim|required');

	$this->form_validation->set_rules('uniqid', 'uniqid', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file M_vendor.php */
/* Location: ./application/controllers/M_vendor.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-28 04:53:59 */
/* http://harviacode.com */