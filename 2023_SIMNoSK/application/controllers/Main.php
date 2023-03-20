<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->model('session_apps');
        $this->load->model('m_main');        
    }

    function index() {

        $this->load->view('ui/display');
             
        //$data['data']  = $this->m_main->get_mod_group_detail()->result();   
        //$data['groupmod']  = $this->m_main->get_groupmod()->result();
        //$data['vendor']  = $this->m_main->get_vendor()->result();   
        //$group_name['group_name']  = $this->m_main->get_group_name()->result();   
        // $this->load->view("modal/plus_user.php", $data);
         $this->load->view("modal/form_profil.php");
        // $this->load->view("modal/plus_module.php", $group_name);
        // $this->load->view("modal/plus_groupmodule.php");
        // $this->load->view("modal/form_kartukendali.php", $data);
    }

    function onproces() {                
                
        $user = $this->input->post("username", TRUE);
        $pass = $this->input->post('password', TRUE);
    
        $where = array(
            'user'  => $user,
            'pass'  => md5($pass),
            'aktif' => 1,
        );

        $checking = $this->session_apps->check_login($where);

        if($checking->num_rows() > 0){
            $data = $checking->row_array();                
    
            $response = array(
                'code_user'     => $data['code_user'],
                'user'          => $data['user'],
                'pass'          => $data['pass'],
                'nm_lengkap'    => $data['nm_lengkap'],
                'level'         => $data['level'],
                'show_pass'     => $data['show_pass'],
                'aktif'         => $data['aktif'],
                'modul_angg'    => $data['modul_angg'],
                'mod_id'        => $data['mod_id'],
                'mod_id_group'  => $data['mod_id_group'],
                'ket_level'     => $data['ket'],
                            
            ); 
     
            session_start();                        
            $this->session->set_userdata($response);
            setcookie('ekorsuk_itisi',json_encode($response), time() + (86400 * 30), "/");            
            redirect('main');
            
            
        }else{
            $data['error'] = '<div class="alert alert-danger border-bottom-dangerottom-danger">                    
            <b><i class="fa fa-exclamation-circle"></i> Oops,.. Maaf,</b>
            <br>
            NIP/NPK atau Password Anda Salah !!!
            </div><hr>';
            $data['true'] = 400;

            $this->load->view('ui/display', $data);
            // $response = array(                
            //     'error'         => $data['error'],
            //     'count_data'    => 400,                
            // );
            // echo json_encode($response);
        }
    }

    public function get_modulesidebar(){
        $mod_id_group = $this->session->userdata('mod_id_group');
        if ($mod_id_group != ''){
            $query        = $this->db->query("SELECT * from mod_group_name WHERE id_group in ($mod_id_group) ORDER BY urut DESC")->result();    
            $response = array(
                'success'       => true,
                'ListDataObj'   => $query,
                'totalrecords'  => count($query),
                'info'          => 'informasi get_modulesidebar'
            );
        }else{
            $response = array(
                'success'       => false,
                'ListDataObj'   => null,
                'totalrecords'  => null,
                'info'          => 'informasi get_modulesidebar'
            );
        }
                
        echo json_encode($response);
        //echo '{success:true, totalrecords:'.count($query).', ListDataObj:'.json_encode($query).'}';
    }

    public function get_modulesidebar_sub(){
        
        $mod_id_detail = $this->session->userdata('mod_id_detail');

        if ($mod_id_detail != ''){
            $query = $this->db->query("SELECT * from mod_group_detail WHERE mod_id in ($mod_id_detail) ORDER BY mod_id ASC")->result();
            $response = array(
                'success'           => true,
                'ListDataObj_Mod'   => $query,
                'totalrecords'      => count($query),
                'info'              => 'informasi get_modulesidebar_sub'
            );
        }else{
            $response = array(
                'success'           => false,
                'ListDataObj_Mod'   => null,
                'totalrecords'      => null,
                'info'              => 'informasi get_modulesidebar_sub'
            );
        }
        echo json_encode($response);
        //echo '{success:true, totalrecords:'.count($query).', ListDataObj_Mod:'.json_encode($query).'}';
    }

    public function get_data_all(){
        // $level_user = $this->session->userdata('level');
        // $useragent = $_SERVER["HTTP_USER_AGENT"];
        // $posisi = strpos($useragent,"Android");
        // if ($posisi){
        //   $perangkat = 'Android';
        // }else {
        //   $perangkat = 'PC';
        // }
        $nip                = $this->session->userdata('nip');
        $count_spt          = $this->db->query("SELECT count(id_spt)as count_spt FROM tb_spt WHERE nip_petugas_admin = '$nip'");
        $count_sppd         = $this->db->query("SELECT count(id_sppd)as count_sppd FROM tb_input_sppdbaru WHERE nip_petugas_admin = '$nip'");
        $count_report_sppd  = $this->db->query("SELECT count(id)as count_report_sppd FROM tb_laporan_petugas_stlh_perj_dinas tl INNER JOIN tb_spt ts ON tl.nomor_spt = ts.nomor_spt WHERE ts.nip_petugas_admin = '$nip'");
        $count_pegawai      = $this->db->query("SELECT count(id_nip)as count_pegawai from tb_pegawai WHERE status = 'y'");        
        
        $response = array(                
                'data1'         => $count_spt->result(),
                'data2'         => $count_sppd->result(),
                'data3'         => $count_report_sppd->result(),
                'data4'         => $count_pegawai->result(),                
                // 'spesifikasi' => $perangkat,
                // 'lvel_user' => $level_user,
        );
        echo json_encode($response);
    }

    public function get_image(){
     
        $image              = $this->db->query("SELECT nama_image from image_ where status = '1'");        
        $response = array(
                'ListDataObj'   => $image->result(),                
        );
        echo json_encode($response);
    }
    // public function getDataUser(){

    //     $idakses = $this->session->userdata('id_akses');
    //     $query = $this->db->query("SELECT * from akses where id_akses = '$idakses'");
    //     $response = array(
    //             'count_data'  => $query->num_rows(),
    //             'result_data' => $query->result(),
    //     );
    //     echo json_encode($response);
    // }

    

   

    function gantiPass(){
        $id         = $this->session->userdata('id_akses');
        $passbaru   = $this->input->post('newpassword');
        $passlama   = $this->input->post('oldpassword');
        $passlamamd5= md5($this->input->post('oldpassword'));
        $passbarumd5= md5($this->input->post('newpassword'));

        $cek = $this->m_main->cek_user($id, $passlamamd5);
        
        if (($passbaru == '')||($passlama == '')){
            $response = array(
                'count_data'  => 404,
                'pesan'       => "Masih ida inputan yang kosong !!!",
            );
        }else{
            $response = array(
                    'count_data'  => $cek->num_rows(),
                    'pesan'       => "Password Salah !!!",
            );

            if ($response['count_data'] > 0 ){
                $data = $this->m_main->update_password($id, $passbaru, $passbarumd5);
                $response = array(
                    'count_data'  => 1,
                    'pesan'       => "Berhasil Di Update",
                );            
            }
        }

        echo json_encode($response);
    }

     function save_user(){
        $last = $this->db->query("SELECT MAX(id_akses::integer) as id_akses from akses ")->result();
        foreach ($last as $l) {
            $lid    = $l->id_akses;
            $lastid = intval($lid) + 1;
        }

        $username       = $this->input->post('username');
        $nip_nik        = $this->input->post('nip_nik');
        $nama_lengkap   = $this->input->post('nama_lengkap');
        $newpassword    = $this->input->post('newpassword');
        $newpasswordmd5 = md5($this->input->post('newpassword'));
        $level          = $this->input->post('level');
        $aktif          = $this->input->post('aktif');
        $modid          = $this->input->post('list');
        $groupmodid     = $this->input->post('list_groupmod');
        $kd_vendor      = $this->input->post('kd_vendor');
        $tglbuat        = date('Y-m-d');

        $mod_id = '';
        for($i=0,$iLen=count($modid); $i<$iLen;$i++){
            if($mod_id!=''){
                $mod_id.=','; 
            }
            $mod_id.="'".$modid[$i]."'";
        }

        $groupmod_id = '';
        for($i=0,$iLen=count($groupmodid); $i<$iLen;$i++){
            if($groupmod_id!=''){
                $groupmod_id.=','; 
            }
            $groupmod_id.="'".$groupmodid[$i]."'";
        }

        $cek = $this->m_main->cek_id($lastid);

        if (($username == '')||($nip_nik == '')||($nama_lengkap == '')||($newpassword == '')){
            $response = array(
                'count_data'  => 404,
                'pesan'       => "Masih ada inputan yang kosong !!!",
            );
        }else{
            
            $response = array(
                    'count_data'  => $cek->num_rows(),
            );

            if ($response['count_data'] == 0 ){
                //$data = $this->m_main->simpan_user($lastid, $username, $nip_nik, $nama_lengkap, $newpassword, $newpasswordmd5, $level, $aktif, $mod_id, $tglbuat);
                if ($mod_id == ''){
                    $mod_id = "'0'";
                }

                if ($groupmod_id == ''){
                    $groupmod_id = "'104'"; //menukeluar
                }

                $data = array(            
                    "id_akses"       =>   $lastid,
                    "username"       =>   $username,
                    "password"       =>   $newpasswordmd5,                    
                    "level"          =>   $level,
                    "show_pass"      =>   $newpassword,
                    "aktif"          =>   $aktif,
                    "mod_id"         =>   $mod_id,
                    "tgl_buat"       =>   $tglbuat,
                    "cookie"         =>   '',
                    "nama_lengkap"   =>   $nama_lengkap,
                    "nip"            =>   $nip_nik,
                    "mod_id_group"   =>   $groupmod_id,
                    "kd_vendor"      =>   $kd_vendor

                );

                $this->m_main->simpan_user($data);
                $response = array(
                    'count_data'  => 200,
                    'pesan'       => "Berhasil Di Simpan",
                );

            }else{
                $response = array(
                    'count_data'  => 0,
                    'pesan'       => "Gagal Simpan",
                );
            }
        }

        echo json_encode($response);
    }

    function save_mod(){
        $mod_name   = $this->input->post('mod_name');
        $group_name = $this->input->post('group_name');
        $icon       = $this->input->post('select_icon');
        $select_opsi_submenu       = $this->input->post('select_opsi_submenu');

        if ($icon == 0){
            $icon_v = "fas fa-check";
        }else if ($icon == 1){
            $icon_v = "fa fa-list-alt";
        }else if ($icon == 2){
            $icon_v = "fa fa-list";
        }else if ($icon == 3){
            $icon_v = "fa fa-plus-circle";
        }else if ($icon == 4){
            $icon_v = "fa fa-user";
        }else if ($icon == 5){
            $icon_v = "fa fa-users";
        }else if ($icon == 6){
            $icon_v = "fas fa-sign-out-alt";
        }

        if (($mod_name == '')||($group_name == '0')||($select_opsi_submenu == '9')){
            $result = 'false';
        }else{
            $result = 'true';
        }

        if ($result == 'true') {

            $idgrup    = $this->db->query("SELECT id_group as id_group from group_name WHERE group_name = '$group_name'")->result();
            $count_mod = $this->db->query("SELECT count(mod_id)+1 as jmlh_mod from mod_group WHERE group_name = '$group_name'")->result();

            foreach ($count_mod as $count_modx) {
                $jmlh_mod    = $count_modx->jmlh_mod;
            }

            foreach ($idgrup as $idgrupx) {
                $id_group    = $idgrupx->id_group;
            }
         
            $modid = $id_group.'_'.$jmlh_mod;

            $mod_name_low   = strtolower($mod_name);
            $replace        = str_replace(" ","_",$mod_name_low);
            $idmodul_target = $replace.'_modultarget';
            
            if ($select_opsi_submenu == 1){ //content samping
                $deskripsi      = '<li class="nav-item"><a href="#" class="nav-link klik_menu" id="'.$idmodul_target.'"><i class="'.$icon_v.' nav-icon"></i><p>'.$mod_name.'</p></a></li>';                
            }else if ($select_opsi_submenu == 0){ //langsung modal
                $deskripsi      = '<li class="nav-item"><a href="#" class="nav-link" data-toggle="modal" data-target="#'.$idmodul_target.'"><i class="'.$icon_v.' nav-icon"></i><p>'.$mod_name.'</p></a></li>';
            }
            

            $data = array(            
                "mod_id"        =>   $modid,
                "mod_name"      =>   $mod_name,
                "group_name"    =>   $group_name,
                "deskripsi_mod" =>   $deskripsi,
                "idmodul_target" =>  $idmodul_target
            );
            $this->m_main->simpan_module($data);       
            $response = array(
                'count_data'  => 200,
                'pesan'       => "Berhasil Di Simpan",
            );

        }else{            
            $response = array(             
             'count_data'  => 404,
             'pesan'       => "Masih ada inputan/pilihan yang belum diisi !!!",
            );
        }
        echo json_encode($response);
    }

    function save_modgroup(){
        
        $group_name = $this->input->post('group_name');
        $icon       = $this->input->post('select_icon');
        $opsi_sub   = $this->input->post('select_opsi_sub');

        if ($group_name == ''){
            $result = 'false';
        }else{
            $result = 'true';
        }

        if ($result == 'true') {

            $idgrup    = $this->db->query("SELECT MAX(id_group::integer)+1 as id_group from group_name")->result();
            
            foreach ($idgrup as $idgrupx) {
                $id_group    = $idgrupx->id_group;
            }                    

            if ($icon == 0){
                $icon_v = "fas fa-check";
            }else if ($icon == 1){
                $icon_v = "fa fa-list-alt";
            }else if ($icon == 2){
                $icon_v = "fa fa-list";
            }else if ($icon == 3){
                $icon_v = "fa fa-plus-circle";
            }else if ($icon == 4){
                $icon_v = "fa fa-user";
            }else if ($icon == 5){
                $icon_v = "fa fa-users";
            }else if ($icon == 6){
                $icon_v = "fas fa-sign-out-alt";
            }
            
            $grup_name_low  = strtolower($group_name);
            $replace        = str_replace(" ","_",$grup_name_low);
            $idmodul_target = $replace.'_group';

            if ($opsi_sub == 1){ //ada sub menu
                $submenu = 1;
                $deskripsi = '<li class="nav-item has-treeview"><a href="#" class="nav-link" ><i class="nav-icon '.$icon_v.'"></i> <p>'.$group_name.'<i class="fas fa-angle-left right"></i></p></a><ul class="nav nav-treeview"><div id="'.$idmodul_target.'"></div></ul></li>'; 
            }else if ($opsi_sub == 0){ // tidak ada sub menu tapi modal popup
                $submenu = 0;
                $deskripsi = '<li class="nav-item"><a href="#" class="nav-link" data-toggle="modal" data-target="#'.$idmodul_target.'"><i class="nav-icon '.$icon_v.'"></i> <p>'.$group_name.'</p></a></li>'; 
            }else{ // tidak ada sub menu tapi langsung tampil menux
                $submenu = 0;
                $deskripsi = '<li class="nav-item"><a href="#" class="nav-link klik_menu" id="'.$idmodul_target.'"><i class="nav-icon '.$icon_v.'"></i> <p>'.$group_name.'</p></a></li>';
            }
            
            $maxnil    = $this->db->query("SELECT MAX(urut::integer) as x from group_name")->result();
            foreach ($maxnil as $idformx) {
                $maxnilx    = $idformx->x;  
                $maxnilplus = $maxnilx+1;
            }

            $data = array(            
                "id_group"      =>   $id_group,
                "group_name"    =>   $group_name,
                "deskripsi"     =>   $deskripsi,
                "id_model"      =>   $idmodul_target,
                "urut"          =>   $maxnilplus,
                "submenu"       =>   $submenu,
            );
            
            $this->m_main->simpan_modgroup($data);       
            $response = array(
                'count_data'  => 200,
                'pesan'       => "Berhasil Di Simpan",
            );

        }else{            
            $response = array(             
             'count_data'  => 404,
             'pesan'       => "Inputan tidak boleh kosong !!!",
            );
        }
        echo json_encode($response);
    }

    function save_form_kartukendali(){
        
        $no_kwitansi    = $this->input->post('no_kwitansi');
        //$nm_perusahanan = $this->input->post('nm_perusahanan');
        $nominal        = $this->input->post('nominal');
        $keterangan     = $this->input->post('keterangan');
        $tgl_kwitansi   = $this->input->post('tgl_kwitansi');
        $tgl_entry      = date('Y-m-d');
        $kduser         = $this->session->userdata('id_akses');
        $kd_vendor      = $this->input->post('kd_vendor');

        if (($no_kwitansi == '')||($kd_vendor == '')||($nominal == '')||($tgl_kwitansi == '')){
            $result = 'false';
        }else{
            $result = 'true';
        }
       
        if ($result == 'true') {
            
            $cek_nokwitansi = $this->m_main->cek_nokwitansi($no_kwitansi);
            $response = array(
                    'count_data'  => $cek_nokwitansi->num_rows(),
                    'pesan'       => "No Kwitansi Sudah Terdaftar !!!",
            );

            if ($response['count_data'] == 0){ // kurangdari 0 / sama dengan kosong
                $idform    = $this->db->query("SELECT MAX(id_form::integer) as jmlh_idform from ecc_kendali")->result();            
                foreach ($idform as $idformx) {
                    $id_form     = $idformx->jmlh_idform;  
                    $id_formplus = $id_form+1;

                    if ($id_form > 0){                    
                        $id_formx   = $id_form+1;
                    }else{
                        $id_formx   = '200'.$id_formplus;
                    }                
                }

                $cek_vendor = $this->m_main->cek_vendor($kd_vendor);
                $response   = array(                    
                        'ListDataObj' => $cek_vendor->result(),
                );

                $data = array(            
                    "id_form"      =>   $id_formx,
                    "no_kwitansi"  =>   $no_kwitansi,
                    "nm_rekanan"   =>   $response['ListDataObj'][0]->vendor,
                    "rpkwitansi"   =>   $nominal,
                    "ket"          =>   $keterangan,
                    "tgl_kwitansi" =>   $tgl_kwitansi,
                    "tgl_entry"    =>   $tgl_entry,
                    "id_akses"     =>   $kduser,
                    "kd_vendor"    =>   $response['ListDataObj'][0]->kd_vendor,
                );
                
                $this->m_main->simpan_form_kartukendali($data);       
                $response = array(
                    'count_data'  => 200,
                    'pesan'       => "Berhasil Di Simpan",
                    'list'        => $data,
                );
            }
            

        }else{            
            $response = array(             
             'count_data'  => 404,
             'pesan'       => "Inputan tidak boleh kosong !!!",             
            );
        }
        echo json_encode($response);
    }


    function level(){
        $data['level'] = $this->m_main->get_level()->result();
        $this->load->view("modal/plus_user.php",$data);
        // $query = $this->m_main->get_level();
        // $response = array(
        //         'count_data'  => $query->num_rows(),
        //         'result_data' => $query->result(),
        //         );
        // if ($response['count_data'] > 0 ){

        // }
        // echo json_encode($response);        
    }

    function gantiPass_lama()
    {
        $passlama   = md5($_POST['oldpassword']);
        $passbaru   = $_POST['newpassword'];
        $konfpass   = md5($_POST['newpassword']);
        
        $kduser     = $this->session->userdata('id_akses');
        $cekkauser  = $this->db->query("SELECT * from akses where id_akses ='$kduser' and password = '$passlama' ")->result();
        if (count($cekkauser) == 1){
            $update = $this->db->query("UPDATE akses set password = '$konfpass', show_pass = '$passbaru' where id_akses ='$kduser'");
        }else{
            $update = false;
        }
        
        if ($update){

            echo "{success : true}";
        }else{
            $data['error_updatepassword'] = '<div class="alert alert-danger border-bottom-dangerottom-danger">                    
            <b><i class="fa fa-exclamation-circle"></i> Oops,.. Maaf,</b>
            <br>
            Password Tidak Sesuai !!!
            </div><hr>';
            $this->load->view('ui/index', $data);
            //echo "{success : false}";
        }
        //echo json_encode($response);
    }
    function login2() {            
            $p1  =$this->input->post('username');
            if (strlen($p1)!== 0 ) {
                $p2  = MD5($this->input->post('password', TRUE));
                $checking = $this->session_apps->check_login('akses', array('username' => $p1), array('password' => $p2));
                //$this->db->where("user_names",$p1);
                //$this->db->where("password",md5($p2)); tidak bisa di compare dlm database ueey
               // $this->db->where("password",p2);
                $data['error'] = "Tes";                
                $this->load->view('ui/index',$data=array('controller'=>$this,'error'=>'s, sss'));
            }else{
                $data['error'] = "Password Anda Tidak Tepat";                
                $this->load->view('ui/index',$data=array('controller'=>$this,'error'=>'Maaf, Password Anda tidak benar'));
            }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('main');
    }	
    
}

?>