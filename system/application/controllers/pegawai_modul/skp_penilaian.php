<?php

class skp_penilaian extends Controller {
	function __construct() {
        parent::Controller();
    }
    
    function index() {
        $this->load->view('pegawai_modul/skp_penilaian');
    }
    
    function action() {
		$result = array();
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		$reload = (isset($_POST['reload'])) ? $_POST['reload'] : true;
		$reload = ($reload === 'false') ? false : $reload;
		
		// user
		$_POST['USERID'] = $this->session->UserLogin['UserID'];
		
		// kegiatan
		if ($action == 'update_penilaian') {
			$result = $this->skp_model->update_tupoksi($_POST);
		} else if ($action == 'update_validasi') {
			$_POST['IS_VALID'] = 1;
			$result = $this->skp_model->update_validasi($_POST);
		} else if ($action == 'delete_penilaian') {
			$result = $this->skp_model->delete_tupoksi($_POST);
		}
		
		// keberatan
		else if ($action == 'update_keberatan') {
			$result = $this->skp_model->update_keberatan($_POST);
		}
		
		// kreativitas
		else if ($action == 'update_kreativitas') {
			$result = $this->skp_model->update_kreativitas_pegawai($_POST);
		} else if ($action == 'delete_kreativitas') {
			$result = $this->skp_model->delete_kreativitas_pegawai($_POST);
		}
		
		// tugas tambahan
		else if ($action == 'update_tugas_tambahan') {
			$result = $this->skp_model->update_tugas_tambahan_pegawai($_POST);
		} else if ($action == 'delete_tugas_tambahan') {
			$result = $this->skp_model->delete_tugas_tambahan_pegawai($_POST);
		}
		
		// perilaku
		else if ($action == 'update_perilaku') {
			$result = $this->skp_model->update_perilaku_pegawai($_POST);
		} else if ($action == 'delete_perilaku') {
			$result = $this->skp_model->delete_perilaku_pegawai($_POST);
		}
		
		if ($reload && isset($result['status']) && $result['status']) {
			set_flash_message($result['message']);
		}
		
		echo json_encode($result);
    }
	
	function cetak($raw_data = '') {
		$K_PENILAI = mcrypt_decode($raw_data);
		$penilai = $this->skp_model->get_by_id_penilai(array( 'K_PENILAI' => $K_PENILAI ));
		
		// load library
		ini_set("memory_limit", "124M");
		$pdf = $this->lpdf->load();
		
		// collect template
		$template = $this->load->view( 'pegawai_modul/skp_pdf_sasaran_kerja', array( 'K_PENILAI' => $K_PENILAI ), true );
		$pdf->WriteHTML($template);
		
		$pdf->AddPage('L');
		$template = $this->load->view( 'pegawai_modul/skp_pdf_capaian_sasaran', array( 'K_PENILAI' => $K_PENILAI ), true );
		$pdf->WriteHTML($template);
		
		$pdf->AddPage('P');
		$template = $this->load->view( 'pegawai_modul/skp_pdf_perilaku', array( 'K_PEGAWAI' => $penilai['K_PEGAWAI'], 'TAHUN' => $penilai['TAHUN'], 'K_PENILAI' => $K_PENILAI ), true );
		$pdf->WriteHTML($template);
		
		$pdf->Output();
	}
}