<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_main extends CI_Model{
 
    function get_mod_group_detail(){
        $query = $this->db->get('mod_group_detail');
        return $query;  
    }

    function get_mod_group_name(){
        $query = $this->db->get('mod_group_name');
        return $query;  
    }

    function cek_user($id, $passlamamd5){
        $cekuser  = "SELECT * from akses where id_akses ='$id' and password = '$passlamamd5'";
        $result   = $this->db->query($cekuser);
      
        return $result;
    }

    function cek_id($id){
        $cekuser  = "SELECT * from akses where id_akses ='$id'";
        $result   = $this->db->query($cekuser);
      
        return $result;
    }

    function cek_nokwitansi($cek_nokwitansi){
        $cekuser  = "SELECT * from ecc_kendali where no_kwitansi = '$cek_nokwitansi'";
        $result   = $this->db->query($cekuser);
      
        return $result;
    }

    function cek_vendor($kd_vendor){
        $cekuser  = "SELECT * from vendor where kd_vendor = '$kd_vendor'";
        $result   = $this->db->query($cekuser);
      
        return $result;
    }

    function cek_nokwitansiterdaftar($idform, $cek_nokwitansi){
        $cekuser  = "SELECT * from ecc_kendali where id_form = '$idform' and no_kwitansi = '$cek_nokwitansi'";
        $result   = $this->db->query($cekuser);
      
        return $result;
    }


    function update_password($id,$pasbaru,$passbarumd5){
        
        $update = $this->db->query("UPDATE akses set password = '$passbarumd5', show_pass = '$pasbaru' where id_akses ='$id'");        
        return $update;
        //$result = $this->db->query($cekuser);
        //if ($result->num_rows() == 0) {        

    }
    
    function simpan_user($data){
        
         $result = $this->db->insert("akses", $data);
         return $result;
    }

    function simpan_module($data){

         $result = $this->db->insert("mod_group", $data);
         return $result;
    }

    function simpan_modgroup($data){

         $result = $this->db->insert("group_name", $data);
         return $result;
    }

    function simpan_form_kartukendali($data){

         $result = $this->db->insert("ecc_kendali", $data);
         return $result;
    }

    
    

    function get_vendor(){
        $query = $this->db->query("SELECT * FROM vendor ORDER BY vendor ASC");
        return $query;  
    }

    function get_group_name(){
        
        $query = $this->db->query("SELECT * FROM group_name where submenu = '1'");        
        return $query;  
    }
 
    // function hapus_barang($kobar){
    //     $hasil=$this->db->query("DELETE FROM tbl_barang WHERE barang_kode='$kobar'");
    //     return $hasil;
    // }
     
}