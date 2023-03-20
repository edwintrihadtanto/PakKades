<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MLap_verifikasi extends CI_Model{
   
    function mprint_tndaterima($idform_akhir)
    {            
        $result = $this->db->query("SELECT * FROM ecc_kendali where id_form in (".$idform_akhir.")");
        return $result;  
    }

     function baca_ceklist($valuenoin, $nokwitansi)
    {            
        $result = $this->db->query("
			SELECT
				* ,
				CASE		
					WHEN data = '1' THEN
					'centang1.png' ELSE 'centang2.png'
				END AS image_src 
			FROM
				verif_step2 vs
				INNER JOIN verif_step2_det vsd ON vs.no_in = vsd.no_in 
				AND vs.no_kwitansi = vsd.no_kwitansi 
			WHERE
				vs.no_in = '$valuenoin' 
				AND vs.no_kwitansi = '$nokwitansi' ORDER BY nourut ASC
        	");
        return $result;  
    }
}