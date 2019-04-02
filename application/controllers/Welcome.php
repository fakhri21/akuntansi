<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    
	public function index()
    {
        $data['title'] = 'Sariraya Indonesia';
        
		$this->load->view('template_home',$data);
	}
}
