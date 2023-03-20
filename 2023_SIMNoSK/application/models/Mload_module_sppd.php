<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mload_module_sppd extends CI_Model{
    var $table          = 'tb_input_sppdbaru';
    var $column_order   = array('','','tis.nomor_spt','tis.nomor_surat_sppd','','tis.lama_perj','','','');
    var $column_search  = array('tis.nomor_spt','tis.nomor_surat_sppd','tis.nip','tp.nama_pegawai');
    var $order          = array('','','','','lama_perj' => 'DESC');
    
    // -------------VIEW TABEL--------------------
    function _get_datatables_daftar_sppd($nip_petugas_admin) {
        
        $this->db->select("*");
        $this->db->from("tb_input_sppdbaru tis");
        $this->db->join("tb_pegawai tp","tis.nip = tp.nip" , "INNER");
        if (($nip_petugas_admin == '303-03081992-052017-8776')||($nip_petugas_admin == 'adminipde')){
            
        }else{
            $this->db->where("nip_petugas_admin = '$nip_petugas_admin'");
        }        
        $this->db->order_by("id_sppd", "DESC");
        $this->db->limit("1000");

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

    
    function get_datatables_daftar_sppd($nip_petugas_admin)
    {
        $this->_get_datatables_daftar_sppd($nip_petugas_admin);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_all_daftar_sppd()
    {
        $this->db->from($this->table);        
        return $this->db->count_all_results();
    }

    function count_filtered_daftar_sppd($nip_petugas_admin)
    {
        $this->_get_datatables_daftar_sppd($nip_petugas_admin);
        $query = $this->db->get();
        return $query->num_rows();
    }

}