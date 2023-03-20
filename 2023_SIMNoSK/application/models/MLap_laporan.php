<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MLap_laporan extends CI_Model{
   
    function get_data_sptbynomorspt($id_spt, $nomor_spt) {            
        $result = $this->db->query("
			SELECT *
			FROM tb_spt
			WHERE
				id_spt = '$id_spt' 
				AND nomor_spt = '$nomor_spt'
        	");
        return $result;  
    }

    function getdata_ttd($ttd_nip){
    	$this->db->select('*');
        $this->db->from('tb_ttd');        
        $this->db->where("nip = '$ttd_nip' and status = 'y' ");        
        $query = $this->db->get();
        return $query;
    }

    function get_petugas_laporan($where){
        $this->db->select('tp.nomor_spt, tp.nip, tp.nama_pegawai, tp.jabatan, tp.golongan');
        $this->db->from('tb_petugas_yg_ditugaskan tp');
        $this->db->join('tb_golongan tg', 'tp.golongan = tg.golongan','INNER');
        $this->db->where($where);
        $this->db->order_by('tg.id_golongan DESC ');
        $query = $this->db->get();
        return $query;
    }

}