<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Akuntansi extends CI_Model {

//list coa
function list_coa($kondisi)
{
    
    $this->db->select('a.*');
    $this->db->from('akuntansi_m_coa a');
    $this->db->join('akuntansi_m_kelompok_coa b', 'a.id_kelompok_coa = b.uniqid', 'left');
    switch ($kondisi) {
        case 'kb':
            $this->db->where('b.id_kelompok_coa=1011000 or b.id_kelompok_coa=1012000 ');
            break;
        
        case 'invkb':
            $this->db->where('b.id_kelompok_coa<>1011000 and b.id_kelompok_coa<>1012000 ');
            break;
        
        case 'stock':
            $this->db->where('b.id_kelompok_coa=1014000');
            break;
            
        case 'pengeluaran':
            $this->db->where('left(b.id_kelompok_coa,3)=601 or left(b.id_kelompok_coa,3)=800');
            break;

        case 'pendapatan':
            $this->db->where('left(b.id_kelompok_coa,3)=601');
            break;
        
        default:
            # code...
            break;
    }
    
    $this->db->order_by('id_coa', 'asc');
    
    return $this->db->get()->result_array();
}

//Laporan Jurnal
function laporanjurnal($hari,$hari_akhir)
{
    
    $this->db->select(' DATE_FORMAT(waktu,"%d-%m-%Y") as waktu,
                        id_coa,inversid_coa,
                        nama_coa,inversnama_coa,
                        debit,invers_debit,
                        kredit,invers_kredit,
                        keterangan,
                        (@row:=@row+1) as id_row');
    $this->db->from('laporan_jurnal,(select @row:=0)as r');
    $this->db->where('status',1);
    if ($hari<>NULL) {
        $this->db->where('date(eod) between date('.$hari.') and date('.$hari_akhir.')' );
    }
    else{
        $this->db->where('eod',0);
    } 
    
    return $this->db->get()->result_array();
    
}

//Buku besar
function buku_besar($coa,$hari,$hari_akhir)
{    
    $this->db->select('DATE_FORMAT(waktu,"%d-%m-%Y") as waktu,id_detail,keterangan,debit,kredit,id_coa,nama_coa,(x.saldo_sebelumnya+buku_besar.saldo_awal)as saldo_awal_ok,(x.saldo_sebelumnya+buku_besar.saldo_awal+@s:=@s+nilai_voucher) as saldo');
    if ($hari<>NULL) {
        $this->db->from('buku_besar,
                    (select @s:=0) as v_saldo,
                    (select sum(if(DATE(eod)<DATE('.$hari.'),(nilai_voucher),0)) as saldo_sebelumnya from buku_besar where id_coa='.$coa.' ) as x 
                    ');
        $this->db->where('eod between date('.$hari.') and date('.$hari_akhir.')' );
    
    }
    else {
        $this->db->from('buku_besar,
                    (select @s:=0) as v_saldo0,
                    (select sum(if(DATE(eod)<curdate() and date(eod)>0,(nilai_voucher),0)) as saldo_sebelumnya from buku_besar where id_coa='.$coa.' ) as x 
                    ');    
        $this->db->where('eod',0);
    }
    $this->db->where('status',1);
    $this->db->where('id_coa',$coa);
    $this->db->order_by('id_detail', 'asc');
    
    
    return $this->db->get()->result_array();   
}

//Laporan Stock
function substock($hari,$hari_akhir,$coa)
{

    $this->db->select('id_coa_stock,
                        nama_stock,
                        keterangan,
                        Date_format(eod,"%d-%m-%Y") as waktu,
                        (@s_q:=quantity_awal+IFNULL(x.saldo_awal_quantity,0))as saldo_quantity_awal,
                        (@s_n:=total_nilai_stock_awal+IFNULL(x.saldo_awal_total,0))as saldo_nilai_awal,
                        (@s_a:=IFNULL(@s_n/@s_q,0))as saldo_price_awal,

                        debit_stock,
                        if((debit_stock>0),harga_beli,0)as harga_beli_debit,
                        if((debit_stock>0),(harga_beli*debit_stock),0)as total_nilai_debit,
                        
                        kredit_stock,
                        if((kredit_stock>0),harga_beli,0)as harga_beli_kredit, 
                        if((kredit_stock>0),(harga_beli*kredit_stock),0)as total_nilai_kredit, 

                        (@s_q+@saldo_q_akhir:=@saldo_q_akhir+debit_stock-kredit_stock)as saldo_quantity_stock,
                        (@s_n+@saldo_n_akhir:=@saldo_n_akhir+total_nilai_stock)as saldo_nilai_stock, 
                        (@saldo_p_akhir:=(@s_n+@saldo_n_akhir)/(@s_q+@saldo_q_akhir)) as rata_nilai_stock'); 
        $this->db->where('status',1);

     if ($hari!=0) {
        $hari=stripslashes("\'".$hari."\'");
        $hari_akhir=stripslashes("\'".$hari_akhir."\'");
        $this->db->where('date(eod) between '.$hari.' and '.$hari_akhir.'' );
        $this->db->from('laporan_stock,
                        (select SUM(debit_stock-kredit_stock) as saldo_awal_quantity,SUM(total_nilai_stock) as saldo_awal_total from laporan_stock  where eod < '.$hari.' and id_coa_stock='.$coa.' ) as x, 
                        (select @s_a:=0,@s_n:=0)as q,
                        (select @s_q:=0) as q1,
                        (select @saldo_q_akhir:=0) as q2,
                        (select @saldo_p_akhir:=0) as q3,
                        (select @saldo_n_akhir:=0) as q4');
    } else {
        $this->db->where('eod',0);
        $this->db->from('laporan_stock,
                        (select SUM(debit_stock-kredit_stock) as saldo_awal_quantity,SUM(total_nilai_stock) as saldo_awal_total from laporan_stock  where eod < curdate() and eod > 0 and id_coa_stock='.$coa.' ) as x, 
                        (select @s_a:=0,@s_n:=0)as q,
                        (select @s_q:=0) as q1,
                        (select @saldo_q_akhir:=0) as q2,
                        (select @saldo_p_akhir:=0) as q3,
                        (select @saldo_n_akhir:=0) as q4');
    }
    $this->db->where('id_coa_stock',$coa);
    $this->db->group_by('uniqid');
    
     return $this->db->get()->result_array();
    
}

function laporan_stockopname($hari,$hari_akhir)
{

    $this->db->select('nama_stock,
                        
                        @s_q:=quantity_awal+IFNULL(x.saldo_awal_quantity,0) as saldo_quantity_awal,
                        @s_n:=total_nilai_stock_awal+IFNULL(x.saldo_awal_total,0) as saldo_nilai_awal,
                        @s_a:=IFNULL(@s_n/@s_q,0) as saldo_price_awal,
                        x.saldo_awal_quantity,

                        SUM(debit_stock) as debit_stock,
                        (@total_debit:=SUM(CASE WHEN debit_stock > 0 THEN total_nilai_stock ELSE 0 END)) as total_debit,
                        (SUM(CASE WHEN debit_stock > 0 THEN total_nilai_stock ELSE 0 END)/SUM(debit_stock)) as price_debit,

                        SUM(kredit_stock) as kredit_stock,
                        (@total_kredit:=SUM(CASE WHEN kredit_stock > 0 THEN total_nilai_stock ELSE 0 END)) as total_kredit,
                        (SUM(CASE WHEN kredit_stock > 0 THEN total_nilai_stock ELSE 0 END)/SUM(kredit_stock)) as price_kredit,

                        @s_q_akhir:=quantity_awal+IFNULL(x.saldo_awal_quantity,0)+SUM(debit_stock-kredit_stock) as saldo_quantity_akhir,
                        @s_n_akhir:=total_nilai_stock_awal+IFNULL(x.saldo_awal_total,0)+SUM(total_nilai_stock) as total_nilai_stock,
                        @s_p_akhir:=((total_nilai_stock_awal+IFNULL(x.saldo_awal_total,0)+SUM(total_nilai_stock))/(quantity_awal+IFNULL(x.saldo_awal_quantity,0)+SUM(debit_stock-kredit_stock))) as rata_nilai_stock,

                        '); 

     $this->db->where('status',1);
    if ($hari<>0) {
        $hari=stripslashes("\'".$hari."\'");
        $hari_akhir=stripslashes("\'".$hari_akhir."\'");
        $this->db->where('date(eod) between '.$hari.' and '.$hari_akhir.'' );
        $this->db->from('   laporan_stock,
                            (select @s_q:=0)as q,
                            (select @s_a:=0)as q1,
                            (select @s_n:=0)as q2,
                            (select @total_debit:=0)as d1,
                            (select @total_kredit:=0)as d2,  
                            (select @saldo_q_akhir:=0) as qs2,
                            (select @saldo_p_akhir:=0) as qs3,
                            (select @saldo_n_akhir:=0) as qs4');
        $this->db->join('(select id_coa_stock as id, IFNULL(SUM(debit_stock-kredit_stock),0) as saldo_awal_quantity,IFNULL(SUM(total_nilai_stock),0) as saldo_awal_total 
                        from laporan_stock  where eod < '.$hari.' group by id_coa_stock ) as x',
                        'laporan_stock.id_coa_stock = x.id', 'left');
        
    } 
    else {
        $this->db->where('eod',0);
        $this->db->from('   laporan_stock,
                            (select @s_q:=0)as q,
                            (select @s_a:=0)as q1,
                            (select @s_n:=0)as q2,
                            (select @total_debit:=0)as d1,
                            (select @total_kredit:=0)as d2,  
                            (select @saldo_q_akhir:=0) as qs2,
                            (select @saldo_p_akhir:=0) as qs3,
                            (select @saldo_n_akhir:=0) as qs4');
        $this->db->join('(select id_coa_stock as id, IFNULL(SUM(debit_stock-kredit_stock),0) as saldo_awal_quantity,IFNULL(SUM(total_nilai_stock),0) as saldo_awal_total 
                        from laporan_stock where date(eod) < date(now()) and eod > 0 group by id_coa_stock ) as x',
                        'laporan_stock.id_coa_stock = x.id', 'left');
        
    } 
     $this->db->group_by('id_coa_stock');
    
    return $this->db->get()->result_array();
    
}

function trial_balance($hari)
{
            $t_string=stripcslashes("\'Total\'");
            $this->db->select('coalesce(id_nama_coa,'.$t_string.') as id_nama_coa, 
                                sum(nilai_debit) as saldo_debit,
                                sum(nilai_kredit) as saldo_kredit,
                                eod');
            $this->db->from('trial_balance');
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
            $this->db->from('laba_rugi,(select @s:=0,@kat:=0) as v_saldo,(select @s_awal:=0) as a_saldo');
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
            $this->db->from('laba_rugi,(select @s:=0,@kat:=0) as v_saldo,(select @s_awal:=0) as a_saldo');
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
            $this->db->from('   neraca,
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
            $this->db->from('   neraca,
                                (select @s:=0,@kat:=0) as v_saldo,
                                (select @s_awal:=0) as xde');
            $this->db->where('left(id_coa,1)'.$bagian.'');
            if ($hari) {
                $this->db->where('(Year(eod) = Year('.$hari.') or (eod is null and saldo_awal<>0))');
            }
            
            $this->db->group_by('nama_kategori asc,id_nama_kelompok_coa asc with rollup',FALSE);
            return $detail=$this->db->get()->result_array();
        
    
}
/* Voucher Akuntansi */
function list_voucher($status,$tipe)
{
    $this->db->select('a.id_voucher,
                        concat(id_tipe_voucher,DATE_FORMAT(a.waktu,"%y%m"),right(concat(prefix_number,id_voucher),4))as id_voucherjurnal,
                        uniqid');
		$this->db->from('akuntansi_h_voucher a');
		
        if (isset($status)) {
            $this->db->where('status', $status);
        }
		
        if (isset($status)) {
        $this->db->where('status', $status);
            $this->db->where('id_tipe_voucher', $tipe);
        }
        
        return $this->db->get()->result_array();
}

function simpan_voucher($table,$data,$uniqid)
{
    $this->db->set('uniqid',$uniqid);
	$this->db->insert($table,$data);
}

function detail_voucher($table,$data,$uniqid,$session)
{
    $this->db->set('uniqid','UUID_SHORT()',FALSE);
    $this->db->set('uniqid_voucher',$uniqid);
    $this->db->set('id_session',$session);
    $this->db->insert($table,$data);
}

function detail_stock($table,$data,$uniqid)
{
    $this->db->set('uniqid','UUID_SHORT()',FALSE);
    $this->db->set('uniqid_voucher',$uniqid);
    $this->db->insert($table,$data);
}

function hapus_item($table,$uniqid)
{
    $this->db->where('id_session', $uniqid);
    $this->db->delete($table);
    
}

/* Stock Opname */

function stockopname($table,$table_stock,$data,$uniqid)
{
    $id_session=uniqid("",TRUE);

    $stock=$data['stock'];
    $record=$data['record'];
    $inversrecord=$data['inversrecord'];

    $data_harga=$this->substock(0,0,$record['id_coa']);
    $data_harga=$data_harga[count($data_harga)-1];
    
    $current_stock=$data_harga['saldo_quantity_stock'];
    $harga_sementara=$data_harga['rata_nilai_stock'];
    $stock['kredit_stock']=$current_stock-$stock['saldo_quantity_akhir'];
    $grand_total=$harga_sementara*$stock['kredit_stock'];

        $record['kredit']       =   $grand_total;
        $inversrecord['debit']  =   $grand_total;
        $stock['harga_beli']    =   $harga_sementara;
        $stock['total_nilai_stock']    =$grand_total;

    $this->detail_stock($table_stock,$stock,$uniqid);
    $this->detail_voucher($table,$record,$uniqid,$id_session);
    $this->detail_voucher($table,$inversrecord,$uniqid,$id_session);

    return $stock;
}

/* Verifikasi Jurnal */
function jsondaftarjurnal() {
    $this->datatables->select('uniqid,id_voucher,concat(id_tipe_voucher,DATE_FORMAT(waktu,"%y%m"),right(concat(prefix_number,id_voucher),4))as id_voucherjurnal,DATE_FORMAT(waktu,"%d-%m-%Y") as waktu,status');
    $this->datatables->from('akuntansi_h_voucher');
    $this->datatables->add_column('action',"tes");
    return $this->datatables->generate();
}

function tampilvoucher($uniqid)
{
    $this->db->select('a.id_voucher,
                            concat(id_tipe_voucher,DATE_FORMAT(a.waktu,"%y%m"),right(concat(prefix_number,id_voucher),4))as id_voucherjurnal,
                            a.waktu,
                            a.id_tipe_voucher,
                            b.id_session,
							(b.debit-b.kredit) as price,
                            b.keterangan
							');
		$this->db->from('akuntansi_h_voucher a');
		$this->db->join('akuntansi_detail_voucher b','a.uniqid=b.uniqid_voucher','left');	
		$this->db->where('a.uniqid',$uniqid);
        $this->db->group_by('b.id_session');
        $this->db->order_by('id_detail', 'asc');
        
        
        return $this->db->get()->result_array();
		
}

function tampilstock($uniqid)
{
    $this->db->select('b.*,
                      concat(id_tipe_voucher,DATE_FORMAT(a.waktu,"%y%m"),right(concat(prefix_number,id_voucher),4))as id_voucherjurnal,
						a.id_tipe_voucher');
		$this->db->from('akuntansi_h_voucher a');
		$this->db->join('laporan_stock b','a.uniqid=b.uniqid_voucher','left');	
		//$this->db->join('akuntansi_detail_stock c','a.uniqid=c.uniqid_voucher','left');	
		$this->db->where('a.uniqid',$uniqid);
        //$this->db->group_by('b.id_session');

        return $this->db->get()->result_array();
		
}

function ubahstatus($uniqid,$data)
{
    
    $this->db->where('uniqid', $uniqid);
    $this->db->where('status', 0);
    $this->db->update('akuntansi_h_voucher', $data);
    
}


}

/* End of file ModelName.php */
