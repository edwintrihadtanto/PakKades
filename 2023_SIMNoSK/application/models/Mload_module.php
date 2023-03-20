<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mload_module extends CI_Model{
    var $table          = 'ecc_kendali';
    var $column_order   = array('no_kwitansi','nm_rekanan','rpkwitansi',null);
    var $column_search  = array('no_kwitansi','nm_rekanan', 'ket');
    var $order          = array('tgl_entry' => 'DESC ');
        
    var $column_order1   = array('ek.no_kwitansi','ek.nm_rekanan','ek.rpkwitansi',null);
    var $column_search1  = array('ek.no_kwitansi','ek.nm_rekanan','ek.ket');
    var $order1          = array('ek.tgl_entry' => 'DESC ');

    function _get_datatables_query_listrekanan($tahun, $where, $pil)
    {        
        //$criteria = "date(tgl_entry)::text LIKE '%".$tahun."%' ";
        $this->db->select("*");
        $this->db->from("ecc_kendali"); 
        
        if ($pil == 1){ //form kendali
            $this->db->where("date(tgl_entry)::text LIKE '%".$tahun."%' and sts_verifawal = 0");
        }else if ($pil == 2){ //verif awal
            $this->db->where("date(tgl_entry)::text LIKE '%".$tahun."%' and sts_verifawal = 0");
        }else if ($pil == 3){ //verif tahap lanjut
            $this->db->where("date(tgl_entry)::text LIKE '%".$tahun."%' and sts_verifawal = 1");
        }
        
        $this->db->order_by("id_form", "DESC");
        $this->db->limit(100);
        $i = 0;
    
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function _get_datatables_query_listverifstep2($tahun, $where, $pil){
        $this->db->select("
            ek.id_form,
            ek.no_kwitansi,
            ek.nm_rekanan,
            ek.rpkwitansi,
            ek.ket,
            ek.tgl_kwitansi,
            ek.sts_verifawal,
            ek.sts_verifkedua,
            ek.tgl_entry,
            vs.no_in,
            vs.jns_laporan
            ");
        $this->db->from('ecc_kendali ek');
        $this->db->join('verif_step2 vs', 'ek.no_kwitansi = vs.no_kwitansi','LEFT');
        $this->db->where("date(ek.tgl_entry)::text LIKE '%".$tahun."%' and ek.sts_verifawal = 1");        
        $this->db->limit(100);

        $i = 0;
    
        foreach ($this->column_search1 as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search1) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order1[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else if(isset($this->order1))
        {
            $order = $this->order1;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($tahun, $where, $pil)
    {
        if ($pil == 3){
            $this->_get_datatables_query_listverifstep2($tahun, $where, $pil);
        }else{
            $this->_get_datatables_query_listrekanan($tahun, $where, $pil);
        }
        
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    function count_filtered($tahun,$where, $pil)
    {
        $this->_get_datatables_query_listrekanan($tahun,$where, $pil);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all_verifstp2($tahun)
    {
        $this->db->from('ecc_kendali ek');
        $this->db->join('verif_step2 vs', 'ek.no_kwitansi = vs.no_kwitansi','LEFT');
        $this->db->where("date(ek.tgl_entry)::text LIKE '%".$tahun."%' and ek.sts_verifawal = 1");        
        return $this->db->count_all_results();
    }
    function count_filtered_verifstp2($tahun,$where, $pil)
    {
        $this->_get_datatables_query_listverifstep2($tahun,$where, $pil);
        $query = $this->db->get();
        return $query->num_rows();
    }

    // -------------LIST USERS--------------------
    function get_datatables_listuser()
    {
        $this->_get_datatables_query_listuser();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_all_users()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    function count_filtered_users()
    {
        $this->_get_datatables_query_listuser();
        $query = $this->db->get();
        return $query->num_rows();
    }


    function delete_listform($idform, $no_kwitansi)
    {
        $result = $this->db->query("DELETE FROM ecc_kendali WHERE id_form = '$idform' AND no_kwitansi = '$no_kwitansi'");
        return $result;
    }

    function get_datakendalix($idform, $no_kwitansi)
    {
        $result = $this->db->query("SELECT * FROM ecc_kendali WHERE id_form = '$idform' AND no_kwitansi = '$no_kwitansi'");
        return $result;   
    }
    function update_form_kartukendali($data, $where)
    {
        $this->db->where($where);
        $this->db->update('ecc_kendali',$data);
        $result = $this->db->affected_rows();
        if ($result) {
            $result = true;
        }
        return $result;   
    }

    function mupdate_verifawal($idform_array, $sts_verifawal)
    {
        //$sql = "INSERT INTO tes VALUES('$idform_')";
        $sql = "UPDATE ecc_kendali set sts_verifawal = '$sts_verifawal' where id_form = '$idform_array'";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }

    function mupdate_verifstepdua($idform_array, $sts_verifawal)
    {
        //$sql = "INSERT INTO tes VALUES('$idform_')";
        $sql = "UPDATE ecc_kendali set sts_verifawal = '$sts_verifawal' where id_form = '$idform_array'";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }

    function get_jnslaporan(){
        $query = $this->db->query("SELECT * FROM jns_lap WHERE sts = '1' ORDER BY id ASC");
        return $query;  
    }    

    function cek_noin($idform,$nokwitansi,$noin){
        $query  = "SELECT * from verif_step2 where no_kwitansi = '$nokwitansi' and no_in = '$noin' ";
        $result = $this->db->query($query);
      
        return $result;
    }

    function cek_noin_detail($no_in, $nokwitansi){
        $query  = "SELECT *, case when data = '1' then 'checked' end as tipecek, CASE WHEN DATA = '1' THEN 'disabled' END AS tipedisable from verif_step2_det where no_in = '$no_in' and no_kwitansi = '$nokwitansi' ORDER BY nourut ASC";
        $result = $this->db->query($query);
      
        return $result;
    }

    function mcekkwitansi($nokwitansi){
        $query  = "SELECT * from verif_step2 where no_kwitansi = '$nokwitansi' ";
        $result = $this->db->query($query);
        return $result;
    }

    function simpanbaru_laporan($data){
        $this->db->insert("verif_step2", $data);        
        return $this->db->affected_rows();
    }

     function simpanbaru_laporandetail($no_innew,$nokwitansi,$data_ceklist,$data_ket,$data_nourut){
        $sql = "INSERT INTO verif_step2_det VALUES('$no_innew','$nokwitansi','$data_ceklist','$data_ket','$data_nourut')";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

     function delete_verifstep2_detail($noin, $nokwitansi){
        $result = "DELETE FROM verif_step2_det WHERE no_in = '$noin' AND no_kwitansi = '$nokwitansi'";
        $this->db->query($result);
        return $this->db->affected_rows();
    }

    function delete_verifstep2($noin, $nokwitansi){
        $result = "DELETE FROM verif_step2 WHERE no_in = '$noin' AND no_kwitansi = '$nokwitansi'";
        $this->db->query($result);                
        return $this->db->affected_rows();
    }

    function insert_history_del($data){
        $this->db->insert("verif_step2historydel", $data);        
        return $this->db->affected_rows();
    }

    function sudahselesai_verifikasi($idform, $nokwitansi){
        $sql = "UPDATE ecc_kendali set sts_verifawal = '1', sts_verifkedua = '1' where id_form = '$idform' and no_kwitansi = '$nokwitansi'";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }
}