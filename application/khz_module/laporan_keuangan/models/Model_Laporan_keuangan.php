<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Laporan_keuangan extends CI_Model {
function trial_balance($hari)
{
            $t_string=stripcslashes("\'Total\'");
            $this->db->select('coalesce(id_nama_coa,'.$t_string.') as id_nama_coa, 
                                sum(nilai_debit) as saldo_debit,
                                sum(nilai_kredit) as saldo_kredit,
                                eod');
            $this->db->from('akuntansi_trial_balance');
            if ($hari) {
            $this->db->where('eod <= '.$hari.'');
            }
            $this->db->group_by('id_nama_coa asc with rollup',FALSE);
            
            return $detail=$this->db->get()->result_array();
        
}

// neraca dan laba rugi
function labarugi($hari,$bagian='4010000')
{
    $total_saldo_sebelumnya='@s_awal:=sum((if(id_coa=@s,0,saldo_awal))+(if(month(eod)<month('.$hari.') or (eod is null and saldo_awal<>0),saldo,0))) as total_saldo_sebelumnya';
    $total_saldo='(sum(if(month(eod)=month('.$hari.'),saldo,0))) as total_saldo';
    $total_saldo_berjalan='@s_awal+(sum(if(month(eod)=month('.$hari.'),saldo,0))) as total_saldo_berjalan';

    $t_string=stripcslashes("\'<b>Total\</b>'");
            $this->db->select('ifnull(id_nama_coa,'.$t_string.') as id_nama_coa, 
                            left(id_kategori,1) as jenis,
                            if(nama_kategori=@kat,NULL,nama_kategori) as nama_kategori,
                            (@kat:=nama_kategori),
                            '.$total_saldo_sebelumnya.',
                            '.$total_saldo.', 
                            '.$total_saldo_berjalan.',
                            (@s:=id_coa)
                            ',FALSE);
            $this->db->from('akuntansi_laba_rugi,(select @s:=0,@kat:=0) as v_saldo,(select @s_awal:=0) as a_saldo');
            $this->db->where('id_kategori',$bagian);
            if ($hari) {
            $this->db->where('(Year(eod) = Year('.$hari.') or (eod is null and saldo_awal<>0))');
            }
            $this->db->group_by('id_nama_coa asc with rollup',FALSE);
            
            return $detail=$this->db->get()->result_array();
        
}

function labarugi_kelompok($hari,$bagian='4010000')
{
    $total_saldo_sebelumnya='@s_awal:=sum((if(id_coa=@s,0,saldo_awal))+(if(month(eod)<month('.$hari.') or (eod is null and saldo_awal<>0),saldo,0))) as total_saldo_sebelumnya';
    $total_saldo='(sum(if(month(eod)=month('.$hari.'),saldo,0))) as total_saldo';
    $total_saldo_berjalan='@s_awal+(sum(if(month(eod)=month('.$hari.'),saldo,0))) as total_saldo_berjalan';

    $t_string=stripcslashes("\'<b>Total\</b>'");
            $this->db->select('ifnull(id_nama_kelompok_coa,'.$t_string.') as id_nama_coa, 
                            left(id_kategori,1) as jenis,
                            if(nama_kategori=@kat,NULL,nama_kategori) as nama_kategori,
                            (@kat:=nama_kategori),
                            '.$total_saldo_sebelumnya.',
                            '.$total_saldo.', 
                            '.$total_saldo_berjalan.',
                            (@s:=id_coa)
                            ',FALSE);
            $this->db->from('akuntansi_laba_rugi,(select @s:=0,@kat:=0) as v_saldo,(select @s_awal:=0) as a_saldo');
            $this->db->where('id_kategori',$bagian);
            if ($hari) {
            $this->db->where('(Year(eod) = Year('.$hari.') or (eod is null and saldo_awal<>0))');
            }
            $this->db->group_by('id_nama_kelompok_coa asc with rollup',FALSE);
            
            return $detail=$this->db->get()->result_array();
        
}
function neraca($hari,$bagian='=1')
{
    
    $total_saldo_sebelumnya='@s_awal:=sum((if(id_coa=@s,0,saldo_awal))+(if(month(eod)<month('.$hari.') or (eod is null and saldo_awal<>0),saldo,0))) as total_saldo_sebelumnya';
    $total_saldo='@s_awal+(sum(if(month(eod)=month('.$hari.'),saldo,0))) as total_saldo';
    $total_saldo_berjalan='@s_awal+(sum(if(month(eod)=month('.$hari.'),saldo,0))) as total_saldo_berjalan';

    $t_string=stripcslashes("\'<b>&nbsp; &nbsp;Total \</b> '");
            $this->db->select('ifnull(id_nama_coa,concat('.$t_string.',nama_kategori)) as id_nama_coa, 
                            left(id_kategori,1) as jenis,
                            if(nama_kategori=@kat,NULL,nama_kategori) as nama_kategori,
                            (@kat:=nama_kategori),
                            '.$total_saldo_sebelumnya.',
                            '.$total_saldo.', 
                            '.$total_saldo_berjalan.', 
                            (@s:=id_coa) 
                            ',FALSE);
            $this->db->from('   akuntansi_neraca,
                                (select @s:=0,@kat:=0) as v_saldo,
                                (select @s_awal:=0) as xde');
            $this->db->where('left(id_coa,1)'.$bagian.'');
            if ($hari) {
                $this->db->where('(Year(eod) = Year('.$hari.') or (eod is null and saldo_awal<>0))');
            }
            
            $this->db->group_by('nama_kategori asc,id_nama_coa asc with rollup',FALSE);
            return $detail=$this->db->get()->result_array();
        
    
}

function neraca_kelompok($hari,$bagian='=1')
{
    
    $total_saldo_sebelumnya='@s_awal:=sum((if(id_coa=@s,0,saldo_awal))+(if(month(eod)<month('.$hari.') or (eod is null and saldo_awal<>0),saldo,0))) as total_saldo_sebelumnya';
    $total_saldo='@s_awal+(sum(if(month(eod)=month('.$hari.'),saldo,0))) as total_saldo';
    $total_saldo_berjalan='@s_awal+(sum(if(month(eod)=month('.$hari.'),saldo,0))) as total_saldo_berjalan';

    $t_string=stripcslashes("\'<b>&nbsp; &nbsp;Total \</b> '");
            $this->db->select('ifnull(id_nama_kelompok_coa,concat('.$t_string.',nama_kategori)) as id_nama_coa, 
                            left(id_kategori,1) as jenis,
                            if(nama_kategori=@kat,NULL,nama_kategori) as nama_kategori,
                            (@kat:=nama_kategori),
                            '.$total_saldo_sebelumnya.',
                            '.$total_saldo.', 
                            '.$total_saldo_berjalan.', 
                            (@s:=id_coa) 
                            ',FALSE);
            $this->db->from('   akuntansi_neraca,
                                (select @s:=0,@kat:=0) as v_saldo,
                                (select @s_awal:=0) as xde');
            $this->db->where('left(id_coa,1)'.$bagian.'');
            if ($hari) {
                $this->db->where('(Year(eod) = Year('.$hari.') or (eod is null and saldo_awal<>0))');
            }
            
            $this->db->group_by('nama_kategori asc,id_nama_kelompok_coa asc with rollup',FALSE);
            return $detail=$this->db->get()->result_array();
        
    
}

}

/* End of file ModelName.php */
