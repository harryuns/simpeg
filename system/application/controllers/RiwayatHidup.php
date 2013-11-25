<?php

class RiwayatHidup extends Controller {
    function RiwayatHidup() {
        parent::Controller();
    }
    
    function index($K_PEGAWAI = '') {
		$K_PEGAWAI = RestoreLink($K_PEGAWAI);
		
		$Array['K_PEGAWAI'] = $K_PEGAWAI;
		$Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
		$Array['Page'] = $this->lriwayat_hidup->GetProperty();
		$Array['ArrayLink'] = $this->lriwayat_hidup->GetArrayLink($K_PEGAWAI);
		
        $this->load->view('riwayat_hidup', $Array);
    }
    
    function ShowHtml($K_PEGAWAI = '') {
		if (empty($K_PEGAWAI)) {
			header("Location: " . HOST);
			exit;
		} else {
			$K_PEGAWAI = RestoreLink($K_PEGAWAI);
		}
		
		$Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['ArrayRiwayatPangkat'] = $this->lriwayat_pangkat->GetArray($K_PEGAWAI);
        $Array['ArrayRiwayatKeluarga'] = $this->lriwayat_keluarga->GetArray($K_PEGAWAI);
        $Array['ArrayRiwayatPendidikan'] = $this->lriwayat_pendidikan->GetArray($K_PEGAWAI);
        $Array['ArrayRiwayatPenghargaan'] = $this->lriwayat_penghargaan->GetArray($K_PEGAWAI);
		
        $this->load->view('riwayat_hidup_html', $Array);
    }
	
	function GetContentHtml($K_PEGAWAI) {
		$LinkContent = HOST . '/index.php/RiwayatHidup/ShowHtml/' . $K_PEGAWAI;
		$FileDomPdf = PATH.'/system/application/libraries/dompdf/dompdf_config.inc.php';
		require_once($FileDomPdf);
		
		$Curl = new CURL();
		$ResultPage = $Curl->post($LinkContent, 'RequestReport=1', '');
		
		return $ResultPage;
	}
	
	function ShowPdf($K_PEGAWAI = '') {
		if (empty($K_PEGAWAI)) {
			header("Location: " . HOST);
			exit;
		}
		
		$ResultPage = $this->GetContentHtml($K_PEGAWAI);
		
		$dompdf = new DOMPDF(); 
		$dompdf->load_html($ResultPage);
		$dompdf->render();
		$dompdf->stream("RiwayatHidup.pdf", array("Attachment" => 0));
        exit;
	}
	
	function ShowWord($K_PEGAWAI = '') {
		if (empty($K_PEGAWAI)) {
			header("Location: " . HOST);
			exit;
		}
		
		header("Content-type: application/vnd.ms-word");
		header("Content-Disposition: attachment;Filename=RiwayatHidup.doc");
		
		$ResultPage = $this->GetContentHtml($K_PEGAWAI);
		echo $ResultPage;
		exit;
	}
}