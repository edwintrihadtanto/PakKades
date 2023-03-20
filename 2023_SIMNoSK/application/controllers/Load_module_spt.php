<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class load_module_spt extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->model('session_apps');        
        $this->load->model('Mload_module_spt');
    }
    
    /*function index() {
        $this->load->view("modal/js/function.js");
    }*/

    public function get_ajax_daftar_spt() {
        $nip_petugas_admin  = $this->session->userdata('nip');                
        $list   = $this->Mload_module_spt->get_datatables_daftar_spt($nip_petugas_admin);
        $level  = $this->session->userdata('level');
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $m_data) {
            $no++;
            $row = array();            
            $row[] = $no;
            $row[] = mediumdate_indo($m_data->tgl_dikeluarkan);
            $row[] = $m_data->nomor_spt;
            $row[] = $m_data->surat_masuk_dari;
            $row[] = mediumdate_indo($m_data->tgl_berangkat);
            $row[] = mediumdate_indo($m_data->tgl_tiba);
            $row[] = '<p style="text-align:center;">'.$m_data->lama_pelaksanaan." Hari".'</p>';
            $row[] = '<a class="btn btn-outline-primary btn-sm" href="javascript:void(0)" title="Edit Data" onclick="view_editspt('."'".$m_data->id_spt."','".$m_data->nomor_spt."'".')"><i class="fa fa-edit"></i></a>
            <a class="btn btn-outline-danger btn-sm" href="javascript:void(0)" title="Hapus Data" onclick="view_deletespt('."'".$m_data->id_spt."','".$m_data->nomor_spt."'".')""><i class="fa fa-trash"></i></a>
            <a class="btn btn-outline-success btn-sm" href="javascript:void(0)" onclick="show_tombol_cetak('."'".$m_data->id_spt."','".$m_data->nomor_spt."'".')" data-widget="control-sidebar"><i class="fa fa-print"></i></a>';            
                        
            $data[] = $row;
        }

        $response = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->Mload_module_spt->count_all_daftar_spt(),
            "recordsFiltered" => $this->Mload_module_spt->count_filtered_daftar_spt($nip_petugas_admin),
            "data"            => $data,            
        );

        echo json_encode($response);
    }

    public function tambah_spt(){
        $ulang              = 0;
        
        $nomor_spt          = $this->input->post('nomor_spt');
        $surat_masuk_dari   = $this->input->post('surat_masuk_dari');
        $tgl_surat_masuk    = $this->input->post('tgl_surat_masuk');
        $dasar              = $this->input->post('dasar_undanganspt');
        $untuk              = $this->input->post('untuk_undanganspt');
        $lama_pelaksanaan   = $this->input->post('lama_pelaksanaan');
        $tgl_berangkat      = $this->input->post('tgl_berangkatspt');
        $tgl_tiba           = $this->input->post('tgl_kembalispt');
        $dikeluarkan        = $this->input->post('dikeluarkan');
        $tgl_dikeluarkan    = $this->input->post('tgl_dikeluarkan');
        $jml_petugas        = $this->input->post('jml_petugas');
        $nip_petugas_admin  = $this->session->userdata('nip');
        $nip                = $this->input->post('ttd_pejabat_spt');
        $atas_nama          = $this->input->post('atas_nama');
        $atas_nama_bawah    = $this->input->post('atas_nama_bawah');
        //$editspt            = $this->input->post('editspt');
        $list_petugas_yg_berangkat = $this->input->post('list_petugas_yg_berangkat');

        //$list_petugas_yg_berangkat = json_decode(stripslashes($this->input->post('list_petugas_yg_berangkat')));
        
        if (($nomor_spt == '800/')||($nomor_spt == '800/ ')){
            $response = array(
                'result'      => false,
                'count_data'  => 404,
                'pesan'       => "Nomor SPT Belum Di Isi !!!",
            );
        }else if (($surat_masuk_dari == '')||($dasar == '')||($untuk == '')||($nip == '')){
            $response = array(
                'result'      => false,
                'count_data'  => 404,
                'pesan'       => "*) Wajib Di Isi !!!",
            );
        }else if ($jml_petugas == 0){
            $response = array(
                'result'      => false,
                'count_data'  => 405,
                'pesan'       => "*) Petugas yang Berangkat Belum di Isi !!!",
            );
        }else{

            if (($nip == '19680827 200604 2 008')||($nip == '19650519 200501 1 005')&& $atas_nama == ''){
                $response = array(
                    'result'      => false,
                    'count_data'  => 405,
                    'pesan'       => "*) Tanda Tangan Jabatan Belum di Pilih !!!",
                );
            }else{                
                $response = array(
                    'result'      => true,
                );
            }
        }

        if ($response['result'] == true){
            $data = array(
                'nomor_spt'         =>  $nomor_spt,
                'surat_masuk_dari'  =>  $surat_masuk_dari,
                'tgl_surat_masuk'   =>  $tgl_surat_masuk,
                'dasar'             =>  $dasar,
                'untuk'             =>  $untuk,
                'lama_pelaksanaan'  =>  $lama_pelaksanaan,
                'tgl_berangkat'     =>  $tgl_berangkat,
                'tgl_tiba'          =>  $tgl_tiba,
                'dikeluarkan'       =>  $dikeluarkan,
                'tgl_dikeluarkan'   =>  $tgl_dikeluarkan,
                'jml_petugas'       =>  $jml_petugas,
                'nip_petugas_admin' =>  $nip_petugas_admin,
                'nip'               =>  $nip,
                'atas_nama'         =>  $atas_nama,
                'atas_nama_bawah'   =>  $atas_nama_bawah,
                'editspt'           =>  ''
            );
            $where = "WHERE nomor_spt = '$nomor_spt' ";
            $cek_nomor_spt = $this->Mload_module_spt->cek_nomor_spt($where);
            if ($cek_nomor_spt->num_rows() > 0 ){ //jika ada maka ERROR
                $response = array(
                    'result'        => false,                     
                    'pesan'         => 'Nomor (SPT) :&nbsp;'.$nomor_spt.'<br>Sudah Terdaftar !!!',
                    'count_data'    => 405,
                ); 
            }else{

                $this->Mload_module_spt->simpan_nomor_spt($data);
                $response = array(
                    'result'        => true,                    
                );

                //SIMPAN NOMOR SPT BERHASIL MAKA LANJUT SIMPAN DATA PETUGAS YG BERANGKAT
                if ($response['result'] == true){ 

                    foreach($list_petugas_yg_berangkat as $list_petugas_yg_berangkat_result){            
                        $_resultx = explode("##", $list_petugas_yg_berangkat[$ulang]);
                        $nip        = $_resultx[0];
                        $nm_peg     = $_resultx[1];
                        $jabatan    = $_resultx[2];
                        $gol        = $_resultx[3];            
                        $result     = $this->Mload_module_spt->simpan_petugas_ygberangkat($nomor_spt, $nip, $nm_peg, $jabatan, $gol);
                        $ulang++;
                    }

                    $response = array(
                        'result'      => true,
                        'count_data'  => $result,
                    );

                    if ($response['count_data'] > 0 ){
                        $response = array(
                            'result'      => true,
                            'count_data'  => 202,
                            'pesan'       => "Data Berhasil Disimpan",
                        );
                    }else{
                        $response = array(
                            'result'      => false,
                            'count_data'  => 404,
                            'pesan'       => "Gagal Simpan Data !!!",
                        );
                    }

                }else{
                    $this->db->trans_rollback();
                    $response = array(
                        'result'        => false,                
                        'pesan'         => 'Data Error !!!',
                    );
                }
            }
        }

        $this->db->close();
        echo json_encode($response);
    }

    public function get_data_SPT(){
        $id_spt     = $this->input->post('id_spt');
        $nomor_spt  = $this->input->post('nomor_spt');
        
        $WHERE = "WHERE id_spt = '$id_spt' and nomor_spt = '$nomor_spt'";
        $cek_nomor_spt = $this->Mload_module_spt->cek_nomor_spt($WHERE);
        if ($cek_nomor_spt->num_rows() > 0 ){ //jika ada maka BENAR -> AMBIL DATA SPT dan PETUGAS
            $query = $this->Mload_module_spt->GET_SPTdanPETUGAS($id_spt, $nomor_spt);
            if ($query->num_rows() > 0 ){
                $response = array(
                    'result'        => true,
                    'count_data'    => 200,
                    '_data'         => $query->result(),
                    'totalrecords'  => $query->num_rows(),                    
                    'pesan'         => 'Nomor (SPT) :&nbsp;'.$nomor_spt.'&nbsp;Ditemukan.',
                );
            }else{
                $response = array(
                    'result'        => false,
                    'count_data'    => 404,                    
                    'totalrecords'  => $query->num_rows(),
                    'pesan'         => 'Nomor (SPT) :&nbsp;'.$nomor_spt.'&nbsp;Tidak Ditemukan.',
                );
            }        
        }else{
            $response = array(
                'result'        => false,
                'count_data'    => 404,                
                'pesan'         => 'Nomor (SPT) :&nbsp;'.$nomor_spt.'&nbsp;Tidak Ditemukan.',
            );
            
        }
        $this->db->close();
        echo json_encode($response);
    }

    function get_petugas(){
        $where = $this->input->post('params');
        
        $dataX  = $this->Mload_module_spt->get_petugas($where);
        //$dataX  = $this->db->query("SELECT nip, nama_pegawai, jabatan, golongan FROM tb_petugas_yg_ditugaskan WHERE $where ORDER BY golongan DESC");
        $data  = $this->db->query("SELECT CONCAT(nip,'##',nama_pegawai,'##',jabatan,'##',golongan) as gabungan FROM tb_petugas_yg_ditugaskan WHERE $where ORDER BY golongan DESC");
        // foreach ($data as $result) {
        //$value[] = (float) $result->nip;
        // }
        $response = array(
                    'result'        => true,
                    'count_data'    => 200,
                    'result_data'   => $data->result(),
                    'result_dataX'  => $dataX->result(),
                    'totalrecords'  => $data->num_rows(),
                );

        echo json_encode($response);
    }

    public function update_spt(){
        $ulang              = 0;
        
        $id_spt             = $this->input->post('id_spt');
        $nomor_spt          = $this->input->post('nomor_spt');
        $surat_masuk_dari   = $this->input->post('surat_masuk_dari');
        $tgl_surat_masuk    = $this->input->post('tgl_surat_masuk');
        $dasar              = $this->input->post('dasar_undanganspt');
        $untuk              = $this->input->post('untuk_undanganspt');
        $lama_pelaksanaan   = $this->input->post('lama_pelaksanaan');
        $tgl_berangkat      = $this->input->post('tgl_berangkatspt');
        $tgl_tiba           = $this->input->post('tgl_kembalispt');
        $dikeluarkan        = $this->input->post('dikeluarkan');
        $tgl_dikeluarkan    = $this->input->post('tgl_dikeluarkan');
        $jml_petugas        = $this->input->post('jml_petugas');
        $nip_petugas_admin  = $this->session->userdata('nip');
        $nip                = $this->input->post('ttd_pejabat_spt');
        $atas_nama          = $this->input->post('atas_nama');
        $atas_nama_bawah    = $this->input->post('atas_nama_bawah');
        $editspt            = $this->session->userdata('nip');

        $list_petugas_yg_berangkat = $this->input->post('list_petugas_yg_berangkat');
        
        if (($nomor_spt == '800/')||($nomor_spt == '800/ ')){
            $response = array(
                'result'      => false,
                'count_data'  => 404,
                'pesan'       => "Nomor SPT Belum Di Isi !!!",
            );
        }else if (($id_spt == '')||($surat_masuk_dari == '')||($dasar == '')||($untuk == '')||($nip == '')){
            $response = array(
                'result'      => false,
                'count_data'  => 404,
                'pesan'       => "*) Wajib Di Isi !!!",
            );
        }else if ($jml_petugas == 0){
            $response = array(
                'result'      => false,
                'count_data'  => 404,
                'pesan'       => "*) Petugas yang Berangkat Belum di Isi !!!",
            );
        }else{
           
            if ((($nip == '19680827 200604 2 008')||($nip == '19650519 200501 1 005'))&& $atas_nama == ''){
                $response = array(
                    'result'      => false,
                    'count_data'  => 405,
                    'pesan'       => "*) Tanda Tangan Jabatan Belum di Pilih !!!",
                );
            }else{                
                $response = array(
                    'result'      => true,
                );
            }

        }

        if ($response['result'] == true){
            $data = array(                
                'surat_masuk_dari'  =>  $surat_masuk_dari,
                'tgl_surat_masuk'   =>  $tgl_surat_masuk,
                'dasar'             =>  $dasar,
                'untuk'             =>  $untuk,
                'lama_pelaksanaan'  =>  $lama_pelaksanaan,
                'tgl_berangkat'     =>  $tgl_berangkat,
                'tgl_tiba'          =>  $tgl_tiba,
                'dikeluarkan'       =>  $dikeluarkan,
                'tgl_dikeluarkan'   =>  $tgl_dikeluarkan,
                'jml_petugas'       =>  $jml_petugas,
                'nip_petugas_admin' =>  $nip_petugas_admin,
                'nip'               =>  $nip,
                'atas_nama'         =>  $atas_nama,
                'atas_nama_bawah'   =>  $atas_nama_bawah,
                'editspt'           =>  $editspt
            );

            $params = array(            
                'id_spt'            =>  $id_spt,
                'nomor_spt'         =>  $nomor_spt
            );

            $where = "WHERE id_spt = '$id_spt' and nomor_spt = '$nomor_spt'";
            $cek_nomor_spt = $this->Mload_module_spt->cek_nomor_spt($where);
            if ($cek_nomor_spt->num_rows() > 0 ){ //jika ada maka UPDATE
                
                $result = $this->Mload_module_spt->update_nomor_spt($data, $params);
                $response = array(
                    'hasil' => $result
                );

                if (($response['hasil'] == true)||($response['hasil'] == 0)){
                    //UPDATE SPT BERHASIL MAKA LANJUT HAPUS DAN SIMPAN PETUGAS YG BERANGKAT
                    $result = $this->Mload_module_spt->delete_petugase_tok($nomor_spt); //HAPUS PETUGAS
                    $response = array(
                        'hasil' => $result
                    );
                     if (($response['hasil'] == true)||($response['hasil'] == 0)){
                        foreach($list_petugas_yg_berangkat as $list_petugas_yg_berangkat_result){            
                            $_resultx = explode("##", $list_petugas_yg_berangkat[$ulang]);
                            $nip        = $_resultx[0];
                            $nm_peg     = $_resultx[1];
                            $jabatan    = $_resultx[2];
                            $gol        = $_resultx[3];            
                            $result     = $this->Mload_module_spt->simpan_petugas_ygberangkat($nomor_spt, $nip, $nm_peg, $jabatan, $gol); //SIMPAN PETUGAS
                            $ulang++;
                        }

                        $response = array(
                            'result'      => true,
                            'count_data'  => $result,
                        );

                        if ($response['count_data'] > 0 ){
                            $response = array(
                                'result'      => true,
                                'count_data'  => 202,                                
                                'pesan'       => 'Nomor (SPT) :&nbsp;'.$nomor_spt.'<br>Berhasil di Update.',
                            );
                        }else{
                            $response = array(
                                'result'      => false,
                                'count_data'  => 404,
                                'pesan'       => 'Nomor (SPT) :&nbsp;'.$nomor_spt.'<br>Gagal Update !!!',
                            );
                        }                

                    }else{
                        $this->db->trans_rollback();
                        $response = array(
                            'result'        => false,
                            'count_data'    => 405,
                            'pesan'         => 'ERROR UPDATE DATA !!!',
                        );
                    }
                }else{
                    $this->db->trans_rollback();
                    $response = array(
                        'result'        => false,
                        'count_data'    => 405,
                        'pesan'         => 'ERROR UPDATE DATA !!!',
                    );
                }
            }else{
                $response = array(
                    'result'        => false,
                    'count_data'    => 405,
                    'pesan'         => 'Nomor (SPT) :&nbsp;'.$nomor_spt.'<br>Gagal Update !!!',
                );                
            }
        }

        $this->db->close();
        echo json_encode($response);
    }

    public function delete_spt_petugas_ygberangkat(){
        $id_spt     = $this->input->post('id_spt');
        $nomor_spt  = $this->input->post('nomor_spt');    

        $where = "WHERE id_spt = '$id_spt' and nomor_spt = '$nomor_spt' ";
        $cek_nomor_spt = $this->Mload_module_spt->cek_nomor_spt($where);
        if ($cek_nomor_spt->num_rows() > 0 ){ //jika ada maka BENAR -> HAPUS SPT DAN PETUGAS YG BERANGKAT
           
            $result = $this->Mload_module_spt->delete_spt_danpetugas_ygberangkat($id_spt, $nomor_spt);

            $response = array(
                'result'    => true,
                'pesan'     => 'Nomor SPT :'.$nomor_spt.' Berhasil Dihapus',
                'hasil'     => $result,
            );

            $this->db->trans_commit();

        }else{
            $response = array(
                'result'        => false,                
                'pesan'         => 'Nomor SPT :'.$nomor_spt.' Tidak Ditemukan !!!',
            );
            $this->db->trans_commit();
        }

        $this->db->close();
        echo json_encode($response);
    }

}

?>