<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Auth {
    public function cek_auth()
	{
		$this->ci =& get_instance();
		$this->ci->session->userdata('status') == 1;
		$this->sesi   = $this->ci->session->userdata('isLogin');
		$this->hak 	  = $this->ci->session->userdata('stat');
		//$this->status = $this->ci->session->userdata('status');
		if($this->sesi != TRUE){
			redirect('login','refresh');
			exit();
		}
	}
	
}