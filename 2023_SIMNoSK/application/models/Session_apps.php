<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Session_apps extends CI_Model {
   
    function logged_id(){
        return $this->session->userdata('code_user');
    }

    //fungsi check login
    function check_login($where){
        $this->db->select("code_user, user, pass, nm_lengkap, a.level, ket, show_pass, aktif, modul_angg, mod_id, mod_id_group");
        $this->db->from("_akses a");
        $this->db->join('_level l', 'a.level = l.level','INNER');    
        $this->db->where($where);
        
        return $this->db->get();
    }
    
}


