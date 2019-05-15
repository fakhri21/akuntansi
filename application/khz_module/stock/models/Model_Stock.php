<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Stock extends CI_Model {

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

}

/* End of file ModelName.php */
