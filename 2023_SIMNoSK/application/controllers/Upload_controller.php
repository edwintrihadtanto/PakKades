<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Upload_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->model('Mload_module_bidang');
        //load Helper for Form
        $this->load->helper('url', 'form'); 
        $this->load->library('form_validation');        
    }

    public function upload_file(){
        $result_code = $this->input->post('result_code');
        if (($result_code == '')||($result_code == null)){
            $result = false;            
        }else{
            $result = true;            
        }

        if ($result == true) {
            $config['upload_path']   = "./public/upload";
            $config['allowed_types'] = 'pdf|gif|jpg|png|doc|docx|xls';
            $config['encrypt_name']  = TRUE;
            $config['max_size']      = '1024';
            $config['max_width']     = '1920';
            $config['max_height']    = '1079';
            $config['max_filename']  = '20';

            $this->load->library('upload',$config);

            if (!$this->upload->do_upload('file')){
                //$data = $this->upload->data();
                $error = $this->upload->display_errors();
                //print_r($error);
                $response = array(
                    "result"    => false,
                    //"data"      => $data,
                    "pesan"     => $error,
                );
            }else{
                $data = $this->upload->data();
                $nama_file   = $data['file_name'];

                /*
                //Resize and Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image']  = './public/upload/'.$data['file_name'];
                $config['create_thumb']  = FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']       = '60%';
                $config['width']         = 600;
                $config['height']        = 400;
                $config['new_image']     = './public/upload/'.$data['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                                            
                */
            
                $where = "nomor_surat_keluar = '$result_code' ";
                $insert = array(
                    'nama_files'    => $nama_file,                    
                    'user'          => $this->session->userdata('code_user'),
                    'tgl_upload'    => date('Y-m-d H:i:s')
                );

                $result = $this->Mload_module_bidang->update_upload($insert, $where);        
                $response = array(      
                    "result"    => $result,
                );

                if ($response['result'] == true){
                    
                    $where  = "nomor_surat_keluar = '$result_code' ";
                    $insert = array(
                        'status_upload' => 1,
                        'nama_files'    => 'ok',
                    );

                    $result     = $this->Mload_module_bidang->Mupdate_tb_sratkluar($insert, $where);        
                    $response   = array(
                        "result"    => $result,
                    );


                    if ($response['result'] == true){                    
                        $response = array(      
                            "result"            => $result,              
                            "result"            => true,
                            "pesan"             => "Bukti Berhasil Di Upload",
                            "NamaFileEnkripsi"  => $result_code.'-'.$nama_file
                        );
                    }else{
                        $response = array(                
                            "result"    => false,                        
                            "pesan"     => "Gagal Upload Bukti !!!<br>Ulangi Lagi...",                    
                        );
                    }
                }
            }
        }else{
            $response = array(                
                "result"    => false,
                "pesan"     => "Nomor Surat Keluar Tidak Ditemukan !!!",
            );
        }
        $this->db->close();
        echo json_encode($response);

    }
}
?>