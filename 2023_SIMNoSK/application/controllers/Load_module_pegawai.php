<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class load_module_pegawai extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->model('session_apps');        
        $this->load->model('Mload_module_pegawai');
    }
    
    public function get_ajax_datapegawai() {
                 
        $list   = $this->Mload_module_pegawai->get_datatables_pegawai();
        $level  = $this->session->userdata('level');
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $m_data) {
            $no++;
            $row = array();            
            $row[] = $no;
            $row[] = $m_data->nip;
            $row[] = $m_data->nama_pegawai;
            $row[] = $m_data->jabatan;
            if (($m_data->status) == 'y'){                
                $row[] = '<a class="btn btn-outline-primary btn-sm" href="javascript:void(0)" title="Edit Data" onclick="view_editpegawai('.$m_data->id_nip.')"><i class="fa fa-edit"></i></a>
                <a class="btn btn-outline-danger btn-sm" href="javascript:void(0)" title="Hapus Data" onclick="view_deletepegawai('."'".$m_data->id_nip."','".$m_data->nip."'".')""><i class="fa fa-trash"></i></a>
                <a class="btn btn-outline-warning btn-sm" href="javascript:void(0)" title="Informasi User" onclick="view_user('."'".$m_data->nip."','".$level."'".')"><i class="fa fa-info-circle"></i></a>
                <img src="'.base_url().'public/css/img/hijau.png" width="20mm" height="20mm" title="Aktif"/>';
            }else{
                $row[] = '<a class="btn btn-outline-primary btn-sm" href="javascript:void(0)" title="Edit Data" onclick="view_editpegawai('.$m_data->id_nip.')"><i class="fa fa-edit"></i></a>
                <a class="btn btn-outline-danger btn-sm" href="javascript:void(0)" title="Hapus Data" onclick="view_deletepegawai('."'".$m_data->id_nip."','".$m_data->nip."'".')""><i class="fa fa-trash"></i></a>
                <a class="btn btn-outline-warning btn-sm" href="javascript:void(0)" title="Informasi User" onclick="view_user('."'".$m_data->nip."','".$level."'".')"><i class="fa fa-info-circle"></i></a>
                <img src="'.base_url().'public/css/img/merah.png" width="20mm" height="20mm" title="Tidak Aktif"/>';
            }
                        
            $data[] = $row;
        }

        $response = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->Mload_module_pegawai->count_all_pegawai(),
            "recordsFiltered" => $this->Mload_module_pegawai->count_filtered_pegawai(),
            "data"            => $data,            
        );

        echo json_encode($response);
    }

    /*KUMPULAN GET GET AN TOK */

    public function get_datapegawai(){
        $params = $this->input->post('params');
        $query  = $this->db->query("SELECT * FROM tb_pegawai $params");
        $response = array(
            'data'  => $query->num_rows(),
        );

        if ($response['data'] > 0){
            $response = array(
                'result'        => true,
                'result_data'   => $query->result(),
                'pesan'         => 'Success',
                'totalrecords'  => $query->num_rows(),
            );
        }else{
            $response = array(
                'result'        => false,
                'result_data'   => $query->result(),
                'pesan'         => 'Data Pegawai Tidak Ditemukan !!!',
                'totalrecords'  => '0',
            );
        }
        echo json_encode($response);
    }

    public function get_datapegawai_byidnip(){

        $id_nip = $this->input->post('id_nip');
        $query  = $this->db->query("SELECT * FROM tb_pegawai where id_nip = '$id_nip'");
        $response = array(
            'data'  => $query->num_rows(),
        );

        if ($response['data'] > 0){
            $response = array(
                'result'        => true,
                'result_data'   => $query->result(),
                'pesan'         => 'Success',
            );
        }else{
            $response = array(
                'result'        => false,
                'result_data'   => $query->result(),
                'pesan'         => 'Data Pegawai Tidak Ditemukan !!!',
            );
        }
        echo json_encode($response);
    }

    public function get_data_ttd(){
        
        $params = $this->input->post('params');
        $query   = $this->db->query("SELECT * FROM tb_ttd $params");
        $response = array(
            'data'  => $query->num_rows(),
        );

        if ($response['data'] > 0){
            $response = array(
                'result'        => true,
                'pesan'         => 'success',
                'result_data'   => $query->result(),                
                'totalrecords'  => $query->num_rows(),
            );
        }else{
            $response = array(
                'result'        => false,
                'result_data'   => $query->result(),
                'pesan'         => 'Tidak Ditemukan !!!',
                'totalrecords'  => '0',
            );
        }
        echo json_encode($response);

    }

    public function get_jabatan_tandatangan(){
        
        $params = $this->input->post('params');
        $query  = $this->Mload_module_pegawai->get_jabatan_tandatangan($params);
        $response = array(
            'data'  => $query->num_rows(),
        );

        if ($response['data'] > 0){
            $response = array(
                'result'        => true,
                'pesan'         => 'success',
                'result_data'   => $query->result(),                
                'totalrecords'  => $query->num_rows(),
                'pesan'         => 'Silahkan Pilih Jabatan !!!',
            );
        }else{
            $response = array(
                'result'        => false,
                'result_data'   => $query->result(),
                'pesan'         => 'Tidak Sedang Dalam Menjabat Jabatan Rangkap !!!',
                'totalrecords'  => '0',
            );
        }
        echo json_encode($response);

    }


    /*END KUMPULAN GET GET AN TOK */

    public function tambah_pegawai(){
        
        //$id_nip         = $this->input->post('id_nip'); //otomatis primary
        $nip_nik        = $this->input->post('nip_nik');
        $nama_pegawai   = $this->input->post('nama_pegawai');
        $jabatan        = $this->input->post('jabatan');
        $golongan       = $this->input->post('golongan');
        $unit_kerja     = $this->input->post('unit_kerja');
        $gol_peg        = $this->input->post('gol_peg');
        $jns_kel        = $this->input->post('jns_kel');
        $email          = $this->input->post('email');
        $status         = $this->input->post('status');

        if (($nip_nik == '')||($nama_pegawai == '')||($jabatan == '')||($golongan == '')||($gol_peg == '')||($jns_kel == '')){
            $response = array(
                'result'      => false,
                'count_data'  => 404,
                'pesan'       => "*) Wajib Di Isi !!!",
            );
        }else{
            $response = array(
                'result'      => true,
            );
        }

        if ($response['result'] == true){
            $data = array(            
                    "nip"       => $nip_nik,
                    "nama_pegawai"  => $nama_pegawai,
                    "jabatan"       => $jabatan,                    
                    "golongan"      => $golongan,
                    "unit_kerja"    => $unit_kerja,
                    "gol_peg"       => $gol_peg,
                    "jns_kel"       => $jns_kel,
                    "email"         => $email,                    
                    "status"        => $status
                );
            
            $cek_nip = $this->Mload_module_pegawai->cek_data_pegawai($nip_nik);
            if ($cek_nip->num_rows() > 0 ){ //jika ada maka ERROR
                $response = array(
                    'result'        => false,                
                    'pesan'         => 'NIP/NPK Pegawai Sudah Terdaftar',                    
                ); 
            }else{
                $this->Mload_module_pegawai->simpan_peg_baru($data);
                $response = array(
                    'result'        => true,                
                    'pesan'         => 'Simpan Berhasil',                    
                );
            }            
        }
        echo json_encode($response);
    }

    public function update_pegawai(){
        
        $id_nip         = $this->input->post('id_nip'); //otomatis primary
        $nip_nik        = $this->input->post('nip_nik');
        $nama_pegawai   = $this->input->post('nama_pegawai');
        $jabatan        = $this->input->post('jabatan');
        $golongan       = $this->input->post('golongan');
        $unit_kerja     = $this->input->post('unit_kerja');
        $gol_peg        = $this->input->post('gol_peg');
        $jns_kel        = $this->input->post('jns_kel');
        $email          = $this->input->post('email');
        $status         = $this->input->post('status');

        if (($nip_nik == '')||($nama_pegawai == '')||($jabatan == '')||($golongan == '')||($gol_peg == '')||($jns_kel == '')){
            $response = array(
                'result'      => false,
                'count_data'  => 404,
                'pesan'       => "*) Wajib Di Isi !!!",
            );
        }else{
            $response = array(
                'result'      => true,
            );
        }

        if ($response['result'] == true){
            $data = array(            
                    "nip"           => $nip_nik,
                    "nama_pegawai"  => $nama_pegawai,
                    "jabatan"       => $jabatan,                    
                    "golongan"      => $golongan,
                    "unit_kerja"    => $unit_kerja,
                    "gol_peg"       => $gol_peg,
                    "jns_kel"       => $jns_kel,
                    "email"         => $email,                    
                    "status"        => $status
                );

            $where = array(            
                    "id_nip"        => $id_nip                    
                );
            
            $cek_nip = $this->Mload_module_pegawai->cek_data_pegawai($nip_nik);
            if ($cek_nip->num_rows() > 0 ){ //jika ada maka update

                $this->Mload_module_pegawai->update_peg_baru($data, $where);
                $response = array(
                    'result'        => true,                
                    'pesan'         => 'Update Berhasil',                    
                );

            }else{

                $response = array(
                    'result'        => false,                
                    'pesan'         => 'NIP/NPK Pegawai Tidak Ditemukan',
                );                 
            }            
        }
        echo json_encode($response);
    }


    public function delete_pegawai(){
        $id_nip     = $this->input->post('id_nip');
        $nip_nik    = $this->input->post('nip');

        $cek_nip = $this->Mload_module_pegawai->cek_data_pegawai($nip_nik);

        if ($cek_nip->num_rows() > 0 ){ //jika ada maka delete
            
            $this->Mload_module_pegawai->delete_user($nip_nik);

            $this->Mload_module_pegawai->delete_pegawai($id_nip, $nip_nik);
            $response = array(
                'result'        => true,                
                'pesan'         => 'Hapus Berhasil',                    
            );
            $this->db->trans_commit();
        }else{
            $response = array(
                'result'        => false,                
                'pesan'         => 'NIP/NPK Pegawai Tidak Ditemukan',                    
            );
            $this->db->trans_commit();
        }
        
        echo json_encode($response);
        $this->db->close();        
    }

    public function get_golongan(){
        $query = $this->Mload_module_pegawai->get_golongan();
            $response = array(
                'result'        => true,                
                'result_data'   => $query->result(),
        );
            
        echo json_encode($response);
    }

    public function get_data_edit_user_login_apk(){

        $nip = $this->input->post('nip');
        $query  = $this->db->query("SELECT * FROM sppd_akses where nip = '$nip' and level = 0 and security_level_apk = 2");
        $response = array(
            'data'  => $query->num_rows(),
        );

        if ($response['data'] > 0){
            $response = array(
                'result'        => true,
                'result_data'   => $query->result(),
                'pesan'         => 'Success',
            );
        }else{
            $response = array(
                'result'        => false,
                'nip'           => $nip,
                'result_data'   => $query->result(),
                'pesan'         => 'Belum Registrasi Aplikasi E-SPPD !!!',
            );
        }
        echo json_encode($response);
    }

    public function reg_update(){
        $id_akses               = $this->input->post('id_akses'); //otomatis primary
        $nip                    = $this->input->post('nip');
        $pass                   = md5($this->input->post('pass'));
        $security_level_apk     = $this->input->post('security_level_apk');
        $show_pass              = $this->input->post('show_pass');
        $tgl_buat               = $this->input->post('tgl_buat');
        $aktif                  = $this->input->post('aktif');        

        if (($id_akses == '')||($nip == '')||($show_pass == '')){
            $response = array(
                'result'      => false,
                'count_data'  => 404,
                'pesan'       => "*) Wajib Di Isi !!!",
            );
        }else{
            $response = array(
                'result'      => true,
            );
        }

        if ($response['result'] == true){
            $data = array(            
                    "pass"          => $pass,
                    "show_pass"     => $show_pass,
                    "aktif"         => $aktif,                    
                    "tgl_buat"      => $tgl_buat
                );

            $where = array(            
                    "id_akses"      => $id_akses,
                    "nip"           => $nip
                );
            
            $cek_user = $this->Mload_module_pegawai->cek_user_login_apk($id_akses, $nip);
            if ($cek_user->num_rows() > 0 ){ //jika ada maka update

                $this->Mload_module_pegawai->update_reg_update($data, $where);
                $response = array(
                    'result'        => true,                
                    'pesan'         => 'Update User Berhasil',
                );

            }else{

                $response = array(
                    'result'        => false,                
                    'pesan'         => 'Anda Belum Registrasi / User Tidak Ditemukan',
                );                 
            }            
        }
        echo json_encode($response);
    }

    public function reg_insert(){
        $id_akses               = '';
        $nip                    = $this->input->post('nip');
        $pass                   = md5($this->input->post('pass'));
        $security_level_apk     = $this->input->post('security_level_apk');
        $show_pass              = $this->input->post('show_pass');
        $tgl_buat               = $this->input->post('tgl_buat');
        $aktif                  = $this->input->post('aktif');
        $level                  = $this->input->post('level');

        if (($nip == '')||($show_pass == '')){
            $response = array(
                'result'      => false,
                'count_data'  => 404,
                'pesan'       => "*) Wajib Di Isi !!!",
            );
        }else{
            $response = array(
                'result'      => true,
            );
        }

        if ($response['result'] == true){
            $data = array(
                    "nip"                   => $nip,
                    "pass"                  => $pass,
                    "level"                 => $level,
                    "security_level_apk"    => $security_level_apk,
                    "show_pass"             => $show_pass,
                    "tgl_buat"              => $tgl_buat,
                    "aktif"                 => $aktif                    
                );
            
            $cek_user = $this->Mload_module_pegawai->cek_user_login_apk($id_akses, $nip);
            if ($cek_user->num_rows() > 0 ){ //jika ada maka update
                
                $response = array(
                    'result'        => false,                
                    'pesan'         => 'Gagal Registrasi Baru !!!<br>Sudah Registrasi !!!',
                );

            }else{

                $this->Mload_module_pegawai->insert_reg_insert($data);
                $response = array(
                    'result'        => true,                
                    'pesan'         => 'Registrasi Berhasil',
                );
            }            
        }
        echo json_encode($response);
    }
//      public function delete_usersijisiji(){
//         $id_akses = $this->input->post('id_akses');        
        
//         $criteria = array();
//         $criteria['id_akses']     = $id_akses;        
//         $this->db->where($criteria);
//         $this->db->delete('akses');
//         $result = $this->db->affected_rows();
//         if ($result === true || $result > 0) {
//            $this->db->trans_commit();
//             echo json_encode(
//                 array(
//                     'count_data' => 200,
//                     'pesan'      => 'Hapus Berhasil',
//                 )
//             );
//         }else{
//            $this->db->trans_commit();
//             echo json_encode(
//                 array(
//                     'count_data' => 401,
//                     'pesan'      => 'Hapus Gagal !!!',
//                 )
//             );
//         }
//         $this->db->close();        
//     }

    

//     public function get_datakendali(){
//         $idform      = $this->input->post('id_form');
//         $no_kwitansi = $this->input->post('nokwitansi');

//         $cek = $this->Mload_module->get_datakendalix($idform, $no_kwitansi);

//         $response = array(
//                 'count_data'  => $cek->num_rows(),
//                 'result_data' => $cek->result(),
//         );

//         if ($response['count_data'] > 0){
//             $response = array(
//                 'count_data'  => 200,
//                 'result_data' => $cek->result(),
//                 'pesan'       => 'Data Ditemukan',
//             );
//         }else{
//             $response = array(
//                 'count_data'  => 401,
//                 'pesan'       => 'No. Kwitansi '.$no_kwitansi.' Tidak Ditemukan !!!',
//             );
//         }
//         echo json_encode($response);
//     }  

//     public function update_form_kartukendali(){
//         $idform         = $this->input->post('id_form');
//         $no_kwitansi    = $this->input->post('nokwitansi');        
//         $kd_vendor      = $this->input->post('kd_vendor');
//         $nominal        = $this->input->post('nominal');
//         $keterangan     = $this->input->post('keterangan');
//         $tgl_kwitansi   = $this->input->post('tgl_kwitansi');
//         $tgl_entry      = date('Y-m-d');
//         $kduser         = $this->session->userdata('id_akses');

//         //$update = $this->Mload_module->update_datakendalix($idform, $no_kwitansi);

//         if (($idform == '')||($no_kwitansi == '')||($kd_vendor == '')||($nominal == '')||($tgl_kwitansi == '')){
//             $result = 'false';
//         }else{
//             $result = 'true';
//         }
       
//         if ($result == 'true') {
//             $cek_nokwitansi = $this->m_main->cek_nokwitansiterdaftar($idform, $no_kwitansi);
//             $response = array(
//                     'count_data'  => $cek_nokwitansi->num_rows(),
//                     'pesan'       => "No Kwitansi Belum Terdaftar !!!",
//             );

//             if ($response['count_data'] > 0){ // lebihdari 0 / terdaftar   

//                 $cek_vendor = $this->m_main->cek_vendor($kd_vendor);
//                 $response   = array(                    
//                         'ListDataObj' => $cek_vendor->result(),
//                 );

//                 $data = array(
//                     "nm_rekanan"   =>   $response['ListDataObj'][0]->vendor,
//                     "rpkwitansi"   =>   $nominal,
//                     "ket"          =>   $keterangan,
//                     "tgl_kwitansi" =>   $tgl_kwitansi,
//                     "tgl_entry"    =>   $tgl_entry,
//                     "id_akses"     =>   $kduser,
//                     "kd_vendor"    =>   $response['ListDataObj'][0]->kd_vendor,
//                 );

//                 $where = array(
//                     "id_form"      =>   $idform,
//                     "no_kwitansi"  =>   $no_kwitansi
//                 );
                
//                 $this->Mload_module->update_form_kartukendali($data, $where);       
//                 $response = array(
//                     'count_data'  => 200,
//                     'pesan'       => "Berhasil Di Update",                    
//                 );
//             }else{
//                 $response = array(
//                     'count_data'  => 404,
//                     'pesan'       => "Gagal Update Data,<br>Ada Data Tidak Match !!!<br><i class='fas fa-sync-alt'></i>Refresh",
//                     //<img class='ukuran_icon' src=".base_url('public/css/ionicons512/refresh-circle.svg').">
//                 ); 
//             }

//         }else{            
//             $response = array(             
//              'count_data'  => 404,
//              'pesan'       => "Inputan tidak boleh kosong !!!",             
//             );
//         }
//         echo json_encode($response);
//     }  

//     public function update_verifawal(){
//         $no_array       = 0;
//         $inserted       = 0;
//         $idform         = json_decode(stripslashes($this->input->post('id_form')));
//         //$idform         = $this->input->post('id_form');
//         $sts_verifawal  = 1;

//         if(isset($idform)){            
//             $response = array(
//                 'result'  => 'true'                    
//             );
//         }else{
//             $response = array(
//                 'result'  => 'false'                    
//             );
//         }   
       
//         if ($response['result'] == true) {
                       
//             foreach($idform as $k){                
//                 $idform_array = $idform[$no_array];                
//                 $result = $this->Mload_module->mupdate_verifawal($idform_array, $sts_verifawal);
//                 //$inserted++;
//                 $no_array++;
//             }

//             $response = array(                
//                 'count_data'       => $result,
//             );

//             if ($response['count_data'] > 0 ){
//                 $response = array(
//                     'count_data'  => 200,
//                     'pesan'       => "Berhasil Dikirim Ke Verifikasi Tahap Selanjutnya ",
//                     'success'     => $idform,
//                 );
//             }else{
//                 $response = array(
//                     'count_data'  => 404,
//                     'pesan'       => "Gagal Dikirim Ke Verifikasi Selanjutnya !!!",                    
//                 );                
//             }
//         }else{
//             $response = array(
//                 'count_data'  => 404,                   
//                 'pesan'       => "Gagal Dikirim!!!",
//             ); 
//         }
//         echo json_encode($response);
//     }

//     public function update_verifstepdua(){
//         $no_array       = 0;        
//         //$idform         = json_decode(stripslashes($this->input->post('id_form')));
//         $idform         = $this->input->post('id_form');
//         $sts_verifawal  = 0;

//         if(isset($idform)){            
//             $response = array(
//                 'result'  => 'true'                    
//             );
//         }else{
//             $response = array(
//                 'result'  => 'false'                    
//             );
//         }   
       
//         if ($response['result'] == true) {
                       
//             // foreach($idform as $k){                
//             //     $idform_array = $idform[$no_array];                
//             //     $result = $this->Mload_module->mupdate_verifstepdua($idform_array, $sts_verifawal);                
//             //     $no_array++;
//             // }
//             $idform_array = $idform;
//             $result = $this->Mload_module->mupdate_verifstepdua($idform_array, $sts_verifawal);
//             $response = array(                
//                 'count_data'       => $result,
//             );

//             if ($response['count_data'] > 0 ){
//                 $response = array(
//                     'count_data'  => 200,
//                     'pesan'       => "Berhasil Dikembalikan",
//                     'success'     => $idform,
//                 );
//             }else{
//                 $response = array(
//                     'count_data'  => 404,
//                     'pesan'       => "Gagal Dikembalikan !!!<br>Refresh / Hubungi Admin,...",
//                 );                
//             }
//         }else{
//             $response = array(
//                 'count_data'  => 404,                   
//                 'pesan'       => "Gagal Dikembalikan !!!<br>Hubungi Admin,...",
//             ); 
//         }
//         echo json_encode($response);
//     }

//     public function getlaporan_jenislaporan(){
//         $idjnslap      = $this->input->post('id');
//         $no_in         = $this->input->post('no_in');
//         $nokwitansi    = $this->input->post('nokwitansi');

//         $cek_noin_detail  = $this->Mload_module->cek_noin_detail($no_in, $nokwitansi);
//         $response = array(
//                     'count'       => $cek_noin_detail->num_rows(),
//                     'ListDataObj' => $cek_noin_detail->result(),                    
//         );
        
//         if ($idjnslap == 1){
//             if ($response['count'] > 0){
//                 $countcek_noin = $this->db->query("SELECT count(no_in::integer) as x from verif_step2_det where no_in = '$no_in' and no_kwitansi='$nokwitansi' and data = '1' ")->result();

//                 $ceklist0 = $response['ListDataObj'][0]->tipecek; //dicentang trus //no urut 1
//                 $cekket0  = $response['ListDataObj'][0]->tipedisable; //didisable
//                 $ket0     = $response['ListDataObj'][0]->keterangan;

//                 $ceklist1 = $response['ListDataObj'][1]->tipecek; //dicentang trus //no urut 2
//                 $cekket1  = $response['ListDataObj'][1]->tipedisable; //didisable
//                 $ket1     = $response['ListDataObj'][1]->keterangan;

//                 $ceklist2 = $response['ListDataObj'][2]->tipecek; //dicentang trus //no urut 3
//                 $cekket2  = $response['ListDataObj'][2]->tipedisable; //didisable
//                 $ket2     = $response['ListDataObj'][2]->keterangan;

//                 $ceklist3 = $response['ListDataObj'][3]->tipecek; //dicentang trus //no urut 4
//                 $cekket3  = $response['ListDataObj'][3]->tipedisable; //didisable
//                 $ket3     = $response['ListDataObj'][3]->keterangan;

//                 $ceklist4 = $response['ListDataObj'][4]->tipecek; //dicentang trus //no urut 5
//                 $cekket4  = $response['ListDataObj'][4]->tipedisable; //didisable
//                 $ket4     = $response['ListDataObj'][4]->keterangan;

//                 $ceklist5 = $response['ListDataObj'][5]->tipecek; //dicentang trus //no urut 6
//                 $cekket5  = $response['ListDataObj'][5]->tipedisable; //didisable
//                 $ket5     = $response['ListDataObj'][5]->keterangan;

//                 $ceklist6 = $response['ListDataObj'][6]->tipecek; //dicentang trus //no urut 7
//                 $cekket6  = $response['ListDataObj'][6]->tipedisable; //didisable
//                 $ket6     = $response['ListDataObj'][6]->keterangan;

//                 $ceklist7 = $response['ListDataObj'][7]->tipecek; //dicentang trus //no urut 8
//                 $cekket7  = $response['ListDataObj'][7]->tipedisable; //didisable
//                 $ket7     = $response['ListDataObj'][7]->keterangan;

//                 $ceklist8 = $response['ListDataObj'][8]->tipecek; //dicentang trus //no urut 9
//                 $cekket8  = $response['ListDataObj'][8]->tipedisable; //didisable
//                 $ket8     = $response['ListDataObj'][8]->keterangan;

//                 $ceklist9 = $response['ListDataObj'][9]->tipecek; //dicentang trus //no urut 10
//                 $cekket9  = $response['ListDataObj'][9]->tipedisable; //didisable
//                 $ket9     = $response['ListDataObj'][9]->keterangan;

//                 $ceklist10 = $response['ListDataObj'][10]->tipecek; //dicentang trus //no urut 11
//                 $cekket10  = $response['ListDataObj'][10]->tipedisable; //didisable
//                 $ket10     = $response['ListDataObj'][10]->keterangan;

//                 $ceklist11 = $response['ListDataObj'][11]->tipecek; //dicentang trus //no urut 12
//                 $cekket11  = $response['ListDataObj'][11]->tipedisable; //didisable
//                 $ket11     = $response['ListDataObj'][11]->keterangan;

//                 $response = array(
//                                 'count_data'  => 'success',
//                                 'ListDataObj' => $cek_noin_detail->result(),
//                                 'count_det'   => $countcek_noin,
//                                 'data'        => "
//                         <table cellspacing='0' border='0' style='margin-left:10mm;'>
//                             <tr>
//                                 <td width='5mm' align='left' height='15mm'></td>
//                                 <td width='20mm'><input type='checkbox' class='ceklist_lap1_all' /></td>
//                                 <td align='left'><b>Centang Semua</td>
//                                 <td width='200mm'><b>Keterangan</td>
//                             </tr>             
//                             <tr>
//                                 <td width='5mm' align='left' height='15mm'><input type='number' value='1' hidden class='nourut'/><b>1.</td>
//                                 <td width='20mm'><input type='checkbox' class='ceklist_lap1_1 cekbox_laporan' ".$ceklist0."/></td>
//                                 <td align='left'>Kwitansi ( sudah ada TTD PPTK, PPK, PPHP, Pj. Persediaan Medis )</td>
//                                 <td><input type='text' name='keterangan' placeholder='Keterangan...' id='ket1' class='keterangan' value='".$ket0."'".$cekket0."></td>
//                             </tr>             
//                             <tr>
//                                 <td width='5mm' align='left' height='7mm'><input type='number' value='2' hidden class='nourut'/><b>2.</td>
//                                 <td><input type='checkbox' class='ceklist_lap1_2 cekbox_laporan' ".$ceklist1."/></td>
//                                 <td align='left'>Nota / Faktur Penjualan / Invoice / Surat Perintah Pengiriman Barang</td>
//                                 <td><input type='text' name='keterangan' placeholder='Keterangan...' id='ket2' class='keterangan' value='".$ket1."'".$cekket1."></td>
//                             </tr>
//                             <tr>
//                                 <td width='5mm' align='left' height='7mm'><input type='number' value='3' hidden class='nourut'/><b>3.</td>
//                                 <td><input type='checkbox' class='ceklist_lap1_3 cekbox_laporan' ".$ceklist2."/></td>
//                                 <td align='left'>SP/ SPK / Perjanjian / Daftar Pesanan E-Purchasing</td>
//                                 <td><input type='text' name='keterangan' placeholder='Keterangan...' id='ket3' class='keterangan' value='".$ket2."'".$cekket2."></td>
//                             </tr>
//                             <tr>
//                                 <td width='5mm' align='left' height='7mm'><input type='number' value='4' hidden class='nourut'/><b>4.</td>
//                                 <td><input type='checkbox' class='ceklist_lap1_4 cekbox_laporan' ".$ceklist3."/></td>
//                                 <td align='left'>BA Pembelian Langsung</td>
//                                 <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket4' class='keterangan' value='".$ket3."'".$cekket3."></td>
//                             </tr>               
//                             <tr>
//                                 <td width='5mm' align='left' height='7mm'><input type='number' value='5' hidden class='nourut'/><b>5.</td>
//                                 <td><input type='checkbox' class='ceklist_lap1_5 cekbox_laporan' ".$ceklist4."/></td>
//                                 <td align='left'>BA Hasil Pemeriksaan</td>
//                                 <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket5' class='keterangan' value='".$ket4."'".$cekket4."></td>
//                             </tr>
//                             <tr>
//                                 <td width='5mm' align='left' height='7mm'><input type='number' value='6' hidden class='nourut'/><b>6.</td>
//                                 <td><input type='checkbox' class='ceklist_lap1_6 cekbox_laporan' ".$ceklist5."/></td>
//                                 <td align='left'>BA Serah Terima Hasil Pekerjaan</td>
//                                 <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket6' class='keterangan' value='".$ket5."'".$cekket5."></td>
//                             </tr>
//                             <tr>
//                                 <td width='5mm' align='left' height='7mm'><input type='number' value='7' hidden class='nourut'/><b>7.</td>
//                                 <td><input type='checkbox' class='ceklist_lap1_7 cekbox_laporan' ".$ceklist6."/></td>
//                                 <td align='left'>BA Penyerahan Barang / Jasa</td>
//                                 <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket7' class='keterangan' value='".$ket6."'".$cekket6."></td>
//                             </tr>

//                             <tr>
//                                 <td width='5mm' align='left' height='7mm'><input type='number' value='8' hidden class='nourut'/><b>8.</td>
//                                 <td><input type='checkbox' class='ceklist_lap1_8 cekbox_laporan' ".$ceklist7."/></td>
//                                 <td align='left'>BA Hasil Pemeriksaan Administratif</td>
//                                 <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket8' class='keterangan' value='".$ket7."'".$cekket7."></td>
//                             </tr>
//                             <tr>
//                                 <td width='5mm' align='left' height='7mm'><input type='number' value='9' hidden class='nourut'/><b>9.</td>
//                                 <td><input type='checkbox' class='ceklist_lap1_9 cekbox_laporan' ".$ceklist8."/></td>
//                                 <td align='left'>Faktur Pajak</td>
//                                 <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket9' class='keterangan' value='".$ket8."'".$cekket8."></td>
//                             </tr>
//                             <tr>
//                                 <td width='5mm' align='left' height='7mm'><input type='number' value='10' hidden class='nourut'/><b>10.</td>
//                                 <td><input type='checkbox' class='ceklist_lap1_10 cekbox_laporan' ".$ceklist9."/></td>
//                                 <td align='left'>Perincian Perhitungan Pajak</td>
//                                 <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket10' class='keterangan' value='".$ket9."'".$cekket9."></td>
//                             </tr>                
//                             <tr>
//                                 <td width='5mm' align='left' height='7mm'><input type='number' value='11' hidden class='nourut'/><b>11.</td>
//                                 <td><input type='checkbox' class='ceklist_lap1_11 cekbox_laporan' ".$ceklist10."/></td>
//                                 <td align='left'>Perincian Perhitungan Pajak (apabila diperlukan)</td>
//                                 <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket11' class='keterangan' value='".$ket10."'".$cekket10."></td>
//                             </tr>
//                             <tr>
//                                 <td width='5mm' align='left' height='7mm'><input type='number' value='12' hidden class='nourut'/><b>12.</td>
//                                 <td><input type='checkbox' class='ceklist_lap1_12 cekbox_laporan' ".$ceklist11."/></td>
//                                 <td align='left'>Surat Pernyataan Selisih Harga antara E-Purchasing dengan Nilai Kwitansi</td>
//                                 <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket12' class='keterangan' value='".$ket11."'".$cekket11."></td>
//                             </tr>
//                         </table>
//                         <table cellspacing='0' border='0' style='margin-top:5mm;'>   
//                           <tr>
//                             <td>Dinyatakan telah diteliti sesuai dengan ketentuan yang berlaku dan sudah memenuhi persyaratan pembayaran.</td>
//                           </tr>    
//                         </table>
//                      "
//                 );

//             }else{

//                 $response = array(
//                             'count_data'    => 'success',
//                             'count_det'     => '0',
//                             'ListDataObj'   => 'empty detail data laporan 1',
//                             'data'          => "
//                     <table cellspacing='0' border='0' style='margin-left:10mm;'>   
//                         <tr>
//                             <td width='5mm' align='left' height='15mm'></td>
//                             <td width='20mm'><input type='checkbox' class='ceklist_lap1_all' /></td>
//                             <td align='left'><b>Centang Semua</td>
//                             <td width='200mm'><b>Keterangan</td>
//                         </tr>             
//                         <tr>
//                             <td width='5mm' align='left' height='15mm'><input type='number' value='1' hidden class='nourut'/><b>1.</td>
//                             <td width='20mm'><input type='checkbox' class='ceklist_lap1_1 cekbox_laporan' /></td>
//                             <td align='left'>Kwitansi ( sudah ada TTD PPTK, PPK, PPHP, Pj. Persediaan Medis )</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...' id='ket1' class='keterangan'></td>
//                         </tr>             
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='2' hidden class='nourut'/><b>2.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_2 cekbox_laporan' /></td>
//                             <td align='left'>Nota / Faktur Penjualan / Invoice / Surat Perintah Pengiriman Barang</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...' id='ket2' class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='3' hidden class='nourut'/><b>3.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_3 cekbox_laporan' /></td>
//                             <td align='left'>SP/ SPK / Perjanjian / Daftar Pesanan E-Purchasing</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...' id='ket3' class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='4' hidden class='nourut'/><b>4.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_4 cekbox_laporan' /></td>
//                             <td align='left'>BA Pembelian Langsung</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket4' class='keterangan'></td>
//                         </tr>               
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='5' hidden class='nourut'/><b>5.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_5 cekbox_laporan' /></td>
//                             <td align='left'>BA Hasil Pemeriksaan</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket5' class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='6' hidden class='nourut'/><b>6.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_6 cekbox_laporan'/></td>
//                             <td align='left'>BA Serah Terima Hasil Pekerjaan</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket6' class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='7' hidden class='nourut'/><b>7.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_7 cekbox_laporan' /></td>
//                             <td align='left'>BA Penyerahan Barang / Jasa</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket7' class='keterangan'></td>
//                         </tr>

//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='8' hidden class='nourut'/><b>8.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_8 cekbox_laporan' /></td>
//                             <td align='left'>BA Hasil Pemeriksaan Administratif</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket8' class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='9' hidden class='nourut'/><b>9.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_9 cekbox_laporan' /></td>
//                             <td align='left'>Faktur Pajak</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket9' class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='10' hidden class='nourut'/><b>10.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_10 cekbox_laporan' /></td>
//                             <td align='left'>Perincian Perhitungan Pajak</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket10' class='keterangan'></td>
//                         </tr>                
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='11' hidden class='nourut'/><b>11.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_11 cekbox_laporan' /></td>
//                             <td align='left'>Perincian Perhitungan Pajak (apabila diperlukan)</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket11' class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='12' hidden class='nourut'/><b>12.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_12 cekbox_laporan' /></td>
//                             <td align='left'>Surat Pernyataan Selisih Harga antara E-Purchasing dengan Nilai Kwitansi</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket12' class='keterangan'></td>
//                         </tr>
//                     </table>
//                     <table cellspacing='0' border='0' style='margin-top:5mm;'>   
//                       <tr>
//                         <td>Dinyatakan telah diteliti sesuai dengan ketentuan yang berlaku dan sudah memenuhi persyaratan pembayaran.</td>
//                       </tr>    
//                     </table>
//                      "
//                 );
//             }
            
//         }else if ($idjnslap == 2){

//             if ($response['count'] > 0){
//                 $countcek_noin = $this->db->query("SELECT count(no_in::integer) as x from verif_step2_det where no_in = '$no_in' and no_kwitansi='$nokwitansi' and data = '1' ")->result();

//                 $ceklist0 = $response['ListDataObj'][0]->tipecek; //dicentang trus
//                 $cekket0  = $response['ListDataObj'][0]->tipedisable; //didisable
//                 $ket0     = $response['ListDataObj'][0]->keterangan;

//                 $ceklist1 = $response['ListDataObj'][1]->tipecek; //dicentang trus
//                 $cekket1  = $response['ListDataObj'][1]->tipedisable; //didisable
//                 $ket1     = $response['ListDataObj'][1]->keterangan;

//                 $ceklist2 = $response['ListDataObj'][2]->tipecek; //dicentang trus
//                 $cekket2  = $response['ListDataObj'][2]->tipedisable; //didisable
//                 $ket2     = $response['ListDataObj'][2]->keterangan;

//                 $ceklist3 = $response['ListDataObj'][3]->tipecek; //dicentang trus
//                 $cekket3  = $response['ListDataObj'][3]->tipedisable; //didisable
//                 $ket3     = $response['ListDataObj'][3]->keterangan;

//                 $ceklist4 = $response['ListDataObj'][4]->tipecek; //dicentang trus
//                 $cekket4  = $response['ListDataObj'][4]->tipedisable; //didisable
//                 $ket4     = $response['ListDataObj'][4]->keterangan;

//                 $ceklist5 = $response['ListDataObj'][5]->tipecek; //dicentang trus
//                 $cekket5  = $response['ListDataObj'][5]->tipedisable; //didisable
//                 $ket5     = $response['ListDataObj'][5]->keterangan;

//                 $ceklist6 = $response['ListDataObj'][6]->tipecek; //dicentang trus
//                 $cekket6  = $response['ListDataObj'][6]->tipedisable; //didisable
//                 $ket6     = $response['ListDataObj'][6]->keterangan;

//                 $ceklist7 = $response['ListDataObj'][7]->tipecek; //dicentang trus
//                 $cekket7  = $response['ListDataObj'][7]->tipedisable; //didisable
//                 $ket7     = $response['ListDataObj'][7]->keterangan;

//                 $ceklist8 = $response['ListDataObj'][8]->tipecek; //dicentang trus
//                 $cekket8  = $response['ListDataObj'][8]->tipedisable; //didisable
//                 $ket8     = $response['ListDataObj'][8]->keterangan;

//                 $ceklist9 = $response['ListDataObj'][9]->tipecek; //dicentang trus
//                 $cekket9  = $response['ListDataObj'][9]->tipedisable; //didisable
//                 $ket9     = $response['ListDataObj'][9]->keterangan;

//                 $ceklist10 = $response['ListDataObj'][10]->tipecek; //dicentang trus
//                 $cekket10  = $response['ListDataObj'][10]->tipedisable; //didisable
//                 $ket10     = $response['ListDataObj'][10]->keterangan;
            
//                 $response = array(
//                                 'count_data'  => 'success',
//                                 'ListDataObj' => $cek_noin_detail->result(),
//                                 'count_det'   => $countcek_noin,
//                                 'data'        => "
//                     <table cellspacing='0' border='0' style='margin-left:10mm;'>   
//                         <tr>
//                             <td width='5mm' align='left' height='15mm'></td>
//                             <td width='20mm'><input type='checkbox' class='ceklist_lap1_all' /></td>
//                             <td align='left'><b>Centang Semua</td>
//                             <td width='200mm'><b>Keterangan</td>
//                         </tr>             
//                         <tr>
//                             <td width='5mm' align='left' height='15mm'><input type='number' value='1' hidden class='nourut'/><b>1.</td>
//                             <td width='20mm'><input type='checkbox' class='ceklist_lap1_1 cekbox_laporan' ".$ceklist0."/></td>
//                             <td align='left'>Kwitansi ( sudah ada TTD PPTK, PPK, PPHP )</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...' id='ket1' value='".$ket0."'".$cekket0." class='keterangan'></td>
//                         </tr>             
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='2' hidden class='nourut'/><b>2.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_2 cekbox_laporan' ".$ceklist1."/></td>
//                             <td align='left'>Nota / Faktur Penjualan / Invoice / Surat Perintah Pengiriman Barang</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...' id='ket2' value='".$ket1."'".$cekket1." class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='3' hidden class='nourut'/><b>3.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_3 cekbox_laporan' ".$ceklist2."/></td>
//                             <td align='left'>SP/ SPK / Perjanjian / Daftar Pesanan E-Purchasing</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...' id='ket3' value='".$ket2."'".$cekket2." class='keterangan'></td>
//                         </tr>                
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='4' hidden class='nourut'/><b>4.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_4 cekbox_laporan' ".$ceklist3."/></td>
//                             <td align='left'>BA Hasil Pemeriksaan</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket4' value='".$ket3."'".$cekket3." class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='5' hidden class='nourut'/><b>5.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_5 cekbox_laporan' ".$ceklist4."/></td>
//                             <td align='left'>BA Serah Terima Hasil Pekerjaan</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket5' value='".$ket4."'".$cekket4." class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='6' hidden class='nourut'/><b>6.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_6 cekbox_laporan' ".$ceklist5."/></td>
//                             <td align='left'>BA Penyerahan Barang / Jasa</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket6' value='".$ket5."'".$cekket5." class='keterangan'></td>
//                         </tr>

//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='7' hidden class='nourut'/><b>7.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_7 cekbox_laporan' ".$ceklist6."/></td>
//                             <td align='left'>BA Hasil Pemeriksaan Administratif</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket7' value='".$ket6."'".$cekket6." class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='8' hidden class='nourut'/><b>8.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_8 cekbox_laporan' ".$ceklist7."/></td>
//                             <td align='left'>Faktur Pajak</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket8' value='".$ket7."'".$cekket7." class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='9' hidden class='nourut'/><b>9.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_9 cekbox_laporan' ".$ceklist8."/></td>
//                             <td align='left'>Perincian Perhitungan Pajak</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket9' value='".$ket8."'".$cekket8." class='keterangan'></td>
//                         </tr>                
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='10' hidden class='nourut'/><b>10.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_10 cekbox_laporan' ".$ceklist9."/></td>
//                             <td align='left'>Surat Pernyataan Selisih Harga antara E-Purchasing dengan Nilai Kwitansi</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket10' value='".$ket9."'".$cekket9." class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='11' hidden class='nourut'/><b>11.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_11 cekbox_laporan' ".$ceklist10."/></td>
//                             <td align='left'>Surat Keterangan Pembayaran DENDA</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket11' value='".$ket10."'".$cekket10." class='keterangan'></td>
//                         </tr>
//                     </table>
//                     <table cellspacing='0' border='0' style='margin-top:5mm;'>   
//                       <tr>
//                         <td>Dinyatakan telah diteliti sesuai dengan ketentuan yang berlaku dan sudah memenuhi persyaratan pembayaran.</td>
//                       </tr>    
//                     </table>
//                      "
//                 );

//             }else{
//                 $response = array(
//                             'count_data'    => 'success',
//                             'count_det'     => '0',
//                             'ListDataObj'   => 'empty detail data laporan 2',
//                             'data'          => "
//                     <table cellspacing='0' border='0' style='margin-left:10mm;'>   
//                         <tr>
//                             <td width='5mm' align='left' height='15mm'></td>
//                             <td width='20mm'><input type='checkbox' class='ceklist_lap1_all' /></td>
//                             <td align='left'><b>Centang Semua</td>
//                             <td width='200mm'><b>Keterangan</td>
//                         </tr>             
//                         <tr>
//                             <td width='5mm' align='left' height='15mm'><input type='number' value='1' hidden class='nourut'/><b>1.</td>
//                             <td width='20mm'><input type='checkbox' class='ceklist_lap1_1 cekbox_laporan' /></td>
//                             <td align='left'>Kwitansi ( sudah ada TTD PPTK, PPK, PPHP )</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...' id='ket1' class='keterangan'></td>
//                         </tr>             
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='2' hidden class='nourut'/><b>2.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_2 cekbox_laporan' /></td>
//                             <td align='left'>Nota / Faktur Penjualan / Invoice / Surat Perintah Pengiriman Barang</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...' id='ket2' class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='3' hidden class='nourut'/><b>3.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_3 cekbox_laporan' /></td>
//                             <td align='left'>SP/ SPK / Perjanjian / Daftar Pesanan E-Purchasing</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...' id='ket3' class='keterangan'></td>
//                         </tr>                
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='4' hidden class='nourut'/><b>4.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_4 cekbox_laporan' /></td>
//                             <td align='left'>BA Hasil Pemeriksaan</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket4' class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='5' hidden class='nourut'/><b>5.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_5 cekbox_laporan'/></td>
//                             <td align='left'>BA Serah Terima Hasil Pekerjaan</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket5' class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='6' hidden class='nourut'/><b>6.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_6 cekbox_laporan' /></td>
//                             <td align='left'>BA Penyerahan Barang / Jasa</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket6' class='keterangan'></td>
//                         </tr>

//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='7' hidden class='nourut'/><b>7.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_7 cekbox_laporan' /></td>
//                             <td align='left'>BA Hasil Pemeriksaan Administratif</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket7' class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='8' hidden class='nourut'/><b>8.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_8 cekbox_laporan' /></td>
//                             <td align='left'>Faktur Pajak</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket8' class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='9' hidden class='nourut'/><b>9.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_9 cekbox_laporan' /></td>
//                             <td align='left'>Perincian Perhitungan Pajak</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket9' class='keterangan'></td>
//                         </tr>                
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='10' hidden class='nourut'/><b>10.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_10 cekbox_laporan' /></td>
//                             <td align='left'>Surat Pernyataan Selisih Harga antara E-Purchasing dengan Nilai Kwitansi</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket10' class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='11' hidden class='nourut'/><b>11.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_11 cekbox_laporan' /></td>
//                             <td align='left'>Surat Keterangan Pembayaran DENDA</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket11' class='keterangan'></td>
//                         </tr>
//                     </table>
//                     <table cellspacing='0' border='0' style='margin-top:5mm;'>   
//                       <tr>
//                         <td>Dinyatakan telah diteliti sesuai dengan ketentuan yang berlaku dan sudah memenuhi persyaratan pembayaran.</td>
//                       </tr>    
//                     </table>
//                      "
//                 );
//             }
//         }else if ($idjnslap == 3){
//             if ($response['count'] > 0){
//                 $countcek_noin = $this->db->query("SELECT count(no_in::integer) as x from verif_step2_det where no_in = '$no_in' and no_kwitansi='$nokwitansi' and data = '1' ")->result();

//                 $ceklist0 = $response['ListDataObj'][0]->tipecek; //dicentang trus //no urut 1
//                 $cekket0  = $response['ListDataObj'][0]->tipedisable; //didisable
//                 $ket0     = $response['ListDataObj'][0]->keterangan;

//                 $ceklist1 = $response['ListDataObj'][1]->tipecek; //dicentang trus //no urut 2
//                 $cekket1  = $response['ListDataObj'][1]->tipedisable; //didisable
//                 $ket1     = $response['ListDataObj'][1]->keterangan;

//                 $ceklist2 = $response['ListDataObj'][2]->tipecek; //dicentang trus //no urut 3
//                 $cekket2  = $response['ListDataObj'][2]->tipedisable; //didisable
//                 $ket2     = $response['ListDataObj'][2]->keterangan;

//                 $ceklist3 = $response['ListDataObj'][3]->tipecek; //dicentang trus //no urut 4
//                 $cekket3  = $response['ListDataObj'][3]->tipedisable; //didisable
//                 $ket3     = $response['ListDataObj'][3]->keterangan;

//                 $ceklist4 = $response['ListDataObj'][4]->tipecek; //dicentang trus //no urut 5
//                 $cekket4  = $response['ListDataObj'][4]->tipedisable; //didisable
//                 $ket4     = $response['ListDataObj'][4]->keterangan;

//                 $ceklist5 = $response['ListDataObj'][5]->tipecek; //dicentang trus //no urut 6
//                 $cekket5  = $response['ListDataObj'][5]->tipedisable; //didisable
//                 $ket5     = $response['ListDataObj'][5]->keterangan;

//                 $ceklist6 = $response['ListDataObj'][6]->tipecek; //dicentang trus //no urut 7
//                 $cekket6  = $response['ListDataObj'][6]->tipedisable; //didisable
//                 $ket6     = $response['ListDataObj'][6]->keterangan;

//                 $ceklist7 = $response['ListDataObj'][7]->tipecek; //dicentang trus //no urut 8
//                 $cekket7  = $response['ListDataObj'][7]->tipedisable; //didisable
//                 $ket7     = $response['ListDataObj'][7]->keterangan;

//                 $ceklist8 = $response['ListDataObj'][8]->tipecek; //dicentang trus //no urut 9
//                 $cekket8  = $response['ListDataObj'][8]->tipedisable; //didisable
//                 $ket8     = $response['ListDataObj'][8]->keterangan;

//                 $ceklist9 = $response['ListDataObj'][9]->tipecek; //dicentang trus //no urut 10
//                 $cekket9  = $response['ListDataObj'][9]->tipedisable; //didisable
//                 $ket9     = $response['ListDataObj'][9]->keterangan;

//                 $ceklist10 = $response['ListDataObj'][10]->tipecek; //dicentang trus //no urut 11
//                 $cekket10  = $response['ListDataObj'][10]->tipedisable; //didisable
//                 $ket10     = $response['ListDataObj'][10]->keterangan;

//                 $ceklist11 = $response['ListDataObj'][11]->tipecek; //dicentang trus //no urut 12
//                 $cekket11  = $response['ListDataObj'][11]->tipedisable; //didisable
//                 $ket11     = $response['ListDataObj'][11]->keterangan;              

//                 $ceklist12 = $response['ListDataObj'][12]->tipecek; //dicentang trus //no urut 13
//                 $cekket12  = $response['ListDataObj'][12]->tipedisable; //didisable
//                 $ket12     = $response['ListDataObj'][12]->keterangan;              

//                 $response = array(
//                                 'count_data'  => 'success',
//                                 'ListDataObj' => $cek_noin_detail->result(),
//                                 'count_det'   => $countcek_noin,
//                                 'data'        => "

//                     <table cellspacing='0' border='0' style='margin-left:10mm;'>   
//                         <tr>
//                             <td width='5mm' align='left' height='15mm'></td>
//                             <td width='20mm'><input type='checkbox' class='ceklist_lap1_all' /></td>
//                             <td align='left'><b>Centang Semua</td>
//                             <td width='200mm'><b>Keterangan</td>
//                         </tr>             
//                         <tr>
//                             <td width='5mm' align='left' height='15mm'><input type='number' value='1' hidden class='nourut'/><b>1.</td>
//                             <td width='20mm'><input type='checkbox' class='ceklist_lap1_1 cekbox_laporan' ".$ceklist0."/></td>
//                             <td align='left'>Kwitansi</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...' id='ket1' class='keterangan' value='".$ket0."'".$cekket0."></td>
//                         </tr>             
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='2' hidden class='nourut'/><b>2.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_2 cekbox_laporan' ".$ceklist1."/></td>
//                             <td align='left'>Nota / Faktur Penjualan / Invoice / Surat Perintah Pengiriman Barang</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...' id='ket2' class='keterangan'value='".$ket1."'".$cekket1."></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='3' hidden class='nourut'/><b>3.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_3 cekbox_laporan' ".$ceklist2."/></td>
//                             <td align='left'>SP/ SPK / Perjanjian / Daftar Pesanan E-Purchasing</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...' id='ket3' class='keterangan'value='".$ket2."'".$cekket2."></td>
//                         </tr>                
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='4' hidden class='nourut'/><b>4.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_4 cekbox_laporan' ".$ceklist3."/></td>
//                             <td align='left'>BA Hasil Pemeriksaan</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket4' class='keterangan'value='".$ket3."'".$cekket3."></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='5' hidden class='nourut'/><b>5.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_5 cekbox_laporan' ".$ceklist4."/></td>
//                             <td align='left'>BA Serah Terima Hasil Pekerjaan</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket5' class='keterangan' value='".$ket4."'".$cekket4."></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='6' hidden class='nourut'/><b>6.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_6 cekbox_laporan' ".$ceklist5."/></td>
//                             <td align='left'>BA Kemajuan</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket6' class='keterangan' value='".$ket5."'".$cekket5."></td>
//                         </tr>

//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='7' hidden class='nourut'/><b>7.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_7 cekbox_laporan' ".$ceklist6."/></td>
//                             <td align='left'>BA Penyerahan Barang / Jasa</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket7' class='keterangan' value='".$ket6."'".$cekket6."></td>
//                         </tr>

//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='8' hidden class='nourut'/><b>8.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_8 cekbox_laporan' ".$ceklist7."/></td>
//                             <td align='left'>BA Hasil Pemeriksaan Administratif</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket8' class='keterangan' value='".$ket7."'".$cekket7."></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='9' hidden class='nourut'/><b>9.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_9 cekbox_laporan' ".$ceklist8."/></td>
//                             <td align='left'>BA Pembayaran</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket9' class='keterangan' value='".$ket8."'".$cekket8."></td>
//                         </tr>

//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='10' hidden class='nourut'/><b>10.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_10 cekbox_laporan' ".$ceklist9."/></td>
//                             <td align='left'>Faktur Pajak</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket10' class='keterangan' value='".$ket9."'".$cekket9."></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='11' hidden class='nourut'/><b>11.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_11 cekbox_laporan' ".$ceklist10."/></td>
//                             <td align='left'>Perincian Perhitungan Pajak</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket11' class='keterangan' value='".$ket10."'".$cekket10."></td>
//                         </tr>                
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='12' hidden class='nourut'/><b>12.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_12 cekbox_laporan' ".$ceklist11."/></td>
//                             <td align='left'>Surat Pernyataan Selisih Harga antara E-Purchasing dengan Nilai Kwitansi</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket12' class='keterangan' value='".$ket11."'".$cekket11."></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='13' hidden class='nourut'/><b>13.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_13 cekbox_laporan' ".$ceklist12."/></td>
//                             <td align='left'>Surat Keterangan Pembayaran DENDA</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket13' class='keterangan' value='".$ket12."'".$cekket12."></td>
//                         </tr>
//                     </table>
//                     <table cellspacing='0' border='0' style='margin-top:5mm;'>   
//                       <tr>
//                         <td>Dinyatakan telah diteliti sesuai dengan ketentuan yang berlaku dan sudah memenuhi persyaratan pembayaran.</td>
//                       </tr>    
//                     </table>
//                      "
//                 );

//             }else{

//                 $response = array(
//                             'count_data'    => 'success',
//                             'count_det'     => '0',
//                             'ListDataObj'   => 'empty detail data laporan 3',
//                             'data'          => "
//                     <table cellspacing='0' border='0' style='margin-left:10mm;'>   
//                         <tr>
//                             <td width='5mm' align='left' height='15mm'></td>
//                             <td width='20mm'><input type='checkbox' class='ceklist_lap1_all' /></td>
//                             <td align='left'><b>Centang Semua</td>
//                             <td width='200mm'><b>Keterangan</td>
//                         </tr>             
//                         <tr>
//                             <td width='5mm' align='left' height='15mm'><input type='number' value='1' hidden class='nourut'/><b>1.</td>
//                             <td width='20mm'><input type='checkbox' class='ceklist_lap1_1 cekbox_laporan' /></td>
//                             <td align='left'>Kwitansi</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...' id='ket1' class='keterangan'></td>
//                         </tr>             
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='2' hidden class='nourut'/><b>2.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_2 cekbox_laporan' /></td>
//                             <td align='left'>Nota / Faktur Penjualan / Invoice / Surat Perintah Pengiriman Barang</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...' id='ket2' class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='3' hidden class='nourut'/><b>3.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_3 cekbox_laporan' /></td>
//                             <td align='left'>SP/ SPK / Perjanjian / Daftar Pesanan E-Purchasing</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...' id='ket3' class='keterangan'></td>
//                         </tr>                
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='4' hidden class='nourut'/><b>4.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_4 cekbox_laporan' /></td>
//                             <td align='left'>BA Hasil Pemeriksaan</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket4' class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='5' hidden class='nourut'/><b>5.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_5 cekbox_laporan'/></td>
//                             <td align='left'>BA Serah Terima Hasil Pekerjaan</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket5' class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='6' hidden class='nourut'/><b>6.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_6 cekbox_laporan' /></td>
//                             <td align='left'>BA Kemajuan</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket6' class='keterangan'></td>
//                         </tr>

//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='7' hidden class='nourut'/><b>7.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_7 cekbox_laporan' /></td>
//                             <td align='left'>BA Penyerahan Barang / Jasa</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket7' class='keterangan'></td>
//                         </tr>

//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='8' hidden class='nourut'/><b>8.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_8 cekbox_laporan' /></td>
//                             <td align='left'>BA Hasil Pemeriksaan Administratif</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket8' class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='9' hidden class='nourut'/><b>9.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_9 cekbox_laporan' /></td>
//                             <td align='left'>BA Pembayaran</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket9' class='keterangan'></td>
//                         </tr>

//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='10' hidden class='nourut'/><b>10.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_10 cekbox_laporan' /></td>
//                             <td align='left'>Faktur Pajak</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket10' class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='11' hidden class='nourut'/><b>11.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_11 cekbox_laporan' /></td>
//                             <td align='left'>Perincian Perhitungan Pajak</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket11' class='keterangan'></td>
//                         </tr>                
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='12' hidden class='nourut'/><b>12.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_12 cekbox_laporan' /></td>
//                             <td align='left'>Surat Pernyataan Selisih Harga antara E-Purchasing dengan Nilai Kwitansi</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket12' class='keterangan'></td>
//                         </tr>
//                         <tr>
//                             <td width='5mm' align='left' height='7mm'><input type='number' value='13' hidden class='nourut'/><b>13.</td>
//                             <td><input type='checkbox' class='ceklist_lap1_13 cekbox_laporan' /></td>
//                             <td align='left'>Surat Keterangan Pembayaran DENDA</td>
//                             <td><input type='text' name='keterangan' placeholder='Keterangan...'id='ket13' class='keterangan'></td>
//                         </tr>
//                     </table>
//                     <table cellspacing='0' border='0' style='margin-top:5mm;'>   
//                       <tr>
//                         <td>Dinyatakan telah diteliti sesuai dengan ketentuan yang berlaku dan sudah memenuhi persyaratan pembayaran.</td>
//                       </tr>    
//                     </table>
//                      "
//                 );
//             }
//         }else{
//             $response = array(
//                 'count_data'=> 'false',            
//                 'data'      => 'Belum Diproses !!!'
//             );
//         }    
//         echo json_encode($response);
//     }

//     public function cek_proses_verifikasi(){
//         $postidform    = $this->input->post('id_form');
//         $explodeidform = explode("#",$postidform);
//         $idform        = $explodeidform[0];
//         $nokwitansi    = $explodeidform[2];
//         $noin          = $explodeidform[4];
//         $cek_noin      = $this->Mload_module->cek_noin($idform,$nokwitansi,$noin);        
//         $countcek_noin = $this->db->query("SELECT count(no_in::integer) as jmlh_noin from verif_step2_det where no_in = '$noin' and no_kwitansi='$nokwitansi' and data = '1' ")->result();
//         $response = array(
//             'count'       => $cek_noin->num_rows(),
//             'ListDataObj' => $cek_noin->result(),
//             'idform'      => $idform,
//             'nokwitansi'  => $nokwitansi,
//             'noin'        => $noin,
//             'count_det'   => $countcek_noin,
//         );
//         //$no_kwitansi = $response['ListDataObj'][0]->no_kwitansi;
//         echo json_encode($response);
//     }

//     public function savelaporan_verifstepdua(){
//         $no_array       = 0;
//         $no_array2       = 0;
        
//         $idform         = $this->input->post('idform');
//         $noin           = $this->input->post('noin');
//         $nokwitansi     = $this->input->post('nokwitansi');
//         $jns_laporan    = $this->input->post('jns_lap');
//         $cekbox_laporan = json_decode(stripslashes($this->input->post('cekbox_laporan')));
//         $nourut         = json_decode(stripslashes($this->input->post('nourut')));
//         $keterangan     = json_decode(stripslashes($this->input->post('ket')));

//         $ceknoin    = $this->db->query("SELECT MAX(no_in::integer) as jmlh_noin from verif_step2")->result();
//         foreach ($ceknoin as $idformx) {
//             $cek_noin    = $idformx->jmlh_noin;  
//             $cek_noinplus = $cek_noin+1;

//             if ($cek_noin > 0){                    
//                 $no_innew   = $cek_noin+1;
//             }else{
//                 $no_innew   = '1000'.$cek_noinplus;
//             }                
//         }
                
//         if(isset($idform)){
//             $response = array(
//                 'result'  => 'true'
//             );
//         }else{
//             $response = array(
//                 'result'  => 'false'
//             );
//         }   
       
//         if ($response['result'] == true) {
            
//             $cekkwitansi = $this->Mload_module->mcekkwitansi($nokwitansi)->num_rows();
//             if ($cekkwitansi > 0){ //No Kwitansi Sudah Terdaftar, Pastikan No Kwitansi yang digunakan belum terdaftar !!!
//                 // $response = array(
//                 //     'count_data'  => 404,
//                 //     'pesan'       => "No Kwitansi Sudah Terdaftar, Pastikan No Kwitansi yang digunakan belum terdaftar !!!",
//                 // );

//                 //hapus detaile sek
               
                
//                 $this->Mload_module->delete_verifstep2_detail($noin, $nokwitansi);

//                 //trus diinsert neh 
                
//                 foreach($cekbox_laporan as $cekbox_laporan_result){
//                     $data_ceklist = $cekbox_laporan[$no_array2];                                                
//                     $data_ket     = $keterangan[$no_array2];
//                     $data_nourut  = $nourut[$no_array2];
//                     $result       = $this->Mload_module->simpanbaru_laporandetail($noin, $nokwitansi, $data_ceklist, $data_ket, $data_nourut);
//                     $no_array2++;
//                 }

//                 $response = array(
//                     'count_data'       => $result,
//                 );

//                 $countcek_noin = $this->db->query("SELECT count(no_in::integer) as x from verif_step2_det where no_in = '$noin' and no_kwitansi='$nokwitansi' and data = '1' ")->result();
//                 if ($response['count_data'] > 0 ){
                   
//                     $response = array(
//                         'count_data'  => 200,
//                         'pesan'       => "Berhasil Disimpan",
//                         'no_in'       => $noin,
//                         'count_det'   => $countcek_noin,
//                         'jns_lap'     => $jns_laporan,
//                     );
//                 }else{
//                     $response = array(
//                         'count_data'  => 404,
//                         'pesan'       => "Gagal Inserted Detail 2",
//                         'no_in'       => $noin,
//                         'count_det'   => $countcek_noin,
//                     );                    
//                 }

//             }else{
                
//                 $data = array(            
//                     "no_in"         =>   $no_innew,
//                     "no_kwitansi"   =>   $nokwitansi,
//                     "id_akses"      =>   $this->session->userdata('id_akses'),                    
//                     "tgl_entry"     =>   date('Y-m-d'),
//                     "jns_laporan"   =>   $jns_laporan
//                 );
                
//                 $result = $this->Mload_module->simpanbaru_laporan($data);                

//                 $response = array(                
//                     'count_data'       => $result,
//                 );

//                 if ($response['count_data'] > 0 ){
//                     // $response = array(
//                     //     'count_data'  => 200,
//                     //     'pesan'       => "Data Tersimpan",
//                     //     'no_in'       => $no_innew,
//                     // );
//                     //foreach($nourut as $nourutx){                        

//                         foreach($cekbox_laporan as $cekbox_laporan_result){
//                             $data_ceklist = $cekbox_laporan[$no_array];                                                
//                             $data_ket     = $keterangan[$no_array];
//                             $data_nourut  = $nourut[$no_array];
//                             $result = $this->Mload_module->simpanbaru_laporandetail($no_innew, $nokwitansi, $data_ceklist, $data_ket, $data_nourut);
//                             $countcek_noin2 = $this->db->query("SELECT count(no_in::integer) as x from verif_step2_det where no_in = '$noin' and no_kwitansi='$nokwitansi' and data = '1' ")->result();
//                             $no_array++;                            
//                         }
                        
//                     //}
//                     $response = array(                
//                         'count_data'       => $result,
//                     );

                    
//                     if ($response['count_data'] > 0 ){
                        
//                         $response = array(
//                             'count_data'  => 200,
//                             'pesan'       => "Berhasil Disimpan",
//                             'no_in'       => $no_innew,
//                             'count_det'   => $countcek_noin2,
//                             'jns_lap'     => $jns_laporan,
//                         );                
//                     }else{
//                         $response = array(
//                             'count_data'  => 404,
//                             'pesan'       => "Gagal Inserted Detail 1",
//                            // 'count_det'   => $countcek_noin2,
//                         );                    
//                     }

//                 }else{
//                     $response = array(
//                         'count_data'  => 404,
//                         'pesan'       => "Gagal Inserted All",                        
//                     );                
//                 }
//             }
//         }else{
//             $response = array(
//                 'count_data'  => 404,                   
//                 'pesan'       => "No Kwitansi Kosong",
//             ); 
//         }
//         echo json_encode($response);
//     }

//     function delete_laporanverif(){
//         $idform         = $this->input->post('idform');
//         $noin           = $this->input->post('no_in');
//         $nokwitansi     = $this->input->post('nokwitansi');
//         $reason         = $this->input->post('reason');

//         $cekkwitansi = $this->Mload_module->cek_noin($idform,$nokwitansi,$noin)->num_rows();
//             if ($cekkwitansi > 0){ //No Kwitansi Sudah Terdaftar                
//                 $result = $this->Mload_module->delete_verifstep2($noin, $nokwitansi);
//                 $response = array(
//                     'count_data'       => $result,
//                 );
//                 if ($response['count_data'] > 0){
//                     //insert ke tabel hapus lap
//                     $data = array(
//                         'no_in'         => $noin,
//                         'no_kwitansi'   => $nokwitansi,
//                         'tgl_delete'    => date('Y-m-d'),
//                         'kd_user'       => $this->session->userdata('id_akses'),

//                     );
//                     $result = $this->Mload_module->insert_history_del($data);
                    
//                     $response = array(
//                          'count_data'       => $result,
//                     );
//                     if ($response['count_data'] > 0){
//                         $response = array(
//                             'count_data'  => 200,                   
//                             'pesan'       => "Berhasil Dihapus !!!",
//                             'alasan'      => $reason,
//                         ); 
//                     }
                    
//                 }else{
//                     $response = array(
//                         'count_data'  => 404,                   
//                         'pesan'       => "Gagal Hapus Verifikasi Cek !!!",
//                         'alasan'      => $reason,
//                     ); 
//                 }
//             }else{
//                 $response = array(
//                     'count_data'  => 404,                   
//                     'pesan'       => "No Kwitansi Tidak Ditemukan !!!",
//                     'alasan'      => $reason,
//                 ); 
//             }
//          echo json_encode($response);
//     }

//      function posting_verifkedua(){
//         $idform         = $this->input->post('idform');
//         $noin           = $this->input->post('no_in');
//         $nokwitansi     = $this->input->post('nokwitansi');        

//         $cekkwitansi = $this->Mload_module->cek_noin($idform,$nokwitansi,$noin)->num_rows();
//         if ($cekkwitansi > 0){ //No Kwitansi Sudah Terdaftar                
//             $result = $this->Mload_module->sudahselesai_verifikasi($idform, $nokwitansi);
//             $response = array(
//                 'count_data'       => $result,
//             );
//             if ($response['count_data'] > 0){
//                 //update di ecc_kendali
//                 $response = array(
//                     'count_data'  => 200,                   
//                     'pesan'       => "Berhasil diPosting",  
//                     'no_in'       => $noin,
//                     'no_kwitansi' => $nokwitansi,
//                     'id_form'     => $idform,
//                     'kd_user'     => $this->session->userdata('id_akses'),
//                 );

//             }else{
//                 $response = array(
//                     'count_data'  => 404,                   
//                     'pesan'       => "Gagal Posting !!!",                        
//                 ); 
//             }
//         }else{
//             $response = array(
//                 'count_data'  => 404,                   
//                 'pesan'       => "No Kwitansi Tidak Ditemukan !!!",                    
//             ); 
//         }
//         echo json_encode($response);
//     }

}

?>