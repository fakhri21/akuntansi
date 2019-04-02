<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_parkir extends CI_Model {

  public function tampil_parkir()
  {
  		$this->db->select('*');
        $this->db->from('parkir');
        return $this->db->get()->result_array();
        
  }

  public function cek_ketersediaan()
  {
    
  		$this->db->select('*');
      $this->db->from('parkir');
      $this->db->where('status', 0);
      return $this->db->get()->result_array();
        
  }

}

/* End of file ModelName.php */
