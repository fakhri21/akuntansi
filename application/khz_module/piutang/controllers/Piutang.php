<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Piutang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->template->load('template_admin','piutang');
        $this->load->view('konten/konten_piutang');

    } 
    
    

}
