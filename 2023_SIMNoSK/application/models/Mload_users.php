<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mload_users extends CI_Model{
    //var $table          = 'ecc_kendali';
    var $column_order   = array('username','nama_lengkap',null);
    var $column_search  = array('username','nama_lengkap', 'vendor');
    var $order          = array('username' => 'DESC ');
    
    function _get_datatables_query_listuser()
    {        
        //$criteria = "date(tgl_entry)::text LIKE '%".$tahun."%' ";
        $this->db->select("*");
        $this->db->from("akses");
        $this->db->join('vendor', 'akses.kd_vendor = vendor.kd_vendor','LEFT');
        //$this->db->order_by("username", "DESC");
        //$this->db->limit(100);
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
        //$this->db->from($this->table);
        $this->db->from('akses');
        $this->db->join('vendor', 'akses.kd_vendor = vendor.kd_vendor','LEFT');
        return $this->db->count_all_results();
    }

    function count_filtered_users()
    {
        $this->_get_datatables_query_listuser();
        $query = $this->db->get();
        return $query->num_rows();
    }

    
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