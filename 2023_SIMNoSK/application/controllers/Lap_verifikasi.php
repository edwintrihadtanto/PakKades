<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_verifikasi extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->model('session_apps');
        $this->load->model('MLap_verifikasi');        
        $this->load->library('common');
    }
    // function index() {
     
    //     //$this->load->view('ui/index');        
    //     $this->load->view("ui/ui/content.php");
    // }

    public function kroscek(){
        $html='';
        $no_array       = 0;        
        $idform         = json_decode(stripslashes($this->input->post('id_form')));
        //$idform         = $this->input->post('id_form');
        $idformx        = '';
        for($i=0,$iLen=count($idform); $i<$iLen;$i++){
            if($idformx != ''){
                $idformx .= ','; 
            }
            $idformx .= "'".$idform[$i]."'";
            $t = '"';
            $idform_akhir  = str_replace('$t',"'",$idformx);
        }

        if(isset($idform)){            
            $response = array(
                'result'  => 'true'                    
            );
        }else{
            $response = array(
                'result'  => 'false'                    
            );
        }   
       
        if ($response['result'] == true) {
            $result = $this->MLap_verifikasi->mprint_tndaterima($idform_akhir);
            $response = array(
                'success'     => true,
                'count_data'  => 200,
                'pesan'       => "Print Data",
                'ListDataObj' => $result->result(),
                'totalrecords'=> count($result->result()),
            );
        }else{
            $response = array(
                'count_data'  => 404,                   
                'pesan'       => "Gagal Cetak!!!",
            );
        }
        echo json_encode($response);
    } 


    public function preview(){
        $html='';
        $param=json_decode($_POST['data']);
        $Params = $param->criteria;

        $idformx        = '';
        for($i=0,$iLen=count($Params); $i<$iLen;$i++){
            if($idformx != ''){
                $idformx .= ','; 
            }
            $idformx .= "'".$Params[$i]."'";
            //$t = '"';
            
        }
        $idform_1  = str_replace('"',"'",$Params);
        $idform_2  = str_replace('['," ",$idform_1);
        $idform_akhir  = str_replace(']'," ",$idform_2);
        //$result = $this->MLap_verifikasi->mprint_tndaterima($idform_akhir);
        // $response = array(
        //     'success'     => true,
        //     'count_data'  => 200,
        //     'pesan'       => "Print Data",
        //     'ListDataObj' => $result->result(),
        //     'totalrecords'=> count($result->result()),
        // );
        $result = $this->db->query("SELECT * FROM ecc_kendali where id_form in ($idform_akhir) ORDER BY id_form DESC"); 
        $query  = $result->result();

        $html.="
            <table cellspacing='0' border='0' style='font-size:17px;'>
                <tbody>
                    <tr>
                        <th>".strtoupper("Tanda Terima Penyerahan Berkas")."</th>
                    </tr>
                </tbody>
            </table><br>
            <table cellspacing='0' border='0'>
                <tr>                    
                    <th width='150px'></th>
                    <th>
                        <div style='width:60%;'>
                        <table cellspacing='0' border='1' style='font-size:15px;' width='100px'>
                            <tr>                    
                                <th>FUNGSIONAL</th>                    
                            </tr>                
                        </table>
                        </div>
                    </th>
                    <th width='150px'></th>
                </tr>
            </table>                
            <br>
            <table cellspacing='0' border='0'>
            
            <tr>
                <th>   
                    <table cellspacing='0' border='0'>   
                        <tr>
                            <td width='20mm' align='left'></td>
                            <td width='1mm'></td>
                            <td align='left'></td>
                        </tr>             
                        <tr>
                            <td width='30mm' align='left'><b>Dari</td>
                            <td width='1mm'><b>:</td>
                            <td align='left'>Instalasi Farmasi</td>
                        </tr>
                        <tr>
                            <td width='20mm' align='left'><b>Tanggal</td>
                            <td width='1mm'><b>:</td>
                            <td align='left'>".mediumdate_indo(date('Y-m-d'))."</td>
                        </tr>
                        <tr>
                            <td width='20mm' align='left'><b>Kode Rekening</td>
                            <td width='1mm'><b>:</td>
                            <td align='left'>1.02.0400.46.001.5.2.2.28.01</td>
                        </tr>              
                    </table>
                </th>
                <th>   
                    <table cellspacing='0'border='0' style='margin-bottom:20px;'>                
                        <tr>
                            <td width='140mm' align='right'><b>Alokasi Berkas</td>
                            <td width='1mm'><b>:</td>
                            <td width='20mm' align='left'><b>Lembar 1</td>
                            <td width='1mm'><b>:</td>
                            <td width='20mm' align='left'><b>PPTK</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><b>:</td>
                            <td align='left'><b>Lembar 2</td>
                            <td><b>:</td>
                            <td align='left'><b>Verifikasi</td>
                        </tr>                         
                    </table>
                </th>                
            </tr>
          
            
            </table>
            
            <br>
            ";
        $html.='<table border = "1" style="overflow: wrap">
                <thead>
                  <tr>
                        <th width="40" align="center">No. Urut</th>
                        <th width="180px">Rekanan</th>
                        <th width="280px">Uraian Pembelian / Biaya</th>
                        <th width="150px">No. Kwitansi</th>
                        <th width="88px">Tgl. Kwitansi / Penyerahan</th>
                        <th width="120px">Nilai Kwitansi</th>
                        <th>Keterangan</th>
                  </tr>
                   <tr>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                  </tr>                   
                </thead>';
        $no = 0;
        $jmlkwitansi = 0;
        foreach ($query as $line) {            
        $no++;    
        $html.='
                <tr class="headerrow"> 
                        <td align="center" height="10mm">'.$no.'.</td>
                        <td>'.strtoupper($line->nm_rekanan).'</td>
                        <td align="left">'.$line->ket.'</td>
                        <td align="center">'.$line->no_kwitansi.'</td>
                        <td align="right">'.mediumdate_indo($line->tgl_kwitansi).'</td>
                        <td align="right">Rp. '.number_format($line->rpkwitansi).',-</td>
                        <td align="center"></td>
                </tr>';

                 $jmlkwitansi =  $jmlkwitansi + $line->rpkwitansi;
        }        
        $html .= '  <tr class="headerrow"> 
                        <th width="" align="center" colspan="3" height="10mm">Jumlah Nilai Kwitansi</th>
                        <th></th>
                        <th></th>
                        <th align="right">Rp. '.number_format($jmlkwitansi).',-</th>
                        <th></th>                        
                    </tr>';
        $html .= '</table>';
        $html .= "            
                <table cellspacing='0' border='0' style='margin-top:10px; margin-right:85px; font-size:13px;'>
                    <tr>
                        <td align='right'>Yang Menyerahkan,<br>
                        <b>Bagian Verifikasi
                        <br><br><br><br><br>
                        ____________________
                        </td>
                    </tr>                    
                </table>
                ";

        // <th colspan='7' align='center'>Data tidak ada</th>
        $common=$this->common;
        $this->common->setPdf('L','Tanda Terima Penyerahan Berkas',$html);

    } 

    public function preview_verifstep2_1(){ // E-Purchasing
        $html ='';
        $param  = json_decode($_POST['data']);
        $idform     = $param->idform;
        $nokwitansi = $param->nokwitansi;
        $valuenoin  = $param->valuenoin;
        $jns_lap    = $param->jns_lap;

        $querry_jns_lap = $this->db->query("SELECT * FROM jns_lap where id = '$jns_lap' ")->result();
        $explodeidform = explode("##",$querry_jns_lap[0]->penanggung_jwb);
        $nama = $explodeidform[1];
        $nip = $explodeidform[0];
        $result = $this->MLap_verifikasi->baca_ceklist($valuenoin, $nokwitansi);
        $response = array(
            'success'     => true,
            'count_data'  => 200,
            'pesan'       => "Print Data",
            'ListDataObj' => $result->result(),
            'totalrecords'=> count($result->result()),
        );

        $html.="
            <table cellspacing='0' border='0'>
                <tbody>
                    <tr>
                        <th align='right'>Kode Rekening : 1.02.0400.46.001.5.2.2.28.01</th>
                    </tr>
                    <tr>
                        <th>".strtoupper("Laporan Penelitian Kelengkapan dan Kebenaran Dokumen")."</th>
                    </tr>
                    <tr>
                        <th>".strtoupper("Tahun Anggaran ".date('Y'))."</th>
                    </tr>
                    <tr>
                        <th>".strtoupper("Belanja Barang & Jasa Nilai s/d Rp. 1.000.000,- ( Obat - Alkes ) E-Purchasing")."</th>
                    </tr>
                </tbody>
            </table><hr>
             
            <table cellspacing='0' border='0'>   
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>1.</td>
                    <td width='20mm' align='left'><b>SKPD</td>
                    <td width='1mm'><b>:</td>
                    <td align='left'>RSUD dr. Soedono Madiun</td>
                </tr>             
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>2.</td>
                    <td width='30mm' align='left'><b>KPA</td>
                    <td width='1mm'><b>:</td>
                    <td align='left'>dr. R. Sjaiful Anwar, Sp. JP</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>3.</td>
                    <td width='20mm' align='left'><b>BPP</td>
                    <td width='1mm'><b>:</td>
                    <td align='left'>Dra. Sulismiarti</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>4.</td>
                    <td width='20mm' align='left'><b>PPTK</td>
                    <td width='1mm'><b>:</td>
                    <td align='left'>Ratna Isventy SKM MKes</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>5.</td>
                    <td width='20mm' align='left'><b>Diterima Tanggal</td>
                    <td width='1mm'><b>:</td>
                    <td align='left'></td>
                </tr>              
            </table>        
            
            <table cellspacing='0' border='0' style='margin-top:5mm;'>   
                <tr>
                    <td><b>Kelengkapan Dokumen : FARMASI - OBAT / ALKES - 5.2.2.02.05 / 5.2.2.01.06</td>                    
                </tr>    
            </table>  
            <br>
            ";
        
        $data_cek1 = $response['ListDataObj'][0]->image_src;
        $data_cek2 = $response['ListDataObj'][1]->image_src;
        $data_cek3 = $response['ListDataObj'][2]->image_src;
        $data_cek4 = $response['ListDataObj'][3]->image_src;
        $data_cek5 = $response['ListDataObj'][4]->image_src;
        $data_cek6 = $response['ListDataObj'][5]->image_src;
        $data_cek7 = $response['ListDataObj'][6]->image_src;
        $data_cek8 = $response['ListDataObj'][7]->image_src;
        $data_cek9 = $response['ListDataObj'][8]->image_src;
        $data_cek10 = $response['ListDataObj'][9]->image_src;
        $data_cek11 = $response['ListDataObj'][10]->image_src;
        $data_cek12 = $response['ListDataObj'][11]->image_src;

        $html .= "
            <table cellspacing='0' border='0' style='margin-left:10mm;'>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>1.</td>
                    <td width='10mm'><img src='./public/css/img/$data_cek1' width='30' height='25'/></td>
                    <td align='left'>Kwitansi ( sudah ada TTD PPTK, PPK, PPHP, Pj. Persediaan Medis )</td>
                </tr>             
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>2.</td>
                    <td><img src='./public/css/img/$data_cek2' width='30' height='25'/></td>
                    <td align='left'>Nota / Faktur Penjualan / Invoice / Surat Perintah Pengiriman Barang</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>3.</td>
                    <td><img src='./public/css/img/$data_cek3' width='30' height='25'/></td>
                    <td align='left'>SP/ SPK / Perjanjian / Daftar Pesanan E-Purchasing</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>4.</td>
                    <td><img src='./public/css/img/$data_cek4' width='30' height='25'/></td>                    
                    <td align='left'>BA Pembelian Langsung</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>5.</td>
                    <td><img src='./public/css/img/$data_cek5' width='30' height='25'/></td>                    
                    <td align='left'>BA Hasil Pemeriksaan</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>6.</td>
                    <td><img src='./public/css/img/$data_cek6' width='30' height='25'/></td>                    
                    <td align='left'>BA Serah Terima Hasil Pekerjaan</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>7.</td>
                    <td><img src='./public/css/img/$data_cek7' width='30' height='25'/></td>                    
                    <td align='left'>BA Penyerahan Barang / Jasa</td>
                </tr>

                <tr>
                    <td width='5mm' align='left' height='7mm'><b>8.</td>
                    <td><img src='./public/css/img/$data_cek8' width='30' height='25'/></td>                    
                    <td align='left'>BA Hasil Pemeriksaan Administratif</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>9.</td>
                    <td><img src='./public/css/img/$data_cek9' width='30' height='25'/></td>                    
                    <td align='left'>Faktur Pajak</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>10.</td>
                    <td><img src='./public/css/img/$data_cek10' width='30' height='25'/></td>                    
                    <td align='left'>Perincian Perhitungan Pajak</td>
                </tr>    
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>11.</td>
                    <td><img src='./public/css/img/$data_cek11' width='30' height='25'/></td>                    
                    <td align='left'>Perincian Perhitungan Pajak (apabila diperlukan)</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>12.</td>
                    <td><img src='./public/css/img/$data_cek12' width='30' height='25'/></td>                    
                    <td align='left'>Surat Pernyataan Selisih Harga antara E-Purchasing dengan Nilai Kwitansi</td>
                </tr>
            </table>  

            <table cellspacing='0' border='0' style='margin-top:5mm;'>   
                <tr>
                    <td>Dinyatakan telah diteliti sesuai dengan ketentuan yang berlaku dan sudah memenuhi persyaratan pembayaran</td>                    
                </tr>    
            </table>  
        ";

         $html .= "
            <table cellspacing='0' border='0' style='margin-top:8mm;' >   
                <tr>
                    <td align='right'>Peneliti Kelengkapan & Kebenaran Dokumen</td>                    
                </tr>    
            </table>
            <table cellspacing='0' border='0' style='margin-right:19mm;' >   
                <tr>
                    <td align='right'>Fungsi Verifikasi</td>                    
                </tr>    
            </table><br><br><br><br>
            <table cellspacing='0' border='0' style='margin-right:13mm;' >   
                <tr>
                    <td align='right'><u>$nama</u></td>                    
                </tr>                
            </table>
            <table cellspacing='0' border='0' style='margin-right:11mm;' >            
                <tr>                    
                    <td align='right'>NIP.$nip</td>
                </tr>    
            </table>
            ";

        $html .= "
        <div style='width:65%;'>
            <table cellspacing='0' border='1' style='margin-top:-20mm;' width='120'>
                <tr>
                    <td width='80' height=15>Verifikasi</td>
                    <td width='200'>N0 :.........................../.............../VERIF/.............../.............../".date('Y')."</td>
                </tr>
                <tr>
                    <td height=80></td>
                    <td>Tanggal  :<br><br>Rekanan :<br><br>Nominal :

                    </td>
                </tr>    
                 <tr>
                    <td colspan='2' height=15>Paraf :</td>                                
                </tr>            
            </table>
        </div>           
            ";

        $common=$this->common;
        $this->common->setPdf('P','Belanja Barang & Jasa Nilai s/d Rp. 1.000.000,-',$html);

    }


     public function preview_verifstep2_2(){ // 1 jt s/d 5 jt
        $html='';
        $param  = json_decode($_POST['data']);
        $idform     = $param->idform;
        $nokwitansi = $param->nokwitansi;
        $valuenoin  = $param->valuenoin;
        $jns_lap    = $param->jns_lap;

        $querry_jns_lap = $this->db->query("SELECT * FROM jns_lap where id = '$jns_lap' ")->result();
        $explodeidform = explode("##",$querry_jns_lap[0]->penanggung_jwb);
        $nama = $explodeidform[1];
        $nip = $explodeidform[0];
        $result = $this->MLap_verifikasi->baca_ceklist($valuenoin, $nokwitansi);
        $response = array(
            'success'     => true,
            'count_data'  => 200,
            'pesan'       => "Print Data",
            'ListDataObj' => $result->result(),
            'totalrecords'=> count($result->result()),
        );

        $html.="
            <table cellspacing='0' border='0'>
                <tbody>
                    <tr>
                        <th align='right'>Kode Rekening : 1.02.0400.46.001.5.2.2.28.01</th>
                    </tr>
                    <tr>
                        <th>".strtoupper("Laporan Penelitian Kelengkapan dan Kebenaran Dokumen")."</th>
                    </tr>
                    <tr>
                        <th>".strtoupper("Tahun Anggaran ".date('Y'))."</th>
                    </tr>
                    <tr>
                        <th>".strtoupper("Belanja Barang & Jasa Nilai dari Rp. 1.000.000,- s/d Rp. 5.000.000,-")."</th>
                    </tr>
                    <tr>
                        <th>( Obat - Alkes )</th>
                    </tr>
                </tbody>
            </table><hr>
             
            <table cellspacing='0' border='0'>   
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>1.</td>
                    <td width='20mm' align='left'><b>SKPD</td>
                    <td width='1mm'><b>:</td>
                    <td align='left'>RSUD dr. Soedono Madiun</td>
                </tr>             
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>2.</td>
                    <td width='30mm' align='left'><b>KPA</td>
                    <td width='1mm'><b>:</td>
                    <td align='left'>dr. R. Sjaiful Anwar, Sp. JP</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>3.</td>
                    <td width='20mm' align='left'><b>BPP</td>
                    <td width='1mm'><b>:</td>
                    <td align='left'>Dra. Sulismiarti</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>4.</td>
                    <td width='20mm' align='left'><b>PPTK</td>
                    <td width='1mm'><b>:</td>
                    <td align='left'>Ratna Isventy SKM MKes</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>5.</td>
                    <td width='20mm' align='left'><b>Diterima Tanggal</td>
                    <td width='1mm'><b>:</td>
                    <td align='left'></td>
                </tr>              
            </table>        
            
            <table cellspacing='0' border='0' style='margin-top:5mm;'>   
                <tr>
                    <td><b>Kelengkapan Dokumen : FARMASI - OBAT / ALKES - 5.2.2.02.05 / 5.2.2.01.06</td>                    
                </tr>    
            </table>  
            <br>
            ";
        
        $data_cek1 = $response['ListDataObj'][0]->image_src;
        $data_cek2 = $response['ListDataObj'][1]->image_src;
        $data_cek3 = $response['ListDataObj'][2]->image_src;
        $data_cek4 = $response['ListDataObj'][3]->image_src;
        $data_cek5 = $response['ListDataObj'][4]->image_src;
        $data_cek6 = $response['ListDataObj'][5]->image_src;
        $data_cek7 = $response['ListDataObj'][6]->image_src;
        $data_cek8 = $response['ListDataObj'][7]->image_src;
        $data_cek9 = $response['ListDataObj'][8]->image_src;
        $data_cek10 = $response['ListDataObj'][9]->image_src;
        $data_cek11 = $response['ListDataObj'][10]->image_src;

        $html .= "
            <table cellspacing='0' border='0' style='margin-left:10mm;'>   
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>1.</td>
                    <td width='10mm'><img src='./public/css/img/$data_cek1' width='30' height='25'/></td>
                    <td align='left'>Kwitansi ( sudah ada TTD PPTK, PPK, PPHP )</td>
                </tr>             
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>2.</td>
                    <td><img src='./public/css/img/$data_cek2' width='30' height='25'/></td>
                    <td align='left'>Nota / Faktur Penjualan / Invoice / Surat Perintah Pengiriman Barang</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>3.</td>
                    <td><img src='./public/css/img/$data_cek3' width='30' height='25'/></td>
                    <td align='left'>SP/ SPK / Perjanjian / Daftar Pesanan E-Purchasing</td>
                </tr>                
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>4.</td>
                    <td><img src='./public/css/img/$data_cek4' width='30' height='25'/></td>                    
                    <td align='left'>BA Hasil Pemeriksaan</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>5.</td>
                    <td><img src='./public/css/img/$data_cek5' width='30' height='25'/></td>                    
                    <td align='left'>BA Serah Terima Hasil Pekerjaan</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>6.</td>
                    <td><img src='./public/css/img/$data_cek6' width='30' height='25'/></td>                    
                    <td align='left'>BA Penyerahan Barang / Jasa</td>
                </tr>

                <tr>
                    <td width='5mm' align='left' height='7mm'><b>7.</td>
                    <td><img src='./public/css/img/$data_cek7' width='30' height='25'/></td>                    
                    <td align='left'>BA Hasil Pemeriksaan Administratif</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>8.</td>
                    <td><img src='./public/css/img/$data_cek8' width='30' height='25'/></td>                    
                    <td align='left'>Faktur Pajak</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>9.</td>
                    <td><img src='./public/css/img/$data_cek9' width='30' height='25'/></td>                    
                    <td align='left'>Perincian Perhitungan Pajak</td>
                </tr>                
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>10.</td>
                    <td><img src='./public/css/img/$data_cek10' width='30' height='25'/></td>                    
                    <td align='left'>Surat Pernyataan Selisih Harga antara E-Purchasing dengan Nilai Kwitansi</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>11.</td>
                    <td><img src='./public/css/img/$data_cek11' width='30' height='25'/></td>                    
                    <td align='left'>Surat Keterangan Pembayaran DENDA</td>
                </tr>
            </table>  

            <table cellspacing='0' border='0' style='margin-top:5mm;'>   
                <tr>
                    <td>Dinyatakan telah diteliti sesuai dengan ketentuan yang berlaku dan sudah memenuhi persyaratan pembayaran.</td>                    
                </tr>    
            </table>  
        ";

         $html .= "
            <table cellspacing='0' border='0' style='margin-top:8mm;' >   
                <tr>
                    <td align='right'>Peneliti Kelengkapan & Kebenaran Dokumen</td>                    
                </tr>    
            </table>
            <table cellspacing='0' border='0' style='margin-right:19mm;' >   
                <tr>
                    <td align='right'>Fungsi Verifikasi</td>                    
                </tr>    
            </table><br><br><br><br>
            <table cellspacing='0' border='0' style='margin-right:13mm;' >   
                <tr>
                    <td align='right'><u>$nama</u></td>                    
                </tr>                
            </table>
            <table cellspacing='0' border='0' style='margin-right:11mm;' >            
                <tr>                    
                    <td align='right'>NIP.$nip</td>
                </tr>    
            </table>
            ";

        $html .= "
        <div style='width:65%;'>
            <table cellspacing='0' border='1' style='margin-top:-20mm;' width='120'>
                <tr>
                    <td width='80' height=15>Verifikasi</td>
                    <td width='200'>N0 :.........................../.............../VERIF/.............../.............../".date('Y')."</td>
                </tr>
                <tr>
                    <td height=80></td>
                    <td>Tanggal  :<br><br>Rekanan :<br><br>Nominal :

                    </td>
                </tr>    
                 <tr>
                    <td colspan='2' height=15>Paraf :</td>                                
                </tr>            
            </table>
        </div>           
            ";

        $common=$this->common;
        $this->common->setPdf('P','Belanja Barang & Jasa Nilai dari Rp. 1.000.000,- s/d Rp. 5.000.000,-',$html);

    } 
    
     public function preview_verifstep2_3(){ // lebih dari 5 jt
        $html='';
        $param  = json_decode($_POST['data']);
        $idform     = $param->idform;
        $nokwitansi = $param->nokwitansi;
        $valuenoin  = $param->valuenoin;
        $jns_lap    = $param->jns_lap;

        $querry_jns_lap = $this->db->query("SELECT * FROM jns_lap where id = '$jns_lap' ")->result();
        $explodeidform = explode("##",$querry_jns_lap[0]->penanggung_jwb);
        $nama = $explodeidform[1];
        $nip = $explodeidform[0];
        $result = $this->MLap_verifikasi->baca_ceklist($valuenoin, $nokwitansi);
        $response = array(
            'success'     => true,
            'count_data'  => 200,
            'pesan'       => "Print Data",
            'ListDataObj' => $result->result(),
            'totalrecords'=> count($result->result()),
        );

        $html.="
            <table cellspacing='0' border='0'>
                <tbody>
                    <tr>
                        <th align='right'>Kode Rekening : 1.02.0400.46.001.5.2.2.28.01</th>
                    </tr>
                    <tr>
                        <th>".strtoupper("Laporan Penelitian Kelengkapan dan Kebenaran Dokumen")."</th>
                    </tr>
                    <tr>
                        <th>".strtoupper("Tahun Anggaran ".date('Y'))."</th>
                    </tr>
                    <tr>
                        <th>".strtoupper("Belanja Barang & Jasa Nilai Lebih Dari Rp. 5.000.000,-")."</th>
                    </tr>
                    <tr>
                        <th>( Obat - Alkes )</th>
                    </tr>
                </tbody>
            </table><hr>
             
            <table cellspacing='0' border='0'>   
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>1.</td>
                    <td width='20mm' align='left'><b>SKPD</td>
                    <td width='1mm'><b>:</td>
                    <td align='left'>RSUD dr. Soedono Madiun</td>
                </tr>             
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>2.</td>
                    <td width='30mm' align='left'><b>KPA</td>
                    <td width='1mm'><b>:</td>
                    <td align='left'>dr. R. Sjaiful Anwar, Sp. JP</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>3.</td>
                    <td width='20mm' align='left'><b>BPP</td>
                    <td width='1mm'><b>:</td>
                    <td align='left'>Dra. Sulismiarti</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>4.</td>
                    <td width='20mm' align='left'><b>PPTK</td>
                    <td width='1mm'><b>:</td>
                    <td align='left'>Ratna Isventy SKM MKes</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>5.</td>
                    <td width='20mm' align='left'><b>Diterima Tanggal</td>
                    <td width='1mm'><b>:</td>
                    <td align='left'></td>
                </tr>              
            </table>        
            
            <table cellspacing='0' border='0' style='margin-top:5mm;'>   
                <tr>
                    <td><b>Kelengkapan Dokumen : FARMASI - OBAT / ALKES - 5.2.2.02.05 / 5.2.2.01.06</td>                    
                </tr>    
            </table>  
            <br>
            ";
        
        $data_cek1 = $response['ListDataObj'][0]->image_src;
        $data_cek2 = $response['ListDataObj'][1]->image_src;
        $data_cek3 = $response['ListDataObj'][2]->image_src;
        $data_cek4 = $response['ListDataObj'][3]->image_src;
        $data_cek5 = $response['ListDataObj'][4]->image_src;
        $data_cek6 = $response['ListDataObj'][5]->image_src;
        $data_cek7 = $response['ListDataObj'][6]->image_src;
        $data_cek8 = $response['ListDataObj'][7]->image_src;
        $data_cek9 = $response['ListDataObj'][8]->image_src;
        $data_cek10 = $response['ListDataObj'][9]->image_src;
        $data_cek11 = $response['ListDataObj'][10]->image_src;
        $data_cek12 = $response['ListDataObj'][11]->image_src;
        $data_cek13 = $response['ListDataObj'][12]->image_src;

        $html .= "
            <table cellspacing='0' border='0' style='margin-left:10mm;'>   
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>1.</td>
                    <td width='10mm'><img src='./public/css/img/$data_cek1' width='30' height='25'/></td>
                    <td align='left'>Kwitansi</td>
                </tr>             
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>2.</td>
                    <td><img src='./public/css/img/$data_cek2' width='30' height='25'/></td>
                    <td align='left'>Nota / Faktur Penjualan / Invoice / Surat Perintah Pengiriman Barang</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>3.</td>
                    <td><img src='./public/css/img/$data_cek3' width='30' height='25'/></td>
                    <td align='left'>SP/ SPK / Perjanjian / Daftar Pesanan E-Purchasing</td>
                </tr>                
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>4.</td>
                    <td><img src='./public/css/img/$data_cek4' width='30' height='25'/></td>                    
                    <td align='left'>BA Hasil Pemeriksaan</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>5.</td>
                    <td><img src='./public/css/img/$data_cek5' width='30' height='25'/></td>                    
                    <td align='left'>BA Serah Terima Hasil Pekerjaan</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>6.</td>
                    <td><img src='./public/css/img/$data_cek6' width='30' height='25'/></td>                    
                    <td align='left'>BA Kemajuan</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>7.</td>
                    <td><img src='./public/css/img/$data_cek7' width='30' height='25'/></td>                    
                    <td align='left'>BA Penyerahan Barang / Jasa</td>
                </tr>

                <tr>
                    <td width='5mm' align='left' height='7mm'><b>8.</td>
                    <td><img src='./public/css/img/$data_cek8' width='30' height='25'/></td>                    
                    <td align='left'>BA Hasil Pemeriksaan Administratif</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>9.</td>
                    <td><img src='./public/css/img/$data_cek9' width='30' height='25'/></td>                    
                    <td align='left'>BA Pembayaran</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>10.</td>
                    <td><img src='./public/css/img/$data_cek10' width='30' height='25'/></td>                    
                    <td align='left'>Faktur Pajak</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>11.</td>
                    <td><img src='./public/css/img/$data_cek11' width='30' height='25'/></td>                    
                    <td align='left'>Perincian Perhitungan Pajak</td>
                </tr>                
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>12.</td>
                    <td><img src='./public/css/img/$data_cek12' width='30' height='25'/></td>                    
                    <td align='left'>Surat Pernyataan Selisih Harga antara E-Purchasing dengan Nilai Kwitansi</td>
                </tr>
                <tr>
                    <td width='5mm' align='left' height='7mm'><b>13.</td>
                    <td><img src='./public/css/img/$data_cek13' width='30' height='25'/></td>                    
                    <td align='left'>Surat Keterangan Pembayaran DENDA</td>
                </tr>
            </table>  

            <table cellspacing='0' border='0' style='margin-top:5mm;'>   
                <tr>
                    <td>Dinyatakan telah diteliti sesuai dengan ketentuan yang berlaku dan sudah memenuhi persyaratan pembayaran</td>                    
                </tr>    
            </table>  
        ";

         $html .= "
            <table cellspacing='0' border='0' style='margin-top:8mm;' >   
                <tr>
                    <td align='right'>Peneliti Kelengkapan & Kebenaran Dokumen</td>                    
                </tr>    
            </table>
            <table cellspacing='0' border='0' style='margin-right:19mm;' >   
                <tr>
                    <td align='right'>Fungsi Verifikasi</td>                    
                </tr>    
            </table><br><br><br><br>
            <table cellspacing='0' border='0' style='margin-right:13mm;' >   
                <tr>
                    <td align='right'><u>KIPIK SRI RAHAYU,SE.Msi</u></td>                    
                </tr>                
            </table>
            <table cellspacing='0' border='0' style='margin-right:11mm;' >            
                <tr>                    
                    <td align='right'>NIP.19740813 200901 2 002</td>
                </tr>    
            </table>
            ";

        $html .= "
        <div style='width:65%;'>
            <table cellspacing='0' border='1' style='margin-top:-20mm;' width='120'>
                <tr>
                    <td width='80' height=15>Verifikasi</td>
                    <td width='200'>N0 :.........................../.............../VERIF/.............../.............../".date('Y')."</td>
                </tr>
                <tr>
                    <td height=80></td>
                    <td>Tanggal  :<br><br>Rekanan :<br><br>Nominal :

                    </td>
                </tr>    
                 <tr>
                    <td colspan='2' height=15>Paraf :</td>                                
                </tr>            
            </table>
        </div>           
            ";

        $common=$this->common;
        $this->common->setPdf('P','Belanja Barang & Jasa Nilai Lebih Dari Rp. 5.000.000,-',$html);
        echo json_encode($response);
    } 
}

?>