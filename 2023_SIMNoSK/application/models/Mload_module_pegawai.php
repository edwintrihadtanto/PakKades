<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mload_module_pegawai extends CI_Model{
    var $table          = 'tb_pegawai';
    var $column_order   = array('nip','nama_pegawai', 'jabatan');
    var $column_search  = array('nip', 'nama_pegawai');
    var $order          = array('id_nip' => 'ASC ');
    
    function _get_datatables_pegawai() {        

        $this->db->select("*");
        $this->db->from("tb_pegawai");
        $this->db->where("id_nip not in ('1','2')");
        $this->db->order_by("id_nip", "ASC");

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

    // -------------LIST USERS--------------------
    function get_datatables_pegawai()
    {
        $this->_get_datatables_pegawai();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_all_pegawai()
    {
        $this->db->from($this->table);        
        return $this->db->count_all_results();
    }

    function count_filtered_pegawai()
    {
        $this->_get_datatables_pegawai();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_golongan()
    {
        $result = $this->db->query("SELECT * FROM tb_golongan ORDER BY id_golongan DESC");
        return $result;
    }

    function get_jabatan_tandatangan($params)
    {
        $result = $this->db->query("SELECT * FROM tb_jabatan WHERE $params");
        return $result;
    }

    function cek_data_pegawai($nip_nik){
                
        $result = $this->db->query("SELECT * FROM tb_pegawai WHERE nip ='$nip_nik'");      
        return $result;
    }

    function simpan_peg_baru($data){
        
         $result = $this->db->insert("tb_pegawai", $data);
         return $result;
    }

    function update_peg_baru($data, $where)
    {
        $this->db->where($where);
        $this->db->update('tb_pegawai', $data);
        $result = $this->db->affected_rows();
        if ($result) {
            $result = true;
        }
        return $result;   
    }

    function delete_pegawai($id_nip, $nip_nik)
    {
        $result = $this->db->query("DELETE FROM tb_pegawai WHERE id_nip = '$id_nip' AND nip = '$nip_nik'");
        return $result;
    }

    function delete_user($nip_nik)
    {
        $result = $this->db->query("DELETE FROM sppd_akses WHERE nip = '$nip_nik'");
        return $result;
    }

    //-------------------------PROSES TAMBAH / UPDATE PEGAWAI------------------------------
    function cek_user_login_apk($id_akses, $nip)
    {
        $result = $this->db->query("SELECT * FROM sppd_akses WHERE id_akses = '$id_akses' and nip = '$nip' ");
        return $result;
    }

    function update_reg_update($data, $where)
    {
        $this->db->where($where);
        $this->db->update('sppd_akses', $data);
        $result = $this->db->affected_rows();
        if ($result) {
            $result = true;
        }
        return $result;   
    }

    function insert_reg_insert($data){
        
         $result = $this->db->insert("sppd_akses", $data);
         return $result;
    }
    //-------------------------END PROSES TAMBAH / UPDATE PEGAWAI------------------------------
/*
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
*/
}