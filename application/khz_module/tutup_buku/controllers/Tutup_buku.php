<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tutup_buku extends CI_Controller
{
    public $nama_template='template_admin';
    public $priode='';

    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Tutup_Buku');
        $this->load->library('form_validation');        
	      $this->load->library('datatables');
        $this->priode_hari=get_option('buka_akuntansi');
        $this->priode_bulan=get_option('buka_akuntansi_bulan');
    }

    public function index()
    {
        $data['hari']='';
        $data['bulan']='';
        
        if ($this->priode_hari) {
          $data['hari']=date_format(date_create($this->priode_hari),"d/m/Y");
        }
        if ($this->priode_bulan) {
          $data['bulan']=date_format(date_create($this->priode_bulan),"d/m/Y");
        }
        //print_r($this->priode);
        $this->template->load($this->nama_template,'tutup_buku',$data);
    }

    public function buka_akuntansi_bulan()
    {
      update_option('buka_akuntansi_bulan',date('Y-m-t',strtotime(current_time( 'mysql' ))));    
      //update_option('buka_akuntansi_bulan',current_time( 'mysql' ));    
      $this->session->set_flashdata('message_success', 'Berhasil Buka Priode Bulanan Akuntansi');
      redirect(base_url('tutup_buku'));
    }
    
    public function buka_akuntansi()
    {
      //$batas_bulan= stripslashes("\'".$this->priode_bulan."\'");
      $batas_bulan= date_create($this->priode_bulan);
      $hari_ini=date_create(current_time('mysql'));

      if ($hari_ini<$batas_bulan) {
        update_option('buka_akuntansi',current_time( 'mysql' ));
      }
      else {
        update_option('buka_akuntansi',$this->priode_bulan);
      }

      //$this->Model_Tutup_Buku->buka_akuntansi($batas_bulan);    
      $this->session->set_flashdata('message_success', 'Berhasil Buka akuntansi');
      redirect(base_url('tutup_buku'));
    }

    public function eod()
    {

      if (isset($_POST['buka'])) {
        redirect(base_url('tutup_buku/buka_akuntansi'));
      }else{
        $this->Model_Tutup_Buku->eod('akuntansi_h_voucher',$this->priode_hari);
        $this->jurnal_ikhtisarrugilaba($this->priode_hari,700000,320002);
        update_option('buka_akuntansi','');
        $this->session->set_flashdata('message_success', 'Berhasil EOD akuntansi');
        redirect(base_url('tutup_buku'));
      }
      
    }
    
    public function eom()
    {
       if (isset($_POST['buka'])) {
        redirect(base_url('tutup_buku/buka_akuntansi_bulan'));
      }else{
        $this->Model_Tutup_Buku->eom('akuntansi_h_voucher',$this->priode_bulan);
        $this->session->set_flashdata('message_success', 'Berhasil EOM akuntansi');
        redirect(base_url('tutup_buku'));
      }
    }

    public function eoy()
    {
      //$this->Model_Tutup_Buku->eoy('akuntansi_h_voucher',$data);
      $this->reset_akuntansi();
      $this->session->set_flashdata('message_success', 'Berhasil EOY akuntansi');

      print_r($data);

      //redirect(base_url('tutup_buku'));
    }

     public function reset_akuntansi()
    {
        $daftar_coa_neraca=$this->Model_Tutup_Buku->get_coa_neraca();
        
        foreach ($daftar_coa_neraca as $data_coa) {
          $this->Model_Tutup_Buku->reset_saldo_awal($data_coa['id_coa']);
        }
        
        $this->db->query('INSERT INTO akuntansi_bck_detail_voucher
                          SELECT *
                          FROM akuntansi_detail_voucher');
                          
        $this->db->query('INSERT INTO akuntansi_bck_detail_stock
                          SELECT *
                          FROM akuntansi_detail_stock');
                          
        $this->db->query('INSERT INTO akuntansi_bck_h_voucher
                          SELECT *
                          FROM akuntansi_h_voucher');
        $this->db->where('year(eod)<>0');
        $this->db->delete('akuntansi_h_voucher');
        
        $this->db->query('ALTER TABLE akuntansi_h_voucher AUTO_INCREMENT = 1');
        $this->db->query('ALTER TABLE akuntansi_detail_voucher AUTO_INCREMENT = 1');
        $this->db->query('ALTER TABLE akuntansi_detail_stock AUTO_INCREMENT = 1');
    }
     

    public function jurnal_ikhtisarrugilaba($hari,$id_ikhtisar,$id_labaditahan)
    {
      
      $data=$this->Model_Tutup_Buku->get_ikhtisarrugilaba($hari);
      $nilai=$data['nilai']['nilai'];

      if ($nilai>0) {
        $record=array('id_coa' =>$id_ikhtisar ,
                        'debit'=>abs($nilai),
                        'keterangan'=>'laba ditahan '.$hari.'' );

        $inversrecord=array('id_coa' =>$id_labaditahan ,
                        'kredit'=>abs($nilai),
                        'keterangan'=>'laba ditahan '.$hari.'' );

      }
      else {
        $record=array('id_coa' =>$id_ikhtisar ,
                        'kredit'=>abs($nilai),
                        'keterangan'=>'laba ditahan '.$hari.'' );

        $inversrecord=array('id_coa' =>$id_labaditahan ,
                        'debit'=>abs($nilai),
                        'keterangan'=>'laba ditahan '.$hari.'' );

      }

      $uniqid=uniqid("JU",TRUE);
      $session=uniqid(" ",TRUE);
      //Header
        $data = array(
                        'id_tipe_voucher' =>'JU',    
                        'status' =>'1',    
                        'eod' =>$hari );    
        $this->Model_Tutup_Buku->simpan_voucher('akuntansi_h_voucher',$data,$uniqid);
      //Detail
      $this->Model_Tutup_Buku->detail_voucher('akuntansi_detail_voucher',$record,$uniqid,$session);
      $this->Model_Tutup_Buku->detail_voucher('akuntansi_detail_voucher',$inversrecord,$uniqid,$session);
    }

  /*   public function _rules() 
    {
	$this->form_validation->set_rules('id_kategori', 'id kategori', 'trim|required');
	$this->form_validation->set_rules('nama_kategori', 'nama kategori', 'trim|required');
	$this->form_validation->set_rules('urutan', 'urutan', 'trim|required');
	$this->form_validation->set_rules('isi', 'isi', 'trim|required');

	$this->form_validation->set_rules('uniqid', 'uniqid', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
 */
}

/* End of file daftar_struk.php */
/* Location: ./application/controllers/M_kategori.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-02-02 07:57:08 */
/* http://harviacode.com */