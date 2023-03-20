<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class load_module_sppd extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->model('session_apps');        
        $this->load->model('Mload_module_sppd');
    }
  

    public function ajax_data_surat_keluar() {
        $nip_petugas_admin  = $this->session->userdata('nip');                
        $level              = $this->session->userdata('level');
        $list               = $this->Mload_module_sppd->get_datatables_daftar_sppd($nip_petugas_admin);
        
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $m_data) {
            $lap    = $m_data->status_laporan_petugas;
            if ($lap == 'SUDAH'){
                $status_lap = base_url()."public/css/img/hijau.png";                
            }else{
                $status_lap = base_url()."public/css/img/merah.png";
            }

            $biaya  = $m_data->status_rincian_biaya;
            if ($biaya == 'SUDAH'){
                $status_biaya = base_url()."public/css/img/hijau.png";
            }else{
                $status_biaya = base_url()."public/css/img/merah.png";
            }

            $riil   = $m_data->status_riil;
            if ($riil == 'SUDAH'){
                $status_riil = base_url()."public/css/img/hijau.png";
            }else{
                $status_riil = base_url()."public/css/img/merah.png";
            }

            $pnjnkar = strlen($m_data->nama_pegawai);
            if ($pnjnkar > 20){
                $nma_peg = substr($m_data->nama_pegawai,0, 25)."...";
            }else{
                $nma_peg = $m_data->nama_pegawai;
            }
            $no++;
            $row = array();   
            $row[] = $no;
            $row[] = mediumdate_indo_kecil($m_data->tanggal_aktivitas);
            $row[] = $m_data->nomor_spt;
            $row[] = $m_data->nomor_surat_sppd;
            $row[] = $m_data->nip."<br>".$nma_peg;            
            $row[] = '<p style="text-align:center;">'.$m_data->lama_perj." Hari".'</p>';
            $row[] = '<img src="'.$status_lap.'" height="15" width="15" title="'.$lap.'"/>';
            $row[] = '<img src="'.$status_biaya.'" height="15" width="15" title="'.$biaya.'"/>';
            $row[] = '<img src="'.$status_riil.'" height="15" width="15" title="'.$riil.'"/>';            
            $row[] = '<a class="btn btn-outline-primary btn-sm" href="javascript:void(0)" title="Edit Data" onclick="view_editspt('."'".$m_data->id_sppd."','".$m_data->nomor_surat_sppd."'".')"><i class="fa fa-edit"></i></a>
            <a class="btn btn-outline-danger btn-sm" href="javascript:void(0)" title="Hapus Data" onclick="view_deletespt('."'".$m_data->id_sppd."','".$m_data->nomor_surat_sppd."'".')""><i class="fa fa-trash"></i></a>
            <a class="btn btn-outline-success btn-sm" href="javascript:void(0)" onclick="show_tombol_cetak('."'".$m_data->id_sppd."','".$m_data->nomor_spt."','".$m_data->nomor_surat_sppd."'".')" data-widget="control-sidebar"><i class="fa fa-print"></i></a>';            
                        
            $data[] = $row;
        }

        $response = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->Mload_module_sppd->count_all_daftar_sppd(),
            "recordsFiltered" => $this->Mload_module_sppd->count_filtered_daftar_sppd($nip_petugas_admin),
            "data"            => $data,            
        );

        echo json_encode($response);
    }

}

?>