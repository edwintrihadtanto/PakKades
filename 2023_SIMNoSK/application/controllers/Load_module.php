<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class load_module extends CI_Controller {
   
    function __construct() {
        parent::__construct();        
        $this->load->model('Mload_module_bidang');        
    }
    function index() {
     
        //$this->load->view('ui/index');        
        $this->load->view("ui/ui/content.php");
    }

    public function get_data_bidang(){        
        $this->load->view("modal/data_bidang.php");
    }

    public function get_data_surat_kluar(){        
        $this->load->view("modal/data_surat_keluar.php");
    }

    public function get_ajax_data_bidang(){
        $list   = $this->Mload_module_bidang->get_datatables_data_bidang();        
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $m_data) {
            $status_upload    = $m_data->status;
            if ($status_upload == 1){
                $statusx = base_url()."public/css/img/hijau.png";
                $upload = "Aktif";
            }else{
                $statusx = base_url()."public/css/img/merah.png";
                $upload = "Tidak Aktif";
            }            
            
            $no++;
            $row = array();            
            $row[] = $no;
            //$row[] = $m_data->code_bidang;
            $row[] = 'Kode Bagian/Bidang : '.$m_data->code_bidang." / ".$m_data->name;
            //$row[] = $m_data->status;   
            $row[] = '<label class="p-1" style="border: 2px solid black; border-radius: 5px; min-width: -webkit-fill-available; text-align: center;"><img src="'.$statusx.'" height="15" width="15" title="'.$upload.'"/> '.$upload.'</label>';
            $row[] = '<a class="btn btn-outline-primary btn-sm" href="javascript:void(0)" title="Edit Data" onclick="view_editspt('."'".$m_data->code_bidang."','".$m_data->name."'".')"><i class="fa fa-edit"></i></a>
            <a class="btn btn-outline-danger btn-sm" href="javascript:void(0)" title="Hapus Data" onclick="view_del_bidang('."'".$m_data->code_bidang."','".$m_data->name."'".')""><i class="fa fa-trash"></i></a>';
            $data[] = $row;
        }

        $response = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->Mload_module_bidang->count_all_data_bidang(),
            "recordsFiltered" => $this->Mload_module_bidang->count_filtered_data_bidang(),
            "data"            => $data,            
        );

        echo json_encode($response);

    }    

    public function get_bidang(){

        $WHERE = $this->input->post('params');

        $result = $this->Mload_module_bidang->Mget_bidang($WHERE);

        if ($result->num_rows() > 0 ){
            
            $response = array(
                'result'        => true,
                'count_data'    => 200,
                '_data'         => $result->result(),
                'totalrecords'  => $result->num_rows(),                
            );
            
        }else{
            $response = array(
                'result'        => false,
                'count_data'    => 404,                
                'pesan'         => 'Data Bidang Tidak Ditemukan',
            );
            
        }
        $this->db->close();
        echo json_encode($response);

    }

    public function get_jenissurat(){

        $WHERE = $this->input->post('params');

        $result = $this->Mload_module_bidang->Mget_jenissurat($WHERE);

        if ($result->num_rows() > 0 ){
            
            $response = array(
                'result'        => true,
                'count_data'    => 200,
                '_data'         => $result->result(),
                'totalrecords'  => $result->num_rows(),                
            );
            
        }else{
            $response = array(
                'result'        => false,
                'count_data'    => 404,                
                'pesan'         => 'Data Tidak Ditemukan',
            );
            
        }
        $this->db->close();
        echo json_encode($response);

    }


    public function get_jenissurat_sub(){

        $WHERE = $this->input->post('params');

        $result = $this->Mload_module_bidang->Mget_jenissurat_sub($WHERE);

        if ($result->num_rows() > 0 ){
            
            $response = array(
                'result'        => true,
                'count_data'    => 200,
                '_data'         => $result->result(),
                'totalrecords'  => $result->num_rows(),                
            );
            
        }else{
            $response = array(
                'result'        => false,
                'count_data'    => 404,                
                'pesan'         => 'Data Tidak Ditemukan',
            );
            
        }
        $this->db->close();
        echo json_encode($response);

    }

    public function create_code(){
        $thun_saat_ini  = date('Y');
        $tgl_out        = $this->input->post('tgl_out');
        $thun_sekarang  = date('Y', strtotime($tgl_out)); //MENGAMBIL TAHUN DARI TGL SURAT KELUAR
        $code_bidang    = $this->input->post('code_bidang');
        $code_jnis      = $this->input->post('code_jnis');
        $code_jnis_sub  = $this->input->post('code_jnis_sub');
        
        $perihal        = $this->input->post('perihal');
        $tujuan         = $this->input->post('tujuan');

        $user           = $this->session->userdata('code_user');

        if (($code_bidang == '')||($code_bidang == null)){
            $response = array(
                'result'        => false,
                'count_data'    => 2,
                'pesan'         => 'Bidang belum dipilih !!!',
            );
        }else if ($code_jnis == '' || $code_jnis_sub == ''){
            $response = array(
                'result'        => false,
                'count_data'    => 2,
                'pesan'         => 'Jenis surat belum dipilih !!!',
            );
        }else if ($perihal == ''){
            $response = array(
                'result'        => false,
                'count_data'    => 2,
                'pesan'         => 'Perihal belum diisi !!!',
            );
        }else if ($tujuan == ''){
            $response = array(
                'result'        => false,
                'count_data'    => 2,
                'pesan'         => 'Tujuan belum diisi !!!',
            );
        }else{            
            $response = array(                
                'result'        => true,            
            );        
        }
    
        if ($response['result'] == true){
        //PRSOSES CEK TAHUN
            if ($thun_saat_ini == $thun_sekarang){
                $response = array(                
                    'result'        => true,            
                );
            }else if ($thun_saat_ini > $thun_sekarang){
                 $response = array(
                    'result'        => false,
                    'count_data'    => 505,
                    'pesan'         => 'Tidak Boleh Mundur Tahun<br>Hub. Bagian Umum Untuk Bisa Mengakses Tahun Sebelumnya !!!',
                );            
            }else{
                 $response = array(
                    'result'        => false,
                    'count_data'    => 505,
                    'pesan'         => 'Belum Tutup Tahun '.$thun_saat_ini.' !!!',
                );
            }
        }
        //PRSOSES CEK PERIODE_URUT
        if ($response['result'] == true){
                        
            //$thun_sekarang = date('Y');
            $where      = 'years = '.$thun_sekarang;

            $cek_period = $this->Mload_module_bidang->Mcek_period($where);        
            
            $response = array(
                'result'        => true,
                '_dataperiode'  => $cek_period->result(),
                'totalrecords'  => $cek_period->num_rows(),
            );
            
            $hasil_cek = $response['totalrecords'];
            if ($hasil_cek == 1){ // belum ada tahun
                $result = true;
                $max_nourut_peridode = $response['_dataperiode'][0]->no_urut + 1;
            }else if ($hasil_cek == 0){ // sudah ada tahun
                $result = true;
                $max_nourut_peridode = 0;
            }else{
                $result = false;
            }            

            if ($result == true){
                $where2      = "pu.years = '$thun_sekarang' and pun.tgl_out = '$tgl_out'";
                $cek_periode_dngTanggal = $this->Mload_module_bidang->Mcek_periode_dngTanggal($where2);

                $response = array(
                    'result' => true,
                    '_data'  => $cek_periode_dngTanggal->result(),
                    'count'  => $cek_periode_dngTanggal->num_rows(),
                );

                $hasil_cek_tglurut = $response['count'];
                
                //PROSES MENGECEK ADAKAH DATA DI TANGGAL TERSEBUT
                if ($hasil_cek_tglurut == 1){ //JIKA ADA

                    $result = true;
                    $no_urutpertgl = $response['_data'][0]->no_urut_pertgl + 0;
                    $berlanjut     = $response['_data'][0]->berlanjut + 1;

                }else if ($hasil_cek_tglurut == 0){ //JIKA TIDAK ADA, MAKA NILAI 0 DAN AMBIL NILAI AKHIR DRI TGL KMRN
                    $result = true;
                    
                    $where3      = 'years = '.$thun_sekarang;
                    $AMBIL_urutanterkahir_drTGL = $this->Mload_module_bidang->MAMBIL_urutanterkahir_drTGL($where3);

                    $response = array(
                        'result' => true,                        
                        '_datax' => $AMBIL_urutanterkahir_drTGL->result(),
                        'count'  => $cek_periode_dngTanggal->num_rows()
                    );

                    if ($hasil_cek == 1){

                        $xx = $response['count'];
                        if ($xx == 0){ //MELAKUKAN INSERT DI TABEL _no_urut_pertgl karena blm ada tgl
                            $no_urutpertgl = $response['_datax'][0]->urutan_akhir + 1;
                            $berlanjut     = 1;
                            $insert = array(
                                'years'             => $thun_sekarang,
                                'tgl_out'           => $tgl_out,
                                'no_urut_pertgl'    => $no_urutpertgl,
                                'no_urut_pertgl_berlanjut'  => $berlanjut
                            );

                            $insert_no_urut_pertgl = $this->Mload_module_bidang->Minsert_no_urut_pertgl($insert);

                        }else{
                            $no_urutpertgl = 0;
                            $berlanjut = 0;
                        }
                    }else{
                        $no_urutpertgl = 0;
                        $berlanjut = 0;
                    }

                }else{
                    $result = false;
                }

                if ($result == true){
                    if (($berlanjut == 1)||($berlanjut == 0)){ 
                        return $this->create_code_bidangpertgl($tgl_out, $code_bidang, $code_jnis, $code_jnis_sub, $hasil_cek, $max_nourut_peridode, $thun_sekarang, $perihal, $tujuan, $hasil_cek_tglurut, $no_urutpertgl, $berlanjut);
                    }else if ($berlanjut > 1){
                        $where =  "years = '$thun_sekarang' and tgl_out = '$tgl_out' and no_urut_pertgl = '$no_urutpertgl'";
                        $data = array(
                            'no_urut_pertgl_berlanjut'  => $berlanjut
                        );

                        $insert_no_urut_pertgl = $this->Mload_module_bidang->Mupdate_no_urut_pertgl_berlanjut($data, $where);

                        $response = array(
                            'result' => $insert_no_urut_pertgl,
                        );

                        if ($response['result'] == true){

                            return $this->create_code_bidangpertgl($tgl_out, $code_bidang, $code_jnis, $code_jnis_sub, $hasil_cek, $max_nourut_peridode, $thun_sekarang, $perihal, $tujuan, $hasil_cek_tglurut, $no_urutpertgl, $berlanjut);
                        }else{
                            $response = array(                
                                'result'    => false,
                                'pesan'     => "Terjadi Kesalahan, Hub. Admin !!!",                        
                            );  
                        }
                    }else{
                        $response = array(                
                            'result'    => false,
                            'pesan'     => "Terjadi Kesalahan, Hub. Admin!!!",
                        );
                    }
                    
                }else{
                    $response = array(                
                        'result'    => false,
                        'pesan'     => "Terjadi Kesalahan, Hub. Admin !!!",
                        'XXTAHUN'   =>  $hasil_cek,
                        'XXTAHUN2'  =>  $max_nourut_peridode,
                        'XXTGL'     =>  $hasil_cek_tglurut,
                        'XXTGL2'    =>  $no_urutpertgl,
                    );
                }                
                
            }else{
                $response = array(
                    'result' => false,
                    'pesan'  => "Terjadi Kesalahan, Hub. Admin !!!"
                );
            
            }
            
        }
        
        $this->db->close();
        echo json_encode($response);

    }

    public function create_code_bidangpertgl($tgl_out, $code_bidang, $code_jnis, $code_jnis_sub, $hasil_cek, $max_nourut_peridode, $thun_sekarang, $perihal, $tujuan, $hasil_cek_tglurut, $no_urutpertgl, $berlanjut){
        //STEP 1
        //JIKA TAHUN TERSEDIA MAKA CEK TANGGAL TERSEDIA / TIDAK
        if ($hasil_cek == 1){ //JIKA TAHUN SUDAH ADA     

                $cek_codeurutbidang = $this->Mload_module_bidang->Mcek_codeurutbidang($tgl_out, $code_bidang);
                $response = array(
                    '_data'  => $cek_codeurutbidang->result(),
                    'count'  => $cek_codeurutbidang->num_rows(),
                );
                
                if ($response['count'] == 1){
                    $jmlh_urut = $response['_data'][0]->jmlh_urut + 1;
                }else{
                    $jmlh_urut = 0;
                }

                //PROSES MENGECEK DI TABEL TB_CODE_URUT_BIDANG
                if ($response['count'] == 1){  // JIKA ADA  MAKA TINGGAL UPDATE TB_CODE_URUT_BIDANG DAN TB_PERIODE

                    //return $this->nextproses1($tgl_out, $code_bidang, $code_jnis, $code_jnis_sub, $hasil_cek, $max_nourut_peridode, $thun_sekarang, $perihal, $tujuan, $hasil_cek_tglurut, $no_urutpertgl, $berlanjut, $jmlh_urut);
                    //$jmlh_urut = $response['_data'][0]->jmlh_urut + 1;
                
                    //UPDATE TB_CODE_URUTBIDANG_PERTGL
                    $data = array(
                        'jmlh_urut' => $jmlh_urut,
                    );

                    $where = "tgl_out = '$tgl_out' and code_bidang = '$code_bidang' and nourut_tgl_out = '$no_urutpertgl' ";
                    $update_codeurutbidang = $this->Mload_module_bidang->Mupdate_codeurutbidang($data, $where);

                    $response = array(
                        'result' => $update_codeurutbidang,
                    );

                    if ($response['result'] == true){

                        $data = array(
                            'no_urut' => $max_nourut_peridode,
                        );
                        
                        
                        $update_period = $this->Mload_module_bidang->Mupdate_period($data, $thun_sekarang);

                        $response = array(
                            'result' => $update_period,
                        );

                        if ($response['result'] == true){
                            //$code_suratkeluar   = $no_urutpertgl.'.'.$code_bidang.'.'.$berlanjut; // BENTUK LAMA
                            $code_suratkeluar   = $berlanjut.'.'.$code_bidang.'.'.$no_urutpertgl;
                            if ($code_jnis_sub == '-'){
                                $nomor_suratkeluar  = $code_jnis.'/'.$code_suratkeluar.'/102.9/'.$thun_sekarang;
                                
                            }else{
                                $nomor_suratkeluar = $code_jnis.'.'.$code_jnis_sub.'/'.$code_suratkeluar.'/102.9/'.$thun_sekarang;
                            }

                            $response = array(
                                'result' => true,
                                'pesan'  => 'Create Code Succesfuly',
                                'codenya'=> $nomor_suratkeluar,
                                'part'   => 1
                            );
                        }else{
                            $response = array(
                                'result' => false,
                                'pesan'  => 'Create Code Failed',
                                'part'   => 1
                            );  
                        }

                       
                    }else{
                        $response = array(
                            'result' => false,
                            'pesan'  => 'Create Code Failed',
                            'part'   => 1
                        );  
                    }
                

                    

                }else if ($response['count'] == 0){ // JIKA BELUM ADA  MAKA TINGGAL INSERT TB_CODE_URUT_BIDANG DAN UPDATE TB_PERIODE
               
                    $data_insert = array(
                        'tgl_out'           => $tgl_out,
                        'nourut_tgl_out'    => $no_urutpertgl,
                        'code_bidang'       => $code_bidang,
                        'jmlh_urut'         => 1
                    );

                    /*$where = array(
                        'tgl_outf'           => $tgl_out,
                        'nourut_tgl_out'    => $no_urutpertgl,
                        'code_bidang'       => $code_bidang                        
                    );*/
                    $where = "";
                    $insert_codeurutbidang = $this->Mload_module_bidang->Minsert_codeurutbidang($data_insert, $where);

                    $response = array(
                        'result' => $insert_codeurutbidang,
                    );

                    if ($response['result'] == true){

                        $data = array(
                            'no_urut'       => $max_nourut_peridode                    
                        );

                        $update_period = $this->Mload_module_bidang->Mupdate_period($data, $thun_sekarang);
                        
                        $response = array(
                            'result' => $update_period,
                        );                        

                        if ($response['result'] == true){
                            //$code_suratkeluar   = $no_urutpertgl.'.'.$code_bidang.'.'.$berlanjut; // BENTUK LAMA
                            $code_suratkeluar   = $berlanjut.'.'.$code_bidang.'.'.$no_urutpertgl;
                            if ($code_jnis_sub == '-'){
                                $nomor_suratkeluar  = $code_jnis.'/'.$code_suratkeluar.'/102.9/'.$thun_sekarang;
                            }else{
                                $nomor_suratkeluar = $code_jnis.'.'.$code_jnis_sub.'/'.$code_suratkeluar.'/102.9/'.$thun_sekarang;
                            }

                            $response = array(
                                'result' => true,
                                'pesan'  => 'Create Code Succesfuly',
                                'codenya'=> $nomor_suratkeluar,
                                'part'   => 2
                            );


                        }else{
                            $response = array(
                                'result' => false,
                                'pesan'  => "Hub. Admin !!!",
                                'part'   => 2
                            );
                        }

                    }else{
                        $response = array(
                            'result' => false,
                            'pesan'  => 'Create Code Failed',
                            'part'   => 2
                        );  
                    }

                    

                }else{
                //JIKA LEBIH DARI 1 ERROR / PENYEBAB LAIN !!!
                    $response = array(
                        'result' => false,
                        'pesan'  => "Gagal Cek Kode Urut Tanggal !!!",
                        'part'   => 2
                    );
                }

            

        //STEP 2
        }else{
            //JIKA TAHUN BELUM ADA MAKA OTOMATIS BUAT TAHUN BARU DAN TANGGAL BARU

            return $this->create_NEWYEARS_besertakawax($tgl_out, $code_bidang, $code_jnis, $code_jnis_sub, $hasil_cek, $max_nourut_peridode, $thun_sekarang, $perihal, $tujuan, $hasil_cek_tglurut, $no_urutpertgl);

        }

        if ($response['result'] == true){
            return $this->insert_tbsuratkeluar($tgl_out, $nomor_suratkeluar, $code_bidang, $code_jnis, $code_jnis_sub, $perihal, $tujuan, $code_suratkeluar);            
        }

        
        $this->db->close();
        echo json_encode($response);
    }

    public function create_NEWYEARS_besertakawax($tgl_out, $code_bidang, $code_jnis, $code_jnis_sub, $hasil_cek, $max_nourut_peridode, $thun_sekarang, $perihal, $tujuan, $hasil_cek_tglurut, $no_urutpertgl){

        $data = array(
            'years'           => $thun_sekarang,
            'no_urut'         => 1,
        );

        $insert_periodbaru = $this->Mload_module_bidang->Minsert_period($data);
        $response = array(
            'result' => $insert_periodbaru,
        );

        if ($response['result'] == true){
            $insert = array(
                'years'                     => $thun_sekarang,
                'tgl_out'                   => $tgl_out,
                'no_urut_pertgl'            => 1,
                'no_urut_pertgl_berlanjut'  => 1
            );
            $insert_no_urut_pertgl = $this->Mload_module_bidang->Minsert_no_urut_pertgl($insert);
            $response = array(
                'result' => $insert_no_urut_pertgl,
            );

        }else{
            $response = array(
                'result' => false,
                'pesan'  => "Hub. Admin !!!",
                'part'   => 3
            );
        }

        //PROSES INSERT KE TABEL CODE_URUT_BIDANG
            if ($response['result'] == true){
                $data_insert = array(
                    'tgl_out'           => $tgl_out,
                    'nourut_tgl_out'    => 1,
                    'code_bidang'       => $code_bidang,
                    'jmlh_urut'         => 1
                );

                $where = array(
                    'tgl_out'           => $tgl_out,
                    'nourut_tgl_out'    => 1,
                    'code_bidang'       => $code_bidang
                );

                $insert_codeurutbidang = $this->Mload_module_bidang->Minsert_codeurutbidang($data_insert, $where);

                $response = array(
                    'result' => $insert_codeurutbidang,                        
                );

                if ($response['result'] == true){
                    $code_suratkeluar   = '1.'.$code_bidang.'.1';
                    if ($code_jnis_sub == '-'){
                        $nomor_suratkeluar  = $code_jnis.'/'.$code_suratkeluar.'/102.9/'.$thun_sekarang;                        
                    }else{
                        $nomor_suratkeluar = $code_jnis.'.'.$code_jnis_sub.'/'.$code_suratkeluar.'/102.9/'.$thun_sekarang;
                    }

                    $response = array(
                        'result' => true,
                        'pesan'  => 'Create Code Succesfuly',
                        'codenya'=> $nomor_suratkeluar,
                        'part'   => 3
                    );

                }else{
                    $response = array(
                        'result' => false,
                        'pesan'  => "Gagal Cek Kode Urut Tanggal !!!",
                        'part'   => 3
                    );
                }

            }else{
                $response = array(
                    'result' => false,
                    'pesan'  => 'Hub. Admin !!!',
                    'part'   => 3
                );
            }

        if ($response['result'] == true){
            return $this->insert_tbsuratkeluar($tgl_out, $nomor_suratkeluar, $code_bidang, $code_jnis, $code_jnis_sub, $perihal, $tujuan, $code_suratkeluar);            
        }

        $this->db->close();
        echo json_encode($response);
        
    }
/*
    Tgl 15/10/2021 
    By Edwin
    Note    : Harus dirubah lagi urutanx proses simpan datanya, 
    Contoh  : sudah berhasil insert/update ke periode, _no_urutpertgl, dan _no_urutbidang tp gagal insert ke tb_suratkluar maka 
              tidak akan ada kecocokan jumlah antara tb_surat kluar dan tabel lainx
    solusi  : 1. dirubah urutannya atau
              2. dibuatkan menu baru sinkronisasi data, gunanya untuk mencocokan jumlah di tabel periode, _no_urutpertgl, dan _no_urutbidang dengan tb_suratkeluar atau
              3. buat function update untuk mengurangi jumlah count
    saat ini : Sementara masih apa adanya
*/

    public function insert_tbsuratkeluar($tgl_out, $nomor_suratkeluar, $code_bidang, $code_jnis, $code_jnis_sub, $perihal, $tujuan, $code_suratkeluar){
        
        $cek = $this->Mload_module_bidang->Mcek_tb_sratkluar();

        $response = array(            
            'totalrecords'  => $cek->num_rows(),
            'data'          => $cek->result(),
        );

        $nomor_urutx = $response['data'][0]->nomor_urut;

        if (($response['totalrecords'] == 1) && ($nomor_urutx == null)){
            $nomor_urut = '1001';
        }else{
            $nomor_urut = $nomor_urutx + 1;
        }

        $data_1 = array(
            'nomor_urut'            => $nomor_urut,
            'tgl_surat_keluar'      => $tgl_out,
            'code_suratkeluar'      => $code_suratkeluar,
            'nomor_surat_keluar'    => $nomor_suratkeluar,
            'code_bidang'           => $code_bidang,
            'code_jenis_surat'      => $code_jnis,
            'code_jenis_suratsub'   => $code_jnis_sub,
            'perihal'               => $perihal,
            'tujuan_unit'           => $tujuan,
            'status_upload'         => 0,
            'tgl_dibuat'            => date('Y-m-d'),
            'code_user'             => $this->session->userdata('code_user'),
        );

        $data_2 = array(            
            'nomor_surat_keluar'    => $nomor_suratkeluar,            
        );

        $insert_ = $this->Mload_module_bidang->Minsert_tb_sratkluar($data_1, $data_2);

        $response = array(
            'result' => $insert_,
        );

        if ($response['result'] == true){
            $response = array(
                'result' => true,
                'xresult'=> $data_1,
                'pesan'  => 'Create Code Succesfuly',
                'codenya'=> $nomor_suratkeluar,
                'part'   => 'final'                
            );
        }else{
            $response = array(
                'result' => false,
                'pesan'  => 'Hub. Admin !!!',                
                'part'   => 'final'
            );
        }

        $this->db->close();
        echo json_encode($response);
    }

    public function delete_bidang(){
        $code  = $this->input->post('code');        
        $where = "code_bidang = '$code'";
        $query = $this->Mload_module_bidang->Mdelete_bidang($where);        

        if ($query == true || $query > 0) {
            $response['status']     = true;            
            $response['message']    = "Berhasil di Hapus";
        }else{
            $response['status']     = false;
            $response['message']    = "Gagal di Hapus!!";
        }
        echo json_encode($response);
    }

    public function add_bidang(){
        $code  = $this->input->post('code');        
        $where = "code_bidang = '$code'";
        $query = $this->Mload_module_bidang->Madd_bidang($where);        

        if ($query == true || $query > 0) {
            $response['status']     = true;            
            $response['message']    = "Berhasil di Hapus";
        }else{
            $response['status']     = false;
            $response['message']    = "Gagal di Hapus!!";
        }
        echo json_encode($response);
    }

    public function edit_bidang(){
        $code  = $this->input->post('code');        
        $where = "code_bidang = '$code'";
        $query = $this->Mload_module_bidang->Medit_bidang($where, $data); 

        if ($query == true || $query > 0) {
            $response['status']     = true;            
            $response['message']    = "Berhasil di Hapus";
        }else{
            $response['status']     = false;
            $response['message']    = "Gagal di Hapus!!";
        }
        echo json_encode($response);
    }
}

?>