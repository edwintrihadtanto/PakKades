<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mload_module_bidang extends CI_Model{
    var $table          = 'tb_bidang';
    var $column_order   = array('code_bidang', 'name', 'name');
    var $column_search  = array('name');
    var $order          = array('code_bidang' => 'ASC');
    
    // -------------VIEW TABEL--------------------
    function _get_datatables_data_bidang() {
        
        $this->db->select("*");
        $this->db->from("tb_bidang");        
        //$this->db->order_by("id_spt", "DESC");
        //$this->db->limit("1000");

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

    
    function get_datatables_data_bidang()
    {
        $this->_get_datatables_data_bidang();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_all_data_bidang()
    {
        $this->db->from($this->table);        
        return $this->db->count_all_results();
    }

    function count_filtered_data_bidang()
    {
        $this->_get_datatables_data_bidang();
        $query = $this->db->get();
        return $query->num_rows();
    }

    // -------------END VIEW TABEL--------------------
    
    function Mget_bidang($where){
                
        $result = $this->db->query("SELECT * FROM tb_bidang $where");      
        return $result;
    }

    function Mget_jenissurat($where){

        $result = $this->db->query("SELECT * FROM tb_codesurat $where");      
        return $result;
    }

    function Mget_jenissurat_sub($where){
        
        $result = $this->db->query("SELECT * FROM tb_codesurat_sub $where");      
        return $result;
    }


    function Mcek_period($where){
                
        $result = $this->db->select("*");
        $result = $this->db->from("periode_urut ");        
        if ($where != ''){
            $result = $this->db->where($where);    
        }
        
        $result = $this->db->get();
        return $result;
    }

    function Mcek_periode_dngTanggal($where2){
                
        $result = $this->db->select("pu.years, pu.no_urut, pun.tgl_out, pun.no_urut_pertgl, pun.no_urut_pertgl_berlanjut as berlanjut");
        $result = $this->db->from("periode_urut pu");
        $result = $this->db->join('_no_urutpertgl pun', 'pu.years = pun.years','INNER');
        if ($where2 != ''){
            $result = $this->db->where($where2);    
        }
        
        $result = $this->db->get();
        return $result;
    }

    function MAMBIL_urutanterkahir_drTGL($where3){
                
        $result = $this->db->select("max(no_urut_pertgl) as urutan_akhir");
        $result = $this->db->from("_no_urutpertgl");
        $result = $this->db->order_by("no_urut_pertgl DESC ");
        //$result = $this->db->limit(1);
        if ($where3 != ''){
            $result = $this->db->where($where3);    
        }
        
        $result = $this->db->get();
        return $result;
    }


    function Minsert_no_urut_pertgl($insert){
        
        $result = $this->db->trans_begin();
            
        $result = $this->db->insert("_no_urutpertgl", $insert);
        //$result = $this->db->trans_complete();
        if ($result = $this->db->trans_status() === FALSE){
            $result = $this->db->trans_rollback();
        }else{
            $result =  $this->db->trans_commit();
        }        

        return $result;

    }

    function Mupdate_no_urut_pertgl_berlanjut($data, $where){

        $this->db->where($where);
        $this->db->update('_no_urutpertgl', $data);        
        $result = $this->db->affected_rows();
        if ($result) {
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }

    function Minsert_period($data){
        
        $result = $this->db->trans_begin();
            
        $result = $this->db->insert("periode_urut", $data);
        //$result = $this->db->trans_complete();
        if ($result = $this->db->trans_status() === FALSE){
            $result = $this->db->trans_rollback();
        }else{
            $result =  $this->db->trans_commit();
        }        

        return $result;        
    }

    function Mcek_codeurutbidang($tgl_out, $code_bidang){

        $result = $this->db->select("*");
        $result = $this->db->from("_nourut_bidang_pertgl");
        $result = $this->db->where("tgl_out = '$tgl_out' and code_bidang = '$code_bidang'");
        $result = $this->db->get();
        return $result;
    }
    
    function Mupdate_codeurutbidang($data, $where){

        //$wherex = "tgl_out = '2021-09-14' and code_bidang = '2' and nourut_tgl_out = '1' ";                       
        $this->db->where($where);
        $this->db->update('_nourut_bidang_pertgl', $data);        
        $result = $this->db->affected_rows();
        if ($result) {
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }

    function Minsert_codeurutbidang($data_insert, $where){
        
        //$result = $this->db->where($where);
        
        $result = $this->db->trans_begin();
            
        $result = $this->db->insert("_nourut_bidang_pertgl", $data_insert);
        //$result = $this->db->trans_complete();
        if ($result = $this->db->trans_status() === FALSE){
            $result = $this->db->trans_rollback();
        }else{
            $result =  $this->db->trans_commit();
        }

        return $result;
    }


    function Mupdate_period($data, $thun_sekarang){
        
        $this->db->where('years',$thun_sekarang);
        $this->db->update('periode_urut', $data);        
        $result = $this->db->affected_rows();
        
        if ($result) {
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }


    function Mcek_tb_sratkluar(){
        $result = $this->db->select("max(nomor_urut) as nomor_urut");
        $result = $this->db->from("tb_surat_kluar");
        $result = $this->db->get();
        return $result;
    }

    function Minsert_tb_sratkluar($data_1, $data_2){
        $result = $this->db->trans_begin();
        
        //$result = $this->db->trans_start();
        $result = $this->db->insert("tb_surat_kluar", $data_1);
        //$result = $this->db->trans_complete();
        if ($result = $this->db->trans_status() === FALSE){
            $result = $this->db->trans_rollback();
        }else{
            $result =  $this->db->trans_commit();
            $result = $this->db->insert("tb_surat_kluar_img", $data_2);
        }        

        return $result;
    }

    function Mupdate_tb_sratkluar($insert, $where){
//        $result = $this->db->trans_begin();
        //$wherex = "tgl_out = '2021-09-14' and code_bidang = '2' and nourut_tgl_out = '1' ";                       
        $result = $this->db->where($where);
        $result = $this->db->update('tb_surat_kluar', $insert);        
        $result = $this->db->affected_rows();
        if ($result) {
            $result = true;
        }else{
            $result = false;
        }

        // if ($result = $this->db->trans_status() === FALSE){
        //     $result = $this->db->trans_rollback();
        // }else{
        //     $result =  $this->db->trans_commit();
        // }        
        return $result;
    }

    function update_upload($insert, $where){

        if ($where != ''){
            $result = $this->db->where($where);
        }
        
        $result = $this->db->update('tb_surat_kluar_img', $insert);        
        $result = $this->db->affected_rows();

        if ($result) {
            $result = true;
        }else{
            $result = false;
        }

        return $result;
    }

    public function Mdelete_bidang($where){        
        $this->db->where($where);
        $this->db->delete('tb_bidang');
        return $this->db->affected_rows();
    }

    public function Medit_bidang($where, $data){        
        $this->db->where($where);
        $this->db->update('tb_bidang', $data);
        return $this->db->affected_rows();
    }
}