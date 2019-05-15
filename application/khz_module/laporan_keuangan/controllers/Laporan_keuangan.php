    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_keuangan extends CI_Controller {

 

    public function __construct()

    {

        parent::__construct();
        $this->load->model(array('Model_Laporan_keuangan'));
        $this->load->library('datatables');
        $user = wp_get_current_user();
         /* if ( !in_array( 'akunting', (array) $user->roles ) ) {
                
                redirect(base_url('denied'));
            } */
         
    }
            
/* Laporan Keuangan */
    public function index()
    {
        $this->template->load('template_admin','akuntansi_laporan_keuangan');
    }

    public function tampil_laporan_keuangan($bentuk='neraca')
    {
        $hari=NULL;
        $model=NULL;
        
        if ($_POST) {
               $hari= stripslashes("\'".get_gmt_from_date($_POST['hari'])."\'");
               $model=$_POST['model'];
        }
        // echo "<pre>";


        if ($bentuk=='neraca') {
   
            $data['isi']=$this->tampil_neraca($hari,$model);

        }
        elseif ($bentuk=='trial_balance') {
            $data['isi']=$this->tampil_trial_balance($hari);
        }
        else {
        //Laba Rugi
            $data['isi']=$this->tampil_laba_rugi($hari,$model);
        }
        
             if (!$data['isi']) {
                $this->session->set_flashdata('message_failed', 'Data Tidak Ditemukan');
                redirect(base_url('laporan_keuangan/panel_laporan_keuangan'),'refresh');
            }
 
            $data['hari']=$_POST['hari'];
            
            require_once("dompdf/dompdf_config.inc.php");
            $dompdf = new DOMPDF();
            //Load html view
            $html=$this->load->view('akuntansi_'.$bentuk.'',$data,TRUE);
            $dompdf->load_html($html);
            $dompdf->set_paper('A4', 'potrait');
            $dompdf->render();
            $dompdf->stream('tes.pdf',array('Attachment' =>0));
    }

    public function tampil_trial_balance($hari)
    {
        $record['isi']=$this->Model_Laporan_keuangan->trial_balance($hari);
        
        $nilai_aktiva=0;
        $nilai_pasiva=0;

        $isi_html='';
                        
                            /* <!-- Kategori --> */
            			foreach ($record['isi'] as $data) { 
                        
        $isi_html.=
                        '   <tr>
                       			<td width="280px" id="akun" style="padding-left: 30px;">'.$data['id_nama_coa'].' </td>
								<td width="150px" id="v_kas">Rp.'.number_format($data['saldo_debit']).'</th>
								<td width="150px" id="v_kas">Rp.'.number_format($data['saldo_kredit']).'</th>
                            </tr> ';
                         }    

    
    if ($record) {
            return $isi_html;
        
        }
        else {
            return FALSE;
        }
    
    }

    public function tampil_neraca($hari,$model)
    {
        if ($model=='kelompok') {
            $record['aktiva']=$this->Model_Laporan_keuangan->neraca_kelompok($hari);
            $record['pasiva']=$this->Model_Laporan_keuangan->neraca_kelompok($hari,'<>1');
        } else {
            $record['aktiva']=$this->Model_Laporan_keuangan->neraca($hari);
            $record['pasiva']=$this->Model_Laporan_keuangan->neraca($hari,'<>1');
        }
        
       
       if ($record) {
            return $record;
        
        }
        else {
            return FALSE;
        }
    
    }

    public function tampil_laba_rugi($hari,$model) 
    {
         if ($model=='kelompok') {
            
            $record['pendapatan']=$this->Model_Laporan_keuangan->labarugi_kelompok($hari,'4010000');
            $record['hpp']=$this->Model_Laporan_keuangan->labarugi_kelompok($hari,'5000000');
            $record['biaya_adm']=$this->Model_Laporan_keuangan->labarugi_kelompok($hari,'6000000');
            $record['biaya_penyusutan']=$this->Model_Laporan_keuangan->labarugi_kelompok($hari,'7000000');
            $record['biaya_pajak']=$this->Model_Laporan_keuangan->labarugi_kelompok($hari,'8010000');
         
         } else {
            $record['pendapatan']=$this->Model_Laporan_keuangan->labarugi($hari,'4010000');
            $record['hpp']=$this->Model_Laporan_keuangan->labarugi($hari,'5000000');
            $record['biaya_adm']=$this->Model_Laporan_keuangan->labarugi($hari,'6000000');
            $record['biaya_penyusutan']=$this->Model_Laporan_keuangan->labarugi($hari,'7000000');
            $record['biaya_pajak']=$this->Model_Laporan_keuangan->labarugi($hari,'8010000');
         }
         
                        $pendapatan=0;
                        $pendapatan_sebelumnya=0;
                        
                        $biaya_adm=0;
                        $biaya_adm_sebelumnya=0;
                        
                        $hpp=0;
                        $hpp_sebelumnya=0;
                        
                        $biaya_penyusutan=0;
                        $biaya_penyusutan_sebelumnya=0;
                        
                        $biaya_pajak=0;
                        $biaya_pajak_sebelumnya=0;

                        $laba_penjualan=0;
                        $laba_penjualan_sebelumnya=0;
            
                        $laba_operasional=0;
                        $laba_operasional_sebelumnya=0;
                        $laba_sebelum_pajak=0;
                        $laba_sebelum_pajak_sebelumnya=0;
        $isi_html='';
        $isi_html.='    			   ';
                            if ($record['pendapatan']) {
        $isi_html.= '
                           <tr>
                                <td id="kategori" class="bg-light-blue text-center" colspan="4"><b>'.$record['pendapatan'][0]['nama_kategori'].'</b> </td>
                           </tr>';
                            foreach ($record['pendapatan'] as $data) {
        $isi_html.='                     
                            <tr>
								<td width="280px" id="akun" style="padding-left: 30px;"> '.$data['id_nama_coa'].' </td>
                                <td width="100px" id="b_akun">Rp.'.number_format($data['total_saldo_sebelumnya']).' </td>
                                <td width="100px" id="b_akun">Rp.'.number_format($data['total_saldo']).' </td>
                                <td width="100px" id="b_akun">Rp.'.number_format($data['total_saldo_berjalan']).' </td>
                            </tr>';
                            $pendapatan=$data['total_saldo']; 
                            $pendapatan_sebelumnya=$data['total_saldo_sebelumnya']; }
                            }
                           
                            if ($record['hpp']) { 
        $isi_html.='                    
                            <tr>
                                <td id="kategori" class="bg-light-blue text-center" colspan="4"><b>'.$record['hpp'][0]['nama_kategori'].'</b> </td>
                            </tr>';
                            
                            foreach ($record['hpp'] as $data) {
        $isi_html.='
                            <tr>
								<td width="280px" id="akun" style="padding-left: 30px;"> '.$data['id_nama_coa'].' </td>
                                <td width="100px" id="b_akun">Rp.'.number_format(abs($data['total_saldo_sebelumnya'])).' </td>
                                <td width="100px" id="b_akun">Rp.'.number_format(abs($data['total_saldo'])).' </td>
                                <td width="100px" id="b_akun">Rp.'.number_format(abs($data['total_saldo_berjalan'])).' </td>
                            </tr>';

                            $hpp=$data['total_saldo']; 
                            $hpp_sebelumnya=$data['total_saldo_sebelumnya']; }
                            }
        $isi_html.='                            
                                    <tr>
                                    <th width="280px">Total Laba Kotor</th>
                                    <th width="100px">Rp.'.number_format($laba_penjualan_sebelumnya=$pendapatan_sebelumnya+$hpp_sebelumnya,2).'</th>
                                    <th width="100px">Rp.'.number_format($laba_penjualan=$pendapatan+$hpp,2) .'</th>
                                    <th width="100px">Rp.'.number_format($laba_penjualan+$laba_penjualan_sebelumnya,2) .'</th>
                                    </tr>';
                            /* <!-- Laba kotor --> */        
                            
                            if ($record['biaya_adm']) {
        $isi_html.='
                            <tr>
                                <td id="kategori" class="bg-light-blue text-center" colspan="4"><b>'.$record['biaya_adm'][0]['nama_kategori'].'</b> </td>
                            </tr>';
                            foreach ($record['biaya_adm'] as $data) { 
        $isi_html.='
                            <tr>
                               <td width="280px" id="akun" style="padding-left: 30px;">'.$data['id_nama_coa'].' </td>
                                <td width="100px" id="b_akun">Rp.'.number_format(abs($data['total_saldo_sebelumnya'])).' </td>
                                <td width="100px" id="b_akun">Rp.'.number_format(abs($data['total_saldo'])).' </td>
                                <td width="100px" id="b_akun">Rp.'.number_format(abs($data['total_saldo_berjalan'])).' </td>
                            </tr>';
                            $biaya_adm=$data['total_saldo']; $biaya_adm_sebelumnya=$data['total_saldo_sebelumnya']; } }
        $isi_html.='
                                <tr>
                                <th width="280px">Total Laba Operasional</th>
                                <th width="100px">Rp.'.number_format($laba_operasional_sebelumnya=$laba_penjualan_sebelumnya+$biaya_adm_sebelumnya,2).'</th>
                                <th width="100px">Rp.'.number_format($laba_operasional=$laba_penjualan+$biaya_adm,2).'</th>
                                <th width="100px">Rp.'.number_format($laba_operasional+$laba_operasional_sebelumnya,2).'</th>
                                </tr>';
                            
                            if ($record['biaya_penyusutan']) {
        $isi_html.= '
                            <tr>
                                <td id="kategori" class="bg-light-blue text-center" colspan="4"><b>'.$record['biaya_penyusutan'][0]['nama_kategori'].'</b> </td>
                            </tr>';
                            foreach ($record['biaya_penyusutan'] as $data) { 

        $isi_html.='
                            <tr>
                                <td width="280px" id="akun" style="padding-left: 30px;"> '.$data['id_nama_coa'].' </td>
                                <td width="100px" id="b_akun"> Rp.'.number_format(abs($data['total_saldo_sebelumnya'])).' </td>
                                <td width="100px" id="b_akun"> Rp.'.number_format(abs($data['total_saldo'])).' </td>
                                <td width="100px" id="b_akun"> Rp.'.number_format(abs($data['total_saldo_berjalan'])).' </td>
                            </tr>';
                            
                            $biaya_penyusutan=$data['total_saldo'];  $biaya_penyusutan_sebelumnya=$data['total_saldo_sebelumnya'];} }
        $isi_html.='                    
                            <tr>
                            <th width="280px">Total Laba Sebelum Pajak</th>
                            <th width="100px">Rp.'.number_format($laba_sebelum_pajak_sebelumnya=$laba_operasional_sebelumnya+$biaya_penyusutan_sebelumnya,2) .'</th>
                            <th width="100px">Rp.'.number_format($laba_sebelum_pajak=$laba_operasional+$biaya_penyusutan,2) .'</th>
                            <th width="100px">Rp.'.number_format($laba_sebelum_pajak_sebelumnya+$laba_sebelum_pajak,2) .'</th>
                            </tr>
                       
        ';
        if ($record['biaya_pajak']) {
        $isi_html.= '
                            <tr>
                                <td id="kategori" class="bg-light-blue text-center" colspan="4"><b>'.$record['biaya_pajak'][0]['nama_kategori'].'</b> </td>
                            </tr>';
                            foreach ($record['biaya_pajak'] as $data) { 

        $isi_html.='
                            <tr>
                                <td width="280px" id="akun" style="padding-left: 30px;"> '.$data['id_nama_coa'].' </td>
                                <td width="100px" id="b_akun"> Rp.'.number_format(abs($data['total_saldo_sebelumnya'])).' </td>
                                <td width="100px" id="b_akun"> Rp.'.number_format(abs($data['total_saldo'])).' </td>
                                <td width="100px" id="b_akun"> Rp.'.number_format(abs($data['total_saldo_berjalan'])).' </td>
                            </tr>';
                            
                            $biaya_pajak=$data['total_saldo'];  $biaya_pajak_sebelumnya=$data['total_saldo_sebelumnya'];}     
        $isi_html.='                    
                            <tr>
                            <th width="280px">Total Laba Sesudah Pajak</th>
                            <th width="100px">Rp.'.number_format($laba_sesudah_pajak_sebelumnya=$laba_sebelum_pajak+$biaya_pajak_sebelumnya,2) .'</th>
                            <th width="100px">Rp.'.number_format($laba_sesudah_pajak=$laba_sebelum_pajak+$biaya_pajak ,2) .'</th>
                            <th width="100px">Rp.'.number_format($laba_sesudah_pajak_sebelumnya+$laba_sesudah_pajak,2) .'</th>
                            </tr>               
        ';
        
        }

        if ($record) {
            return $isi_html;
        
        }
        else {
            return FALSE;
        }
    }

    public function excel_laporan_keuangan($bentuk='neraca')
    {
        $hari=NULL;
        
        if ($_POST) {
               $hari= stripslashes("\'".date_format(date_create($_POST['hari']),"Y-m-d")."\'");
            
        }

        if ($bentuk=='neraca') {
        //Neraca
        
            $data['record']['aktiva']=$this->Model_Laporan_keuangan->neraca($hari);
            $data['record']['pasiva']=$this->Model_Laporan_keuangan->neraca($hari,'<>1');
            
                $namaFile = "Laporan_neraca.xls";
                $judul = "Laporan Neraca";
                $tablehead = 4;
                $tablebody = $tablehead+1;
                $nourut = 1;
                
                //penulisan header
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");
                header("Content-Disposition: attachment;filename=".$namaFile ."");
                header("Content-Transfer-Encoding: binary ");

                xlsBOF();
                xlsWriteLabel(0, 0, "Laporan Neraca");
                xlsWriteLabel(1, 0, "Periode ".$_POST['hari']."");

                $kolomhead = 0;
                xlsWriteLabel($tablehead, $kolomhead++, "Deskripsi");
                xlsWriteLabel($tablehead, $kolomhead++, " ");
                xlsWriteLabel($tablehead, $kolomhead++, "Bulan Sebelumnya");
                xlsWriteLabel($tablehead, $kolomhead++, $_POST['hari']);
                xlsWriteLabel($tablehead, $kolomhead++, "Berjalan");
                

                foreach ($data['record']['aktiva'] as $record)//$this->Model_Admin->laporan_excel_penjualan($w_awal,$w_akhir) as $record) {
                {

                    $kolombody = 0;
                    
                    //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                    
                    xlsWriteLabel($tablebody, $kolombody++,$record['nama_kategori']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['id_nama_coa']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_sebelumnya']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_berjalan']);
                      
                $tablebody++;
                
                }

                foreach ($data['record']['pasiva'] as $record)//$this->Model_Admin->laporan_excel_penjualan($w_awal,$w_akhir) as $record) {
                {

                    $kolombody = 0;
                    
                    //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                    
                    xlsWriteLabel($tablebody, $kolombody++,$record['nama_kategori']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['id_nama_coa']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_sebelumnya']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_berjalan']);
                      
                $tablebody++;
                
                }   
                xlsEOF();
                exit();

        }
        else {
        //Laba Rugi
            $namaFile = "Laporan_laba_rugi.xls";
            $judul = "Laporan laba rugi";
       
            $data['record']['pendapatan']=$this->Model_Laporan_keuangan->labarugi($hari,40);
            $data['record']['hpp']=$this->Model_Laporan_keuangan->labarugi($hari,60);
            $data['record']['biaya_adm']=$this->Model_Laporan_keuangan->labarugi($hari,51);
            $data['record']['biaya_penyusutan']=$this->Model_Laporan_keuangan->labarugi($hari,52);

                $tablehead = 4;
                $tablebody = $tablehead+1;
                $nourut = 1;
                
                //penulisan header
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");
                header("Content-Disposition: attachment;filename=" . $namaFile . "");
                header("Content-Transfer-Encoding: binary ");

                xlsBOF();
                xlsWriteLabel(0, 0, "Laporan Laba rugi");
                xlsWriteLabel(1, 0, "Periode ".$_POST['hari']."");

                $kolomhead = 0;
                xlsWriteLabel($tablehead, $kolomhead++, "Deskripsi");
                $kolomhead++;
                xlsWriteLabel($tablehead, $kolomhead++, "Bulan Sebelumnya");
                xlsWriteLabel($tablehead, $kolomhead++, $_POST['hari']);
                xlsWriteLabel($tablehead, $kolomhead++, "Berjalan");

                
                        $pendapatan=0;
                        $pendapatan_sebelumnya=0;
                        $hpp=0;
                        $hpp_sebelumnya=0;
                        
                        $biaya_adm=0;
                        $biaya_adm_sebelumnya=0;
                        $biaya_penyusutan=0;
                        $biaya_penyusutan_sebelumnya=0;

                        $laba_kotor=0;
                        $laba_kotor_sebelumnya=0;
                        $laba_operasional=0;
                        $laba_operasional_sebelumnya=0;
                        $laba_sebelum_pajak=0;
                        $laba_sebelum_pajak_sebelumnya=0;

                foreach ($data['record']['pendapatan'] as $record)//$this->Model_Admin->laporan_excel_penjualan($w_awal,$w_akhir) as $record) {
                {

                    $kolombody = 0;
                    $pendapatan=$record['total_saldo'];
                    $pendapatan_sebelumnya=$record['total_saldo_sebelumnya'];

                    //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                    
                    xlsWriteLabel($tablebody, $kolombody++,$record['nama_kategori']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['id_nama_coa']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_sebelumnya']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_berjalan']);
                      
                $tablebody++;
                
                }

                foreach ($data['record']['hpp'] as $record)//$this->Model_Admin->laporan_excel_penjualan($w_awal,$w_akhir) as $record) {
                {

                    $kolombody = 0;
                    $hpp=$record['total_saldo'];
                    $hpp_sebelumnya=$record['total_saldo_sebelumnya'];

                    //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                    
                    xlsWriteLabel($tablebody, $kolombody++,$record['nama_kategori']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['id_nama_coa']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_sebelumnya']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_berjalan']);
                      
                $tablebody++;
                
                }

                    $kolombody = 1;
                    xlsWriteLabel($tablebody,  $kolombody++, 'Laba Kotor');
                    xlsWriteNumber($tablebody, $kolombody++, $laba_kotor_sebelumnya=$pendapatan_sebelumnya+$hpp_sebelumnya);
                    xlsWriteNumber($tablebody, $kolombody++, $laba_kotor=$pendapatan+$hpp);
                    xlsWriteNumber($tablebody, $kolombody++, $laba_kotor+$laba_kotor_sebelumnya);
                    $tablebody++;
                

                /* Akhir Laba Kotor */
    
                foreach ($data['record']['biaya_adm'] as $record)//$this->Model_Admin->laporan_excel_penjualan($w_awal,$w_akhir) as $record) {
                {

                    $kolombody = 0;
                    $biaya_adm=$record['total_saldo'];
                    $biaya_adm_sebelumnya=$record['total_saldo_sebelumnya'];

                    //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                    
                    xlsWriteLabel($tablebody, $kolombody++,$record['nama_kategori']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['id_nama_coa']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_sebelumnya']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_berjalan']);
                    $tablebody++;
                }

                    $kolombody = 1;
                    xlsWriteLabel($tablebody,  $kolombody++, 'Laba Operasional');
                    xlsWriteNumber($tablebody, $kolombody++, $laba_operasional_sebelumnya=$laba_kotor_sebelumnya+$biaya_adm_sebelumnya);
                    xlsWriteNumber($tablebody, $kolombody++, $laba_operasional=$laba_kotor+$biaya_adm);
                    xlsWriteNumber($tablebody, $kolombody++, $laba_operasional+$laba_operasional_sebelumnya);
                    $tablebody++;
                
            
            /* Akhir Laba Operasional  */
            
                foreach ($data['record']['biaya_penyusutan'] as $record)//$this->Model_Admin->laporan_excel_penjualan($w_awal,$w_akhir) as $record) {
                {

                    $kolombody = 0;
                    $biaya_penyusutan=$record['total_saldo'];
                    $biaya_penyusutan_sebelumnya=$record['total_saldo_sebelumnya'];

                    //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                    
                    xlsWriteLabel($tablebody, $kolombody++,$record['nama_kategori']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['id_nama_coa']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_sebelumnya']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo']);
                    xlsWriteLabel($tablebody, $kolombody++,$record['total_saldo_berjalan']);
                      
                $tablebody++;
                
                }

                    $kolombody = 1;
                    xlsWriteLabel($tablebody, $kolombody++, 'Laba Sebelum Pajak');
                    xlsWriteNumber($tablebody, $kolombody++, $laba_sebelum_pajak_sebelumnya=$laba_operasional_sebelumnya+$biaya_penyusutan_sebelumnya);
                    xlsWriteNumber($tablebody, $kolombody++, $laba_sebelum_pajak=$laba_operasional+$biaya_penyusutan);
                    xlsWriteNumber($tablebody, $kolombody++, $laba_sebelum_pajak+$laba_sebelum_pajak_sebelumnya);
                    $tablebody++;
                
                    
                    /*Akhir Laba Sebelum Pajak  */
                xlsEOF();
                exit();
        }
            
        
            if (!$data['record']) {
                $this->session->set_flashdata('message_failed', 'Data Tidak Ditemukan');
                redirect(base_url('laporan_keuangan/panel_laporan_keuangan'),'refresh');
            }

            $data['hari']=$_POST['hari'];
            //print_r($data);
            $this->template->load('template_admin','akuntansi_'.$bentuk.'',$data);
            
    }
    
}