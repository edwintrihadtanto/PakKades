<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Common {

	function __construct() {
		$this->CI =& get_instance();
		// $this->CI->load->database();
		// $this->CI->load->library('session');
		//$db2=$this->CI->load->database('otherdb1', TRUE);
		$this->CI->load->library('M_pdf');
	}
	
	/*
	 * Untuk Menghasilkan Periode Tutup/Buka Di Bulan Sebelumnya, Jika Tutup Maka Hasilnya 0, Jika Buka Maka Hasilnya 1,
	 */
	 
	
	/*
	 * Untuk Menghasilkan Periode Tutup/Buka, Jika Tutup Maka Hasilnya 0, Jika Buka Maka Hasilnya 1,
	 */
	
	
	/*
	 * Untuk menghasilkan nama bulan Bulan(indonesia) Berdasarkan indexnya
	 */
	
	/*
	 * Untuk Menghasilkan Print Logo Rumah Sakit
	 */
	
	/*
	 * untuk menghasilkan empdf potrait
	 */
	public function getPDF($type,$title,$prop=array()){
		//$name = $this->CI->session->userdata['user_id']['username'];
		$name = $this->CI->session->userdata('username');
		//$this->CI->load->library('m_pdf');
		$this->CI->m_pdf->load();
		
		//$this->m_pdf->load();

		$marginLeft=15;
		if($prop != NULL){
			if(isset($prop['margin-left'])){
				$marginLeft=$prop['margin-left'];
			}
			if(isset($prop['margin-left'])){
				$marginLeft=$prop['margin-left'];
			}
			if(isset($prop['margin-left'])){
				$marginLeft=$prop['margin-left'];
			}
			if(isset($prop['margin-left'])){
				$marginLeft=$prop['margin-left'];
			}
		}
		
		
		$mpdf= new mPDF('utf-8', 'LETTER');
		$mpdf->AddPage($type, // L - landscape, P - portrait
				'', '', '', '',
				$marginLeft, // margin_left
				15, // margin right
				15, // margin top
				15, // margin bottom
				0, // margin header
				12); // margin footer
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
		$mpdf->pagenumPrefix = 'Hal : ';
		$mpdf->pagenumSuffix = '';
		$mpdf->nbpgPrefix = ' Dari ';
		$mpdf->nbpgSuffix = '';
		date_default_timezone_set("Asia/Jakarta"); 
		$date = gmdate("d-M-Y / H:i", time()+60*60*7);
		//$date = date("d-M-Y / H:i");
		$arr = array (
				'odd' => array (
						'L' => array (
								'content' => 'Operator : '.$name,
								'font-size' => 8,
								'font-style' => '',
								'font-family' => 'Times New Roman',
								'color'=>'#000000'
						),
						'C' => array (
								'content' => "Tgl/Jam : ".$date."",
								'font-size' => 8,
								'font-style' => '',
								'font-family' => 'Times New Roman',
								'color'=>'#000000'
						),
						'R' => array (
								'content' => '{PAGENO}{nbpg}',
								'font-size' => 8,
								'font-style' => '',
								'font-family' => 'Times New Roman',
								'color'=>'#000000'
						),
						'line' => 0,
				),
				'even' => array ()
		);
		if($this->foot==true){
			$mpdf->SetFooter($arr);
		}
		$mpdf->SetTitle($title);
		$mpdf->WriteHTML("
           <style>
   				table{
	   				width: 100%;
					font-family: Helvetica;
   					border-collapse: collapse;   					
   				}

			    .size16 { font-size:16px; padding-left:30px;}
			    .size16_1 { font-size:16px; line-height: 25px; }
			    .size16_2 { font-size:16px; }
			    .size16_3 { font-size:16px; line-height: 2; }
			    .page_break{
			    	page-break-before: always;
			    }
           </style>
           ");
		$mpdf->WriteHTML($this->getIconRS());
		return $mpdf;
	}

	
	public function setPdf($type,$title,$html,$prop=array()){
		$this->CI->load->library('common');
		if(isset($prop['foot'])){
			$this->foot=$prop['foot'];
		}
		
		$mpdf=$this->getPdf($type,$title,$prop);
		$mpdf->WriteHTML($html);
		//echo $html;
		$mpdf->Output($pdfFilePath, "I");
		header ( 'Content-type: application/pdf' );
		header ( 'Content-Disposition: attachment; filename="'.$title.'.pdf"' );
		readfile ( 'original.pdf' );
	}

	/*
	 * Untuk Menghasilkan Print Logo Rumah Sakit
	 */
	public function getIconRS(){		
		/*
		$rs 	= $this->CI->db->query("SELECT * FROM db_rs WHERE code = '3577015' ")->row();
		$telp 	= '';
		$fax 	= '';
		
		if(($rs->phone1 != null && $rs->phone1 != '')|| ($rs->phone2 != null && $rs->phone2 != '')){
			$telp='<br>Telp. ';
			$telp1=false;
			if($rs->phone1 != null && $rs->phone1 != ''){
				$telp1=true;
				$telp.=$rs->phone1;
			}
			if($rs->phone2 != null && $rs->phone2 != ''){
				if($telp1==true){
					$telp.='/'.$rs->phone2.'.';
				}else{
					$telp.=$rs->phone2.'.';
				}
			}else{
				$telp.='.';
			}
		}
		if($rs->fax != null && $rs->fax != ''){
			$fax='<br>Fax. '.$rs->fax.'.';
				
		}

		return "<table style='font-size: 9;font-family: Times New Roman;' cellspacing='0' border='0'>
   			<tr>
   				<td width='50'>
   					<img src='./public/css/img/RSSM.png' width='50' height='50' />
   				</td>
   				<td>
   					<b>".$rs->name."</b><br>
			   		<font style='font-size: 8px;'>".$rs->address.", ".$rs->city."</font>
			   		<font style='font-size: 8px;'>".$telp."</font>
			   		<font style='font-size: 8px;'>".$fax."</font>
   				</td>
   			</tr>
   		</table>";
   		*/
		return "
		<table cellspacing='0' border='0'>
   			<tr>
   				<td width='50'>
   					<img src='./public/css/img/logo_jatim.png' width='89' height='110' />
   				</td>   				
   			</tr>
   		</table>";
	}
}