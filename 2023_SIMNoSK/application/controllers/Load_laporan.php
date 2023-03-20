<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Load_laporan extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->model('session_apps');
        $this->load->model('MLap_laporan');
        $this->load->model('Mload_module_spt');
        $this->load->library('common');
    }
    
    public function onPrint_spt(){ // E-Purchasing
        $html ='';
        $param  = json_decode($_POST['data']);
        $id_spt     = $param->id_spt;
        $nomor_spt  = $param->nomor_spt;
        
        $result = $this->MLap_laporan->get_data_sptbynomorspt($id_spt, $nomor_spt);
        $response = array(
            'success'     => true,
            'count_data'  => 200,
            'pesan'       => "Print Data",
            'ListDataObj' => $result->result(),
            'totalrecords'=> count($result->result()),
        );
        
        $cek_jml_petugas  = $response['ListDataObj'][0]->jml_petugas;
        $ttd_nip          = $response['ListDataObj'][0]->nip;
        $atas_nama        = $response['ListDataObj'][0]->atas_nama;
        

        $where = "nomor_spt = '$nomor_spt'";
        $dataX  = $this->MLap_laporan->get_petugas_laporan($where);
        $result_petugas  = $dataX->result();        
        //MEMBACA JUMLAH KARKATER
        $hasil_jmlkarakter  = strlen($response['ListDataObj'][0]->untuk);

        $result_ttd = $this->MLap_laporan->getdata_ttd($ttd_nip);
        $data_ttd = array(
            'ListDataObj' => $result_ttd->result()            
        );
        $nip_ttd      = $data_ttd['ListDataObj'][0]->nip;
        $nama_ttd     = $data_ttd['ListDataObj'][0]->nama;
        $pangkat_ttd  = $data_ttd['ListDataObj'][0]->pangkat;
        $jabatan_ttd  = $data_ttd['ListDataObj'][0]->jabatan;

        $x = 0;
        $html.="
        <table style='margin-top:-120px; margin-left:100px;' border='0' cellpadding='0' cellspacing='0'>
          <tr>            
            <td style='text-align: center; font-size: 18px;'><strong>PEMERINTAH PROVINSI JAWA TIMUR</strong></td>
          </tr>
          
          <tr>
            <td style='text-align: center; font-size: 20px;'><strong>RUMAH SAKIT UMUM DAERAH Dr.SOEDONO MADIUN</strong></td>
          </tr>

          <tr>
            <td style='text-align: center; font-size: 16px;'>Jl. Dr.Soetomo No.59 Telp (0351) 464326, 464325 Fax (0351) 458054</td>
          </tr>
          <tr>
            <td style='text-align: center; font-size: 15px;'>Website : www.rssoedono.jatimprov.go.id, Email : rsu_soedonomdn@jatimprov.go.id</td>
          </tr>
          <tr>
            <td style='text-align: center; font-size: 16px;'><u>MADIUN 63116</u></td>
          </tr>

          <tr>
            <td style='text-align: center; font-size: 16px; padding-top:30px;'>
                <strong>SURAT PERINTAH TUGAS</strong><br>Nomor : $nomor_spt
            </td>
          </tr>
        </table>
            ";

        $html.="
        <table cellpadding='0' cellspacing='1' border='0' style='margin-left:30px;margin-top:50px;'>
          <tr>
            <td style='width: 30mm;' valign='top' ><p class='size16'>Dasar</p>
            </td>
            <td style='width: 8mm;' valign='top'><p class='size16'>: </p></td>
            <td style='width: 150mm; text-align:justify;' valign='top' ><p class='size16'>".$response['ListDataObj'][0]->dasar."</p></td>
          </tr>
        </table>
        ";

        $html.="
        <table cellpadding='0' cellspacing='1' border='0' style='margin-left:30px;margin-top:20px;'>
          <tr>
            <td style='width: 30mm;' valign='top' ><p class='size16'>Kepada</p>
            </td>
            <td style='width: 8mm;' valign='top'><p class='size16'>: </p></td>
            <td style='width: 150mm; text-align:justify;' valign='top' >";

        if ($cek_jml_petugas > 1){ //LEBIH DARI 1
            
            //for($i=0, $iLen = $result_petugas['totalrecords']; $i<$iLen; $i++){
            
            foreach ($result_petugas as $line) {
            $no++;
                
                if (($cek_jml_petugas == 4) || ($cek_jml_petugas == 5)){
                    if ($x >= 4) {
                        $html.="</td></tr></table>";
                        $html.="<div class='page_break'></div>";
                        $html.="
                            <table border='0'>
                            <tr>
                            <td style='width: 40mm;'></td>
                            <td style='width: 5mm;'></td>
                            <td style='width: 150mm;'>
                        ";
                        $x = 0;
                    }
                    $x++;
                }else if ($cek_jml_petugas == 6) {
                    if ($x >= 5) {
                        $html.="</td></tr></table>";
                        $html.="<div class='page_break'></div>";
                        $html.="
                            <table border='0'>
                            <tr>
                            <td style='width: 40mm;'></td>
                            <td style='width: 5mm;'></td>
                            <td style='width: 150mm;'>
                        ";
                        $x = 0;
                    }
                    $x++;
                }else if ($cek_jml_petugas == 8) {
                    if ($x >= 7) {
                        $html.="</td></tr></table>";
                        $html.="<div class='page_break'></div>";
                        $html.="
                            <table border='0'>
                            <tr>
                            <td style='width: 40mm;'></td>
                            <td style='width: 5mm;'></td>
                            <td style='width: 150mm;'>
                        ";
                        $x = 0;
                    }
                    $x++;
                }else if ($cek_jml_petugas == 18) {
                    if ($x >= 8) {
                        $html.="</td></tr></table>";
                        $html.="<div class='page_break'></div>";
                        $html.="
                            <table border='0'>
                            <tr>
                            <td style='width: 40mm;'></td>
                            <td style='width: 5mm;'></td>
                            <td style='width: 150mm;'>
                        ";
                        $x = 0;
                    }
                    $x++;
                }else{
                    if ($x >= 6) {
                        $html.="</td></tr></table>";
                        $html.="<div class='page_break'></div>";
                        $html.="
                            <table border='0'>
                            <tr>
                            <td style='width: 40mm;'></td>
                            <td style='width: 5mm;'></td>
                            <td style='width: 150mm;'>
                        ";
                        $x = 0;
                    }
                    $x++;
                }                

                $html.="
                <table border='0' class='size16_2'>
                    ";
                $html.="                
                    <tr> 
                        <td>$no.</td>
                        <td>Nama</td>
                        <td>:</td>
                        <td style='width:100mm;'>".$line->nama_pegawai."</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>NIP/NPK</td>
                        <td>:</td>
                        <td>".$line->nip."</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Pangkat/Golongan</td>
                        <td>:</td>
                        <td>
                    ";

                    //DISINI TEMPAT GOLONGAN
                    $gol_peg = $line->golongan;
                    if ($gol_peg == "I/a") {
                        $html .= "Juru Muda / ".$line->golongan;
                    }else if ($gol_peg == "I/b") {
                        $html .= "Juru Muda Tingkat I / ".$line->golongan;
                    }else if ($gol_peg == "I/c") {
                        $html .= "Juru / ".$line->golongan;
                    }else if ($gol_peg == "I/d") {
                        $html .= "Juru Tingkat I / ".$line->golongan;
                    }else if ($gol_peg == "II/a") {
                        $html .= "Pengatur Muda / ".$line->golongan;
                    }else if ($gol_peg == "II/b") {
                        $html .= "Pengatur Muda Tingkat I / ".$line->golongan;
                    }else if ($gol_peg == "II/c") {
                        $html .= "Pengatur / ".$line->golongan;
                    }else if ($gol_peg == "II/d") {
                        $html .= "Pengatur Tingkat I / ".$line->golongan;
                    }else if ($gol_peg == "III/a") {
                        $html .= "Penata Muda / ".$line->golongan;
                    }else if ($gol_peg == "III/b") {
                        $html .= "Penata Muda Tingkat I / ".$line->golongan;
                    }else if ($gol_peg == "III/c") {
                        $html .= "Penata / ".$line->golongan;
                    }else if ($gol_peg == "III/d") {
                        $html .= "Penata Tingkat I / ".$line->golongan;
                    }else if ($gol_peg == "IV/a") {
                        $html .= "Pembina / ".$line->golongan;
                    }else if ($gol_peg == "IV/b") {
                        $html .= "Pembina Tingkat I / ".$line->golongan;
                    }else if ($gol_peg == "IV/c") {
                        $html .= "Pembina Utama Muda / ".$line->golongan;
                    }else if ($gol_peg == "IV/d") {
                        $html .= "Pembina Utama Madya / ".$line->golongan;
                    }else if ($gol_peg == "IV/e") {
                        $html .= "Pembina Utama / ".$line->golongan;
                    }else  if (($gol_peg == "S1-DOKTER") || ($gol_peg == "S2-DOKTER") || ($gol_peg == "DIII") || ($gol_peg == "S1") || ($gol_peg == "S2") || ($gol_peg == "SMA") || ($gol_peg == "SMK"))  {
                        $html .= $line->golongan;
                    }

                $html.="
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td valign='top'>Jabatan</td>
                        <td valign='top'>:</td>
                        <td>".$line->jabatan."</td>
                    </tr>
                    <tr>
                        <td colspan='4' height='20'></td>                        
                    </tr>         
                </table>
                ";
            }//BATAS END FOREACH
        }else{ //KURANG DARI 1

            foreach ($result_petugas as $line) {

                $html.="
                <table border='0' class='size16_2'>
                    ";
                $html.="                
                    <tr>                         
                        <td>Nama</td>
                        <td>:</td>
                        <td style='width:100mm;'>".$line->nama_pegawai."</td>
                    </tr>
                    <tr>                        
                        <td>NIP/NPK</td>
                        <td>:</td>
                        <td>".$line->nip."</td>
                    </tr>
                    <tr>                        
                        <td>Pangkat/Golongan</td>
                        <td>:</td>
                        <td>
                    ";

                    //DISINI TEMPAT GOLONGAN
                    $gol_peg = $line->golongan;
                    if ($gol_peg == "I/a") {
                        $html .= "Juru Muda / ".$line->golongan;
                    }else if ($gol_peg == "I/b") {
                        $html .= "Juru Muda Tingkat I / ".$line->golongan;
                    }else if ($gol_peg == "I/c") {
                        $html .= "Juru / ".$line->golongan;
                    }else if ($gol_peg == "I/d") {
                        $html .= "Juru Tingkat I / ".$line->golongan;
                    }else if ($gol_peg == "II/a") {
                        $html .= "Pengatur Muda / ".$line->golongan;
                    }else if ($gol_peg == "II/b") {
                        $html .= "Pengatur Muda Tingkat I / ".$line->golongan;
                    }else if ($gol_peg == "II/c") {
                        $html .= "Pengatur / ".$line->golongan;
                    }else if ($gol_peg == "II/d") {
                        $html .= "Pengatur Tingkat I / ".$line->golongan;
                    }else if ($gol_peg == "III/a") {
                        $html .= "Penata Muda / ".$line->golongan;
                    }else if ($gol_peg == "III/b") {
                        $html .= "Penata Muda Tingkat I / ".$line->golongan;
                    }else if ($gol_peg == "III/c") {
                        $html .= "Penata / ".$line->golongan;
                    }else if ($gol_peg == "III/d") {
                        $html .= "Penata Tingkat I / ".$line->golongan;
                    }else if ($gol_peg == "IV/a") {
                        $html .= "Pembina / ".$line->golongan;
                    }else if ($gol_peg == "IV/b") {
                        $html .= "Pembina Tingkat I / ".$line->golongan;
                    }else if ($gol_peg == "IV/c") {
                        $html .= "Pembina Utama Muda / ".$line->golongan;
                    }else if ($gol_peg == "IV/d") {
                        $html .= "Pembina Utama Madya / ".$line->golongan;
                    }else if ($gol_peg == "IV/e") {
                        $html .= "Pembina Utama / ".$line->golongan;
                    }else  if (($gol_peg == "S1-DOKTER") || ($gol_peg == "S2-DOKTER") || ($gol_peg == "DIII") || ($gol_peg == "S1") || ($gol_peg == "S2") || ($gol_peg == "SMA") || ($gol_peg == "SMK"))  {
                        $html .= $line->golongan;
                    }

                $html.="
                        </td>
                    </tr>
                    <tr>                        
                        <td>Jabatan</td>
                        <td>:</td>
                        <td>".$line->jabatan."</td>
                    </tr>                    
                </table>
                ";

            }//END FOREACH
        }//END IF CEK JUMLAH PETUGAS

        $html .=
            "</td>
          </tr>
        </table>
        "; // AKHIR UNTUK KEPADA

        $html .= "        
        <table cellpadding='0' cellspacing='1' border='0' style='margin-left:30px;margin-top:20px;' class='size16_2'>
            <tr>            
                <td style='width: 30mm;' valign='top'>Untuk</td>
                <td style='width: 8mm;' valign='top'>:</td>
                <td td style='width: 150mm; text-align:justify;' valign='top'><p>".$response['ListDataObj'][0]->untuk."</p></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td style='padding-top:5mm;'>Demikian surat perintah tugas ini untuk dilaksanakan.</td>
            </tr>";

        if ($hasil_jmlkarakter > '726'){

        }else{
            /*$html .="
            <tr>
                <td width='31%'>&nbsp;</td>
                <td width='69%'>&nbsp;</td>
                <td width='69%'>&nbsp;</td>
            </tr>
            ";*/
        }
        $html .="
        </table>";

        $html .="        
            <table border='0' style='margin-top:10mm;'>
              <tr>
                <td></td>
                <td style='width:90mm;'>
                <table border='0' class='size16_2'>
                    <tr>
                        <td width ='30mm'>Dikeluarkan di</td>
                        <td width ='1mm'>:</td>
                        <td>".$response['ListDataObj'][0]->dikeluarkan."</td>
                    </tr>
                    <tr>
                        <td>Pada Tanggal</td>
                        <td>:</td>
                        <td>".mediumdate_indo($response['ListDataObj'][0]->tgl_dikeluarkan)."</td>
                    </tr>
                    <tr >
                        <td colspan='3' align='center'>----------------------------------------------------------------</td>
                    </tr>
                    <tr >
                        <td colspan='3' align='center'>";
                        if ($nip_ttd == '19620506 198901 1 002'){                                          //Dr. Ilham DIREKTUR
                            $html .= "DIREKTUR RSUD DR SOEDONO MADIUN";

                        }else if ($nip_ttd == '19730227 199903 1 003' and $atas_nama == '4'){              //PakCahyono WADIR KEU OPSIONAL
                            $html .= "an. DIREKTUR RSUD DR SOEDONO MADIUN<br>WAKIL DIREKTUR UMUM DAN KEUANGAN";

                        }else if ($nip_ttd == '19730227 199903 1 003'){                                    //PakCahyono WADIR KEU 
                            $html .= "an. DIREKTUR RSUD DR SOEDONO MADIUN<br>WAKIL DIREKTUR UMUM DAN KEUANGAN";

                        }else if ($nip_ttd == '19620628 198903 2 003' and $atas_nama == '2'){              //Bu Suswati OPSIONAL
                            $html .= "an. DIREKTUR RSUD DR SOEDONO MADIUN<br>WAKIL DIREKTUR UMUM DAN KEUANGAN<br>u.b.<br>Plh. Kepala Bagian Tata Usaha";

                        }else if ($nip_ttd == '19620628 198903 2 003' and $atas_nama == '1'){              //Bu Suswati OPSIONAL
                            $html .= "an. DIREKTUR RSUD DR SOEDONO MADIUN<br>WAKIL DIREKTUR UMUM DAN KEUANGAN<br>u.b.<br>Kepala Bagian Keuangan dan Akuntansi";

                        }else if ($nip_ttd == '19620628 198903 2 003'){                                    //Bu Suswati
                            $html .= "an. DIREKTUR RSUD DR SOEDONO MADIUN<br>WAKIL DIREKTUR UMUM DAN KEUANGAN<br>u.b.<br>Kepala Bagian Keuangan dan Akuntansi";

                                                //NIP LAMA                              //NIP BARU
                        }else if ($nip_ttd == '19660411 199606 2 001' || $nip_ttd == '19660411 199603 2 004'){ //Dr. Dwi Siwi WADIR PELAYANAN
                            $html .= "an. DIREKTUR RSUD DR SOEDONO MADIUN<br>WAKIL DIREKTUR PELAYANAN MEDIK DAN KEPERAWATAN";

                        }else if ($nip_ttd =='19650519 200501 1 005' and $atas_nama <> '11'){    //dr saiful -- kabid pelayanan medik
                            $html .= "an. DIREKTUR RSUD DR SOEDONO MADIUN<br>WAKIL DIREKTUR PELAYANAN MEDIK DAN KEPERAWATAN<br>u.b.<br>$jabatan_ttd";

                        }else if ($nip_ttd =='19650519 200501 1 005' and $atas_nama == '11'){    //dr saiful -- kabid pelayanan medik
                            $html .= "an. DIREKTUR RSUD DR SOEDONO MADIUN<br>WAKIL DIREKTUR PELAYANAN MEDIK DAN KEPERAWATAN<br>u.b.<br>Plt. Kepala Bagian Pendidikan dan Pelatihan";

                        }else if ($nip_ttd == '19630827 198409 2 001'){                                    //Bu Niniek -- YANMED
                            $html .= "an. DIREKTUR RSUD DR SOEDONO MADIUN<br>WAKIL DIREKTUR PELAYANAN MEDIK DAN KEPERAWATAN<br>u.b.<br>$jabatan_ttd";

                        }else if ($nip_ttd == '19671231 199112 1 014'){                                    //Pak Sugeng -- PENUNJANG
                            $html .= "an. DIREKTUR RSUD DR SOEDONO MADIUN<br>WAKIL DIREKTUR PENUNJANG DAN PENDIDIKAN PENELITIAN<br>u.b.<br>$jabatan_ttd";

                        }else if ($nip_ttd =='19680827 200604 2 008' and ($atas_nama =='1' || $atas_nama =='7')){    //dr. ratih -- KABAG PPE
                            $html .= "an. DIREKTUR RSUD DR SOEDONO MADIUN<br>WAKIL DIREKTUR UMUM DAN KEUANGAN<br>u.b.<br>$jabatan_ttd";

                        }else if ($nip_ttd =='19680827 200604 2 008' and $atas_nama == '2'){               //dr. ratih -- PLT DIKLIT
                            $html .= "an. DIREKTUR RSUD DR SOEDONO MADIUN<br>WAKIL DIREKTUR PENUNJANG DAN PENDIDIKAN PENELITIAN<br>u.b.<br>Plt. Kepala Bagian Pendidikan dan Pelatihan";

                        }else if ($nip_ttd =='19680827 200604 2 008' and $atas_nama == '9'){               //dr. ratih -- PLT DIKLIT
                            $html .= "an. DIREKTUR RSUD DR SOEDONO MADIUN<br>WAKIL DIREKTUR UMUM DAN KEUANGAN<br>u.b.<br>Plt. Kepala Bagian Keuangan dan Akuntansi";

                        }else if ($nip_ttd =='19651229 198903 1 008'){                                     //Pak Hakky kabag umum 
                            $html .= "an. DIREKTUR RSUD DR SOEDONO MADIUN<br>WAKIL DIREKTUR UMUM DAN KEUANGAN<br>u.b.<br>$jabatan_ttd";

                        }else if ($nip_ttd =='19681015 199503 1 002'){                                     //Pak Kuswanto kabid penunjang
                            $html .= "an. DIREKTUR RSUD DR SOEDONO MADIUN<br>WAKIL DIREKTUR PENUNJANG DAN PENDIDIKAN PENELITIAN<br>u.b.<br>$jabatan_ttd";

                        }else{
                            $html .= "BELUM TERDAFTAR HUB. ITISI !!!";
                        }



                $html .="</td>
                    </tr>
                    <tr >
                        <td colspan='3' align='center' valign='bottom' style='height:25mm;'><u>$nama_ttd</u></td>
                    </tr>
                    <tr >
                        <td colspan='3' align='center'>$pangkat_ttd</td>
                    </tr>
                    <tr >
                        <td colspan='3' align='center'>NIP $nip_ttd</td>
                    </tr>

                </table>
                </td>
              </tr>
            </table>
        ";
        

        $common = $this->common;
        $this->common->setPdf('P','Surat Perintah Tugas', $html);
    
    }

    // public function onPrint_spt2(){
    //     $html ='';
    //     $this->load->view("report/onPrint_spt.php");
    // }


}

?>