<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class load_module_rekanan extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->model('session_apps');
        $this->load->model('Mload_module_rekanan');
        $this->load->model('Mload_module');
        $this->load->model('Mload_users');
        $this->load->model('m_main');      

    }
    function index() {
     
        //$this->load->view('ui/index');        
        $this->load->view("ui/ui/content.php");
    }

    public function get_module_daftar_berkas_verifikasi_group(){
        $data['jns_lap']     = $this->Mload_module->get_jnslaporan()->result();   
        $this->load->view("modal/list_berkas_rekanan.php", $data);
    }

    public function getDataUser(){

        
    }

    public function get_table() 
    {

        $idakses = $this->session->userdata('id_akses');
        $query   = $this->db->query("SELECT kd_vendor from akses where id_akses = '$idakses'");
        $response = array(                
                'result_data' => $query->result(),
        );
        
        $kd_vendor = $response['result_data'][0]->kd_vendor;

        $tahun  = date('Y'); 
        $pil    = 3;
        $where = " ";
        $list = $this->Mload_module_rekanan->get_datatables($tahun, $where, $pil, $kd_vendor);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $m_data_listentrian) {
            $no++;
            $row = array();

            $nokwitansi = $m_data_listentrian->no_kwitansi;
            $id_form    = $m_data_listentrian->id_form;
            $nm_rekanan = $m_data_listentrian->nm_rekanan;
            $noin       = $m_data_listentrian->no_in;
            $sts_verifawal = $m_data_listentrian->sts_verifawal;
            $sts_verifkedua = $m_data_listentrian->sts_verifkedua;
            $jns_laporan = $m_data_listentrian->jns_laporan;
            if ($noin==''){
                $valuenoin = '0';
            }else{
                $valuenoin = $noin;
            }

            $row[] = $no;
            $row[] = $m_data_listentrian->no_kwitansi;
            $row[] = $m_data_listentrian->nm_rekanan;
            $row[] = "Rp. ".number_format($m_data_listentrian->rpkwitansi);
            $row[] = mediumdate_indo($m_data_listentrian->tgl_kwitansi);
            $row[] = "<a title='$m_data_listentrian->ket'>".substr($m_data_listentrian->ket, 0, 15).'...'."</a>";
            if (($noin == '')&&($sts_verifawal == 1)){
                $row[] = "<a style='color:#ffffff;width:100px;' class='btn btn-danger btn-sm' title='Belum Diproses'>Not Process</a>";
            }else if ($sts_verifkedua == 0){
                $row[] = "<a style='width:100px;' class='btn btn-warning btn-sm' width='20' title='Sedang Dalam Proses'>In Process</a>";                
            }else if (($noin <> '')&&($sts_verifkedua == 1)){
                $row[] = "<a style='color:#ffffff;width:100px;' class='btn btn-success btn-sm' width='20' title='Sudah Diproses'>Finished</a>";       
            }
            
            $row[] = '<a class="btn btn-outline-danger btn-sm" href="javascript:void(0)" title="Cek Berkas" onclick="view_dokumen('."'".$id_form."','".$nokwitansi."','".$valuenoin."','".$jns_laporan."','".$nm_rekanan."'".')"><i class="fa fa-info"></i></a>';

            $data[] = $row;
        }

        $response = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->Mload_module_rekanan->count_all_verifstp2($tahun),
            "recordsFiltered" => $this->Mload_module_rekanan->count_filtered_verifstp2($tahun, $where, $pil, $kd_vendor),
            "data"            => $data,
            "xsd"             => $pil,
        );
        //output to json format
        echo json_encode($response);
    }

    public function getlaporan_jenislaporan(){
        $idjnslap      = $this->input->post('id');
        $no_in         = $this->input->post('no_in');
        $nokwitansi    = $this->input->post('nokwitansi');

        $cek_noin_detail  = $this->Mload_module_rekanan->cek_noin_detail($no_in, $nokwitansi);
        $response = array(
                    'count'       => $cek_noin_detail->num_rows(),
                    'ListDataObj' => $cek_noin_detail->result(),                    
        );
        
        $ambiljudulLaporan = $this->db->query("SELECT * FROM jns_lap where id = '$idjnslap'")->result();
        $judul = $ambiljudulLaporan[0]->nama_laporan;

        if ($idjnslap == 1){
            if ($response['count'] > 0){
                $countcek_noin = $this->db->query("SELECT count(no_in::integer) as x from verif_step2_det where no_in = '$no_in' and no_kwitansi='$nokwitansi' and data = '1' ")->result();

                $ceklist0 = $response['ListDataObj'][0]->tipecek; //dicentang trus //no urut 1
                $cekket0  = $response['ListDataObj'][0]->tipedisable; //didisable
                $ket0     = $response['ListDataObj'][0]->keterangan;

                $ceklist1 = $response['ListDataObj'][1]->tipecek; //dicentang trus //no urut 2
                $cekket1  = $response['ListDataObj'][1]->tipedisable; //didisable
                $ket1     = $response['ListDataObj'][1]->keterangan;

                $ceklist2 = $response['ListDataObj'][2]->tipecek; //dicentang trus //no urut 3
                $cekket2  = $response['ListDataObj'][2]->tipedisable; //didisable
                $ket2     = $response['ListDataObj'][2]->keterangan;

                $ceklist3 = $response['ListDataObj'][3]->tipecek; //dicentang trus //no urut 4
                $cekket3  = $response['ListDataObj'][3]->tipedisable; //didisable
                $ket3     = $response['ListDataObj'][3]->keterangan;

                $ceklist4 = $response['ListDataObj'][4]->tipecek; //dicentang trus //no urut 5
                $cekket4  = $response['ListDataObj'][4]->tipedisable; //didisable
                $ket4     = $response['ListDataObj'][4]->keterangan;

                $ceklist5 = $response['ListDataObj'][5]->tipecek; //dicentang trus //no urut 6
                $cekket5  = $response['ListDataObj'][5]->tipedisable; //didisable
                $ket5     = $response['ListDataObj'][5]->keterangan;

                $ceklist6 = $response['ListDataObj'][6]->tipecek; //dicentang trus //no urut 7
                $cekket6  = $response['ListDataObj'][6]->tipedisable; //didisable
                $ket6     = $response['ListDataObj'][6]->keterangan;

                $ceklist7 = $response['ListDataObj'][7]->tipecek; //dicentang trus //no urut 8
                $cekket7  = $response['ListDataObj'][7]->tipedisable; //didisable
                $ket7     = $response['ListDataObj'][7]->keterangan;

                $ceklist8 = $response['ListDataObj'][8]->tipecek; //dicentang trus //no urut 9
                $cekket8  = $response['ListDataObj'][8]->tipedisable; //didisable
                $ket8     = $response['ListDataObj'][8]->keterangan;

                $ceklist9 = $response['ListDataObj'][9]->tipecek; //dicentang trus //no urut 10
                $cekket9  = $response['ListDataObj'][9]->tipedisable; //didisable
                $ket9     = $response['ListDataObj'][9]->keterangan;

                $ceklist10 = $response['ListDataObj'][10]->tipecek; //dicentang trus //no urut 11
                $cekket10  = $response['ListDataObj'][10]->tipedisable; //didisable
                $ket10     = $response['ListDataObj'][10]->keterangan;

                $ceklist11 = $response['ListDataObj'][11]->tipecek; //dicentang trus //no urut 12
                $cekket11  = $response['ListDataObj'][11]->tipedisable; //didisable
                $ket11     = $response['ListDataObj'][11]->keterangan;

                
                $response = array(
                                'count_data'  => 'success',
                                'ListDataObj' => $cek_noin_detail->result(),
                                'count_det'   => $countcek_noin,
                                'data'        => "
                        <hr>
                        <table cellspacing='0' border='0' align='center'>
                            <tr>
                            <td><u><b><h6>$judul</h6></td>
                            </tr>
                        </table>
                        <hr>
                        <table cellspacing='0' border='0' style='margin-left:10mm;'>                  
                            <tr>
                                <td width='5mm' align='left' height='15mm'><b>1.</td>
                                <td width='20mm'><input type='checkbox' ".$ceklist0." /></td>
                                <td align='left'>Kwitansi ( sudah ada TTD PPTK, PPK, PPHP, Pj. Persediaan Medis )</td>
                            </tr>
                            <tr>                            
                                <td colspan='2'>Ket :</td>
                                <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket0."'".$cekket0." style='width: 300px;'></td>
                            </tr>
                            <tr>
                                <td width='5mm' align='left' height='15mm'><b>2.</td>
                                <td width='20mm'><input type='checkbox' ".$ceklist1." /></td>
                                <td align='left'>Nota / Faktur Penjualan / Invoice / Surat Perintah Pengiriman Barang</td>
                            </tr>
                            <tr>                            
                                <td colspan='2'>Ket :</td>
                                <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket1."'".$cekket1." style='width: 300px;'></td>
                            </tr>   
                            <tr>
                                <td width='5mm' align='left' height='15mm'><b>3.</td>
                                <td><input type='checkbox' class='ceklist_lap1_3 cekbox_laporan' ".$ceklist2."/></td>
                                <td align='left'>SP/ SPK / Perjanjian / Daftar Pesanan E-Purchasing</td>
                            </tr>
                            <tr>                            
                                <td colspan='2'>Ket :</td>
                                <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket2."'".$cekket2." style='width: 300px;'></td>
                            </tr>   
                            <tr>
                                <td width='5mm' align='left' height='15mm'><b>4.</td>
                                <td width='20mm'><input type='checkbox' ".$ceklist3." /></td>
                                <td align='left'>BA Pembelian Langsung</td>
                            </tr>
                            <tr>                            
                                <td colspan='2'>Ket :</td>
                                <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket3."'".$cekket3." style='width: 300px;'></td>
                            </tr>                
                            <tr>
                                <td width='5mm' align='left' height='15mm'><b>5.</td>
                                <td width='20mm'><input type='checkbox' ".$ceklist4." /></td>
                                <td align='left'>BA Hasil Pemeriksaan</td>
                            </tr>
                            <tr>                            
                                <td colspan='2'>Ket :</td>
                                <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket4."'".$cekket4." style='width: 300px;'></td>
                            </tr>   
                            <tr>
                                <td width='5mm' align='left' height='15mm'><b>6.</td>
                                <td width='20mm'><input type='checkbox' ".$ceklist5." /></td>
                                <td align='left'>BA Serah Terima Hasil Pekerjaan</td>
                            </tr>
                            <tr>                            
                                <td colspan='2'>Ket :</td>
                                <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket5."'".$cekket5." style='width: 300px;'></td>
                            </tr>   
                            <tr>
                                <td width='5mm' align='left' height='15mm'><b>7.</td>
                                <td width='20mm'><input type='checkbox' ".$ceklist6." /></td>
                                <td align='left'>BA Penyerahan Barang / Jasa</td>
                            </tr>
                            <tr>                            
                                <td colspan='2'>Ket :</td>
                                <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket6."'".$cekket6." style='width: 300px;'></td>
                            </tr>   

                            <tr>
                                <td width='5mm' align='left' height='15mm'><b>8.</td>
                                <td width='20mm'><input type='checkbox' ".$ceklist7." /></td>
                                <td align='left'>BA Hasil Pemeriksaan Administratif</td>
                            </tr>
                            <tr>                            
                                <td colspan='2'>Ket :</td>
                                <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket7."'".$cekket7." style='width: 300px;'></td>
                            </tr>   
                            <tr>
                                <td width='5mm' align='left' height='15mm'><b>9.</td>
                                <td width='20mm'><input type='checkbox' ".$ceklist8." /></td>
                                <td align='left'>Faktur Pajak</td>
                            </tr>
                            <tr>                            
                                <td colspan='2'>Ket :</td>
                                <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket8."'".$cekket8." style='width: 300px;'></td>
                            </tr>   
                            <tr>
                                <td width='5mm' align='left' height='15mm'><b>10.</td>
                                <td width='20mm'><input type='checkbox' ".$ceklist9." /></td>
                                <td align='left'>Perincian Perhitungan Pajak</td>
                            </tr>
                            <tr>                            
                                <td colspan='2'>Ket :</td>
                                <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket9."'".$cekket9." style='width: 300px;'></td>
                            </tr>                 
                            <tr>
                                <td width='5mm' align='left' height='15mm'><b>11.</td>
                                <td width='20mm'><input type='checkbox' ".$ceklist10." /></td>
                                <td align='left'>Perincian Perhitungan Pajak (apabila diperlukan)</td>
                            </tr>
                            <tr>                            
                                <td colspan='2'>Ket :</td>
                                <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket10."'".$cekket10." style='width: 300px;'></td>
                            </tr>   
                            <tr>
                                <td width='5mm' align='left' height='7mm'><input type='number' value='12' hidden class='nourut'/><b>12.</td>
                                <td width='20mm'><input type='checkbox' ".$ceklist11." /></td>
                                <td align='left'>Surat Pernyataan Selisih Harga antara E-Purchasing dengan Nilai Kwitansi</td>
                            </tr>
                            <tr>                            
                                <td colspan='2'>Ket :</td>
                                <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket11."'".$cekket11." style='width: 300px;'></td>
                            </tr>
                        </table>
                        <table cellspacing='0' border='0' style='margin-top:5mm;'>   
                          <tr>
                            <td>Dinyatakan telah diteliti sesuai dengan ketentuan yang berlaku dan sudah memenuhi persyaratan pembayaran.</td>
                          </tr>    
                        </table>
                     "
                );

            }
            
        }else if ($idjnslap == 2){

            if ($response['count'] > 0){
                $countcek_noin = $this->db->query("SELECT count(no_in::integer) as x from verif_step2_det where no_in = '$no_in' and no_kwitansi='$nokwitansi' and data = '1' ")->result();

                $ceklist0 = $response['ListDataObj'][0]->tipecek; //dicentang trus
                $cekket0  = $response['ListDataObj'][0]->tipedisable; //didisable
                $ket0     = $response['ListDataObj'][0]->keterangan;

                $ceklist1 = $response['ListDataObj'][1]->tipecek; //dicentang trus
                $cekket1  = $response['ListDataObj'][1]->tipedisable; //didisable
                $ket1     = $response['ListDataObj'][1]->keterangan;

                $ceklist2 = $response['ListDataObj'][2]->tipecek; //dicentang trus
                $cekket2  = $response['ListDataObj'][2]->tipedisable; //didisable
                $ket2     = $response['ListDataObj'][2]->keterangan;

                $ceklist3 = $response['ListDataObj'][3]->tipecek; //dicentang trus
                $cekket3  = $response['ListDataObj'][3]->tipedisable; //didisable
                $ket3     = $response['ListDataObj'][3]->keterangan;

                $ceklist4 = $response['ListDataObj'][4]->tipecek; //dicentang trus
                $cekket4  = $response['ListDataObj'][4]->tipedisable; //didisable
                $ket4     = $response['ListDataObj'][4]->keterangan;

                $ceklist5 = $response['ListDataObj'][5]->tipecek; //dicentang trus
                $cekket5  = $response['ListDataObj'][5]->tipedisable; //didisable
                $ket5     = $response['ListDataObj'][5]->keterangan;

                $ceklist6 = $response['ListDataObj'][6]->tipecek; //dicentang trus
                $cekket6  = $response['ListDataObj'][6]->tipedisable; //didisable
                $ket6     = $response['ListDataObj'][6]->keterangan;

                $ceklist7 = $response['ListDataObj'][7]->tipecek; //dicentang trus
                $cekket7  = $response['ListDataObj'][7]->tipedisable; //didisable
                $ket7     = $response['ListDataObj'][7]->keterangan;

                $ceklist8 = $response['ListDataObj'][8]->tipecek; //dicentang trus
                $cekket8  = $response['ListDataObj'][8]->tipedisable; //didisable
                $ket8     = $response['ListDataObj'][8]->keterangan;

                $ceklist9 = $response['ListDataObj'][9]->tipecek; //dicentang trus
                $cekket9  = $response['ListDataObj'][9]->tipedisable; //didisable
                $ket9     = $response['ListDataObj'][9]->keterangan;

                $ceklist10 = $response['ListDataObj'][10]->tipecek; //dicentang trus
                $cekket10  = $response['ListDataObj'][10]->tipedisable; //didisable
                $ket10     = $response['ListDataObj'][10]->keterangan;

                $response = array(
                                'count_data'  => 'success',
                                'ListDataObj' => $cek_noin_detail->result(),
                                'count_det'   => $countcek_noin,
                                'data'        => "
                    <hr>
                    <table cellspacing='0' border='0' align='center'>
                        <tr>
                        <td><u><b><h6>$judul</h6></td>
                        </tr>
                    </table>
                    <hr>
                    <table cellspacing='0' border='0' style='margin-left:5mm; color:#000000;'>                        
                        <tr>
                            <td width='5mm' align='left' height='15mm'><b>1.</td>
                            <td width='20mm'><input type='checkbox' ".$ceklist0." /></td>
                            <td align='left'>Kwitansi ( sudah ada TTD PPTK, PPK, PPHP )</td>                            
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket0."'".$cekket0." style='width: 300px;'></td>
                        </tr>        
                        <tr>
                            <td width='5mm' align='left' height='7mm'><b>2.</td>
                            <td><input type='checkbox' class='ceklist_lap1_2 cekbox_laporan' ".$ceklist1."/></td>
                            <td align='left'>Nota / Faktur Penjualan / Invoice / Surat Perintah Pengiriman Barang</td>
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket1."'".$cekket1." style='width: 300px;'></td>
                        </tr>
                        <tr>
                            <td width='5mm' align='left' height='7mm'><input type='number' value='3' hidden class='nourut'/><b>3.</td>
                            <td><input type='checkbox' class='ceklist_lap1_3 cekbox_laporan' ".$ceklist2."/></td>
                            <td align='left'>SP/ SPK / Perjanjian / Daftar Pesanan E-Purchasing</td>
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket2."'".$cekket2." style='width: 300px;'></td>
                        </tr>               
                        <tr>
                            <td width='5mm' align='left' height='7mm'><input type='number' value='4' hidden class='nourut'/><b>4.</td>
                            <td><input type='checkbox' class='ceklist_lap1_4 cekbox_laporan' ".$ceklist3."/></td>
                            <td align='left'>BA Hasil Pemeriksaan</td>
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket3."'".$cekket3." style='width: 300px;'></td>
                        </tr>
                        <tr>
                            <td width='5mm' align='left' height='7mm'><input type='number' value='5' hidden class='nourut'/><b>5.</td>
                            <td><input type='checkbox' class='ceklist_lap1_5 cekbox_laporan' ".$ceklist4."/></td>
                            <td align='left'>BA Serah Terima Hasil Pekerjaan</td>
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket4."'".$cekket4." style='width: 300px;'></td>
                        </tr>
                        <tr>
                            <td width='5mm' align='left' height='7mm'><input type='number' value='6' hidden class='nourut'/><b>6.</td>
                            <td><input type='checkbox' class='ceklist_lap1_6 cekbox_laporan' ".$ceklist5."/></td>
                            <td align='left'>BA Penyerahan Barang / Jasa</td>
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket5."'".$cekket5." style='width: 300px;'></td>
                        </tr>

                        <tr>
                            <td width='5mm' align='left' height='7mm'><input type='number' value='7' hidden class='nourut'/><b>7.</td>
                            <td><input type='checkbox' class='ceklist_lap1_7 cekbox_laporan' ".$ceklist6."/></td>
                            <td align='left'>BA Hasil Pemeriksaan Administratif</td>
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket6."'".$cekket6." style='width: 300px;'></td>
                        </tr>
                        <tr>
                            <td width='5mm' align='left' height='7mm'><input type='number' value='8' hidden class='nourut'/><b>8.</td>
                            <td><input type='checkbox' class='ceklist_lap1_8 cekbox_laporan' ".$ceklist7."/></td>
                            <td align='left'>Faktur Pajak</td>
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket7."'".$cekket7." style='width: 300px;'></td>
                        </tr>
                        <tr>
                            <td width='5mm' align='left' height='7mm'><input type='number' value='9' hidden class='nourut'/><b>9.</td>
                            <td><input type='checkbox' class='ceklist_lap1_9 cekbox_laporan' ".$ceklist8."/></td>
                            <td align='left'>Perincian Perhitungan Pajak</td>
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket8."'".$cekket8." style='width: 300px;'></td>
                        </tr>               
                        <tr>
                            <td width='5mm' align='left' height='7mm'><input type='number' value='10' hidden class='nourut'/><b>10.</td>
                            <td><input type='checkbox' class='ceklist_lap1_10 cekbox_laporan' ".$ceklist9."/></td>
                            <td align='left'>Surat Pernyataan Selisih Harga antara E-Purchasing dengan Nilai Kwitansi</td>
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket9."'".$cekket9." style='width: 300px;'></td>
                        </tr>
                        <tr>
                            <td width='5mm' align='left' height='7mm'><input type='number' value='11' hidden class='nourut'/><b>11.</td>
                            <td><input type='checkbox' class='ceklist_lap1_11 cekbox_laporan' ".$ceklist10."/></td>
                            <td align='left'>Surat Keterangan Pembayaran DENDA</td>
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket10."'".$cekket10." style='width: 300px;'></td>
                        </tr>
                    </table>
                    <table cellspacing='0' border='0' style='margin-top:5mm;'>   
                      <tr>
                        <td align='center'>Dinyatakan telah diteliti sesuai dengan ketentuan yang berlaku dan sudah memenuhi persyaratan pembayaran.</td>
                      </tr>    
                    </table>
                     "
                );
            }

        }else if ($idjnslap == 3){

            if ($response['count'] > 0){
                $countcek_noin = $this->db->query("SELECT count(no_in::integer) as x from verif_step2_det where no_in = '$no_in' and no_kwitansi='$nokwitansi' and data = '1' ")->result();

                 $ceklist0 = $response['ListDataObj'][0]->tipecek; //dicentang trus //no urut 1
                $cekket0  = $response['ListDataObj'][0]->tipedisable; //didisable
                $ket0     = $response['ListDataObj'][0]->keterangan;

                $ceklist1 = $response['ListDataObj'][1]->tipecek; //dicentang trus //no urut 2
                $cekket1  = $response['ListDataObj'][1]->tipedisable; //didisable
                $ket1     = $response['ListDataObj'][1]->keterangan;

                $ceklist2 = $response['ListDataObj'][2]->tipecek; //dicentang trus //no urut 3
                $cekket2  = $response['ListDataObj'][2]->tipedisable; //didisable
                $ket2     = $response['ListDataObj'][2]->keterangan;

                $ceklist3 = $response['ListDataObj'][3]->tipecek; //dicentang trus //no urut 4
                $cekket3  = $response['ListDataObj'][3]->tipedisable; //didisable
                $ket3     = $response['ListDataObj'][3]->keterangan;

                $ceklist4 = $response['ListDataObj'][4]->tipecek; //dicentang trus //no urut 5
                $cekket4  = $response['ListDataObj'][4]->tipedisable; //didisable
                $ket4     = $response['ListDataObj'][4]->keterangan;

                $ceklist5 = $response['ListDataObj'][5]->tipecek; //dicentang trus //no urut 6
                $cekket5  = $response['ListDataObj'][5]->tipedisable; //didisable
                $ket5     = $response['ListDataObj'][5]->keterangan;

                $ceklist6 = $response['ListDataObj'][6]->tipecek; //dicentang trus //no urut 7
                $cekket6  = $response['ListDataObj'][6]->tipedisable; //didisable
                $ket6     = $response['ListDataObj'][6]->keterangan;

                $ceklist7 = $response['ListDataObj'][7]->tipecek; //dicentang trus //no urut 8
                $cekket7  = $response['ListDataObj'][7]->tipedisable; //didisable
                $ket7     = $response['ListDataObj'][7]->keterangan;

                $ceklist8 = $response['ListDataObj'][8]->tipecek; //dicentang trus //no urut 9
                $cekket8  = $response['ListDataObj'][8]->tipedisable; //didisable
                $ket8     = $response['ListDataObj'][8]->keterangan;

                $ceklist9 = $response['ListDataObj'][9]->tipecek; //dicentang trus //no urut 10
                $cekket9  = $response['ListDataObj'][9]->tipedisable; //didisable
                $ket9     = $response['ListDataObj'][9]->keterangan;

                $ceklist10 = $response['ListDataObj'][10]->tipecek; //dicentang trus //no urut 11
                $cekket10  = $response['ListDataObj'][10]->tipedisable; //didisable
                $ket10     = $response['ListDataObj'][10]->keterangan;

                $ceklist11 = $response['ListDataObj'][11]->tipecek; //dicentang trus //no urut 12
                $cekket11  = $response['ListDataObj'][11]->tipedisable; //didisable
                $ket11     = $response['ListDataObj'][11]->keterangan;              

                $ceklist12 = $response['ListDataObj'][12]->tipecek; //dicentang trus //no urut 13
                $cekket12  = $response['ListDataObj'][12]->tipedisable; //didisable
                $ket12     = $response['ListDataObj'][12]->keterangan;        

                $response = array(
                                'count_data'  => 'success',
                                'ListDataObj' => $cek_noin_detail->result(),
                                'count_det'   => $countcek_noin,
                                'data'        => "
                    <hr>
                    <table cellspacing='0' border='0' align='center'>
                        <tr>
                        <td><u><b><h6>$judul</h6></td>
                        </tr>
                    </table>
                    <hr>
                    <table cellspacing='0' border='0' style='margin-left:5mm; color:#000000;'>                        
                        <tr>
                            <td width='5mm' align='left' height='15mm'><b>1.</td>
                            <td width='20mm'><input type='checkbox' ".$ceklist0." /></td>
                            <td align='left'>Kwitansi</td>                            
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket0."'".$cekket0." style='width: 300px;'></td>
                        </tr>        
                        <tr>
                            <td width='5mm' align='left' height='7mm'><b>2.</td>
                            <td><input type='checkbox' class='ceklist_lap1_2 cekbox_laporan' ".$ceklist1."/></td>
                            <td align='left'>Nota / Faktur Penjualan / Invoice / Surat Perintah Pengiriman Barang</td>
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket1."'".$cekket1." style='width: 300px;'></td>
                        </tr>
                        <tr>
                            <td width='5mm' align='left' height='7mm'><input type='number' value='3' hidden class='nourut'/><b>3.</td>
                            <td><input type='checkbox' class='ceklist_lap1_3 cekbox_laporan' ".$ceklist2."/></td>
                            <td align='left'>SP/ SPK / Perjanjian / Daftar Pesanan E-Purchasing</td>
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket2."'".$cekket2." style='width: 300px;'></td>
                        </tr>               
                        <tr>
                            <td width='5mm' align='left' height='7mm'><input type='number' value='4' hidden class='nourut'/><b>4.</td>
                            <td><input type='checkbox' class='ceklist_lap1_4 cekbox_laporan' ".$ceklist3."/></td>
                            <td align='left'>BA Hasil Pemeriksaan</td>
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket3."'".$cekket3." style='width: 300px;'></td>
                        </tr>
                        <tr>
                            <td width='5mm' align='left' height='7mm'><input type='number' value='5' hidden class='nourut'/><b>5.</td>
                            <td><input type='checkbox' class='ceklist_lap1_5 cekbox_laporan' ".$ceklist4."/></td>
                            <td align='left'>BA Serah Terima Hasil Pekerjaan</td>
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket4."'".$cekket4." style='width: 300px;'></td>
                        </tr>
                        <tr>
                            <td width='5mm' align='left' height='7mm'><input type='number' value='6' hidden class='nourut'/><b>6.</td>
                            <td><input type='checkbox' class='ceklist_lap1_6 cekbox_laporan' ".$ceklist5."/></td>
                            <td align='left'>BA Kemajuan</td>
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket5."'".$cekket5." style='width: 300px;'></td>
                        </tr>

                        <tr>
                            <td width='5mm' align='left' height='7mm'><input type='number' value='7' hidden class='nourut'/><b>7.</td>
                            <td><input type='checkbox' class='ceklist_lap1_7 cekbox_laporan' ".$ceklist6."/></td>
                            <td align='left'>BA Penyerahan Barang / Jasa</td>
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket6."'".$cekket6." style='width: 300px;'></td>
                        </tr>
                        <tr>
                            <td width='5mm' align='left' height='7mm'><input type='number' value='8' hidden class='nourut'/><b>8.</td>
                            <td><input type='checkbox' class='ceklist_lap1_8 cekbox_laporan' ".$ceklist7."/></td>
                            <td align='left'>BA Hasil Pemeriksaan Administratif</td>
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket7."'".$cekket7." style='width: 300px;'></td>
                        </tr>
                        <tr>
                            <td width='5mm' align='left' height='7mm'><input type='number' value='9' hidden class='nourut'/><b>9.</td>
                            <td><input type='checkbox' class='ceklist_lap1_9 cekbox_laporan' ".$ceklist8."/></td>
                            <td align='left'>BA Pembayaran</td>
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket8."'".$cekket8." style='width: 300px;'></td>
                        </tr>               
                        <tr>
                            <td width='5mm' align='left' height='7mm'><input type='number' value='10' hidden class='nourut'/><b>10.</td>
                            <td><input type='checkbox' class='ceklist_lap1_10 cekbox_laporan' ".$ceklist9."/></td>
                            <td align='left'>Faktur Pajak</td>
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket9."'".$cekket9." style='width: 300px;'></td>
                        </tr>
                        <tr>
                            <td width='5mm' align='left' height='7mm'><input type='number' value='11' hidden class='nourut'/><b>11.</td>
                            <td><input type='checkbox' class='ceklist_lap1_11 cekbox_laporan' ".$ceklist10."/></td>
                            <td align='left'>Perincian Perhitungan Pajak</td>
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket10."'".$cekket10." style='width: 300px;'></td>
                        </tr>
                        <tr>
                            <td width='5mm' align='left' height='7mm'><input type='number' value='12' hidden class='nourut'/><b>12.</td>
                            <td><input type='checkbox' class='ceklist_lap1_12 cekbox_laporan' ".$ceklist11."/></td>
                            <td align='left'>Surat Pernyataan Selisih Harga antara E-Purchasing dengan Nilai Kwitansi</td>
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket11."'".$cekket11." style='width: 300px;'></td>
                        </tr>
                        <tr>
                            <td width='5mm' align='left' height='7mm'><input type='number' value='13' hidden class='nourut'/><b>13.</td>
                            <td><input type='checkbox' class='ceklist_lap1_13 cekbox_laporan' ".$ceklist12."/></td>
                            <td align='left'>Surat Keterangan Pembayaran DENDA</td>
                        </tr>
                        <tr>                            
                            <td colspan='2'>Ket :</td>
                            <td><input type='text' class='text_bold' placeholder='Keterangan...' value='".$ket12."'".$cekket12." style='width: 300px;'></td>
                        </tr>
                    </table>
                    <table cellspacing='0' border='0' style='margin-top:5mm;'>   
                      <tr>
                        <td align='center'>Dinyatakan telah diteliti sesuai dengan ketentuan yang berlaku dan sudah memenuhi persyaratan pembayaran.</td>
                      </tr>    
                    </table>
                     "
                );
            }

        }else{
            $response = array(
                'count_data'=> 'false',            
                'data'      => 'Belum Diproses !!!'
            );
        }    
        echo json_encode($response);
    }

    public function cek_proses_verifikasi(){
        $postidform    = $this->input->post('id_form');
        $explodeidform = explode("#",$postidform);
        $idform        = $explodeidform[0];
        $nokwitansi    = $explodeidform[2];
        $noin          = $explodeidform[4];
        $cek_noin      = $this->Mload_module->cek_noin($idform,$nokwitansi,$noin);        
        $countcek_noin = $this->db->query("SELECT count(no_in::integer) as jmlh_noin from verif_step2_det where no_in = '$noin' and no_kwitansi='$nokwitansi' and data = '1' ")->result();
        $response = array(
            'count'       => $cek_noin->num_rows(),
            'ListDataObj' => $cek_noin->result(),
            'idform'      => $idform,
            'nokwitansi'  => $nokwitansi,
            'noin'        => $noin,
            'count_det'   => $countcek_noin,
        );
        //$no_kwitansi = $response['ListDataObj'][0]->no_kwitansi;
        echo json_encode($response);
    }

}

?>