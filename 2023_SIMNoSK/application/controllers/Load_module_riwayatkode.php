<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class load_module_riwayatkode extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->model('session_apps');        
        $this->load->model('Mload_module_riwayatkode');
    }
  

    public function get_ajax_data_surat_keluar() {
        $nip_petugas_admin  = $this->session->userdata('nip');                
        $level              = $this->session->userdata('level');
        $list               = $this->Mload_module_riwayatkode->get_datatables_riwayatkode($nip_petugas_admin);
        
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $m_data) {
            $status_upload    = $m_data->status_upload;
            if ($status_upload == 1){
                $status_lap = base_url()."public/css/img/hijau.png";
                $upload = "Sudah Upload";
            }else{
                $status_lap = base_url()."public/css/img/merah.png";
                $upload = "Belum Upload";
            }            
            
            $no++;
            $row = array();   
            $row[] = $no;            
            $row[] = '<h6>'.$m_data->code_suratkeluar.'</h6>';
            $row[] = '<h6>'.$m_data->nomor_surat_keluar.'</h6>';
            $row[] = '<h6>'.mediumdate_indo_kecil($m_data->tgl_surat_keluar).'</h6>';            
            $row[] = '<label class="p-1" style="border: 2px solid black; border-radius: 5px; min-width: -webkit-fill-available; text-align: center;"><img src="'.$status_lap.'" height="15" width="15" title="'.$upload.'"/> '.$upload.'</label>';
            $row[] = '<a class="btn btn-outline-info btn-sm" href="javascript:void(0)" title="Upload File" onclick="view_upload('."'".$m_data->nomor_urut."'".')""><i class="fa fa-upload"></i></a>&nbsp;
            <a class="btn btn-outline-success btn-sm" href="javascript:void(0)" onclick="show_tombol_cetak('."'".$m_data->nomor_urut."'".')" data-widget="control-sidebar"><i class="fa fa-print"></i></a>&nbsp;
            <a class="btn btn-outline-secondary btn-sm" href="javascript:void(0)" title="Preview File" onclick="view_file('."'".$m_data->nomor_urut."'".')""><i class="fa fa-eye"></i></a>&nbsp;
            <a class="btn btn-outline-danger btn-sm" href="javascript:void(0)" title="Hapus Data" onclick="view_delete('."'".$m_data->nomor_urut."'".')""><i class="fa fa-trash"></i></a>';
                        
            $data[] = $row;
        }

        $response = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->Mload_module_riwayatkode->count_all_dt_srt_kluar(),
            "recordsFiltered" => $this->Mload_module_riwayatkode->count_filtered_dt_srt_kluar($nip_petugas_admin),
            "data"            => $data,            
        );

        echo json_encode($response);
    }

}

?>