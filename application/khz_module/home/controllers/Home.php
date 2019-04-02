<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()

    {
        parent::__construct();
        $this->load->model('Model_parkir');
    }
    
    public function index()

    {

     
     $this->load->view('home');
        
    }

    public function hasil_angka()
    {
        $masuk=$_POST['tes'];
        
        $hasil_angka=[];
        $array_angka=[];
        $array_angka_pokok=[];
        $angka_sekarang=0;
        $x=0;
        
        $array_angka=str_split($masuk);
        $array_angka_pokok=array_unique($array_angka);
        sort($array_angka_pokok);
        
        foreach ($array_angka_pokok as $header) {
            $x=0;
            $angka_sekarang=$header;
            foreach ($array_angka as $anak) {
                if ($anak==$angka_sekarang) {
                    $x=$x+1;
                    $hasil_angka[$angka_sekarang]=$x;
                }
            }
        }

        echo "Angka Yang di masukkan". $masuk. 
        "<br><br>";
        
        foreach ($hasil_angka as $data_angka => $jumlah) {
            echo $data_angka ."  jumlahnya :". $jumlah. "<br>"; 
        }

    }

    public function print_pdf()
    {
           $masuk=$_POST['tes'];
        
        $hasil_angka=[];
        $array_angka=[];
        $array_angka_pokok=[];
        $angka_sekarang=0;
        $x=0;
        
        $array_angka=str_split($masuk);
        $array_angka_pokok=array_unique($array_angka);
        sort($array_angka_pokok);
        
        foreach ($array_angka_pokok as $header) {
            $x=0;
            $angka_sekarang=$header;
            foreach ($array_angka as $anak) {
                if ($anak==$angka_sekarang) {
                    $x=$x+1;
                    $hasil_angka[$angka_sekarang]=$x;
                }
            }
        }

        $data['data_angka']=$data_angka;
        $data['masuk']=$masuk;
        $data['jumlahnya']=$jumlah;


        
        require_once("dompdf/dompdf_config.inc.php");
        $dompdf = new DOMPDF();

        //Load html view
	   $html=$this->load->view('print', $data,TRUE);
        $dompdf->load_html($html);
	    $dompdf->set_paper(array(0,0,220,1250));
	    $dompdf->render();
	    $dompdf->stream('tes.pdf',array('Attachment' =>0));
         
    }
    
    
}