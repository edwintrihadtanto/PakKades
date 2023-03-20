<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mload_module_riwayatkode extends CI_Model{   
    var $table          = 'tb_surat_kluar';
    var $column_order   = array('nomor_urut', 'code_suratkeluar', 'nomor_surat_keluar', 'tgl_surat_keluar', 'status_upload');
    var $column_search  = array('code_suratkeluar', 'nomor_surat_keluar',);
    var $order          = array('nomor_urut' => 'DESC');
       
    // -------------VIEW TABEL--------------------
    function _get_datatables_riwayatkode() {
        
        $this->db->select("*");
        $this->db->from("tb_surat_kluar");        
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

    function get_datatables_riwayatkode()
    {
        $this->_get_datatables_riwayatkode();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_all_dt_srt_kluar()
    {
        $this->db->from($this->table);        
        return $this->db->count_all_results();
    }

    function count_filtered_dt_srt_kluar()
    {
        $this->_get_datatables_riwayatkode();
        $query = $this->db->get();
        return $query->num_rows();
    }

    // -------------END VIEW TABEL--------------------
}