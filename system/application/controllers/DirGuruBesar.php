<?
class DirGuruBesar extends Controller {
    
	function __construct() {
        parent::__construct();
		$this->load->model('directory_gurubesar_model');
		$this->load->library('session');
	}
	
	function Index(){
		$param['K_UNIT_KERJA']='x';
		$param['ID_GURU_BESAR']='x';
		$param['K_PEGAWAI']='x';
		$data['list']=$this->directory_gurubesar_model->get($param);
		$this->load->view('DirGuruBesar/header');
		$this->load->view('DirGuruBesar/home',$data); 
		$this->load->view('DirGuruBesar/footer');
	}
	
	function insert(){
		$this->load->library('lunit_kerja');
		if(isset($_POST['submit'])){
			$params = $_POST;
			$params['USERID'] = $_SESSION['UserLogin']['UserID'];
			$res=$this->directory_gurubesar_model->insertupdate($params); 
			$data['data']['errcode'] = $res[0]['ERROR'];
			if($res[0]['ERROR']=='00000')
					$this->session->set_flashdata('err_msg','Data berhasil disimpan');
				else $this->session->set_flashdata('err_msg','Data gagal disimpan');
			redirect(base_url().'index.php/DirGuruBesar/');
			exit;
		}
		$data['list_uk'] = $this->lunit_kerja->GetArrayAll('x','1','0');
		$this->load->view('DirGuruBesar/header');
		$this->load->view('DirGuruBesar/form',$data); 
	}
	
	function edit($id){
		if($id){
			
			$this->load->library('lunit_kerja');
			$param['K_UNIT_KERJA']='x';
			$param['ID_GURU_BESAR']=$id;
			$param['K_PEGAWAI']='x';
			$tmp=$this->directory_gurubesar_model->get($param); 
			$data = $tmp['0'];
			if(isset($_POST['submit'])){
				$params = $_POST;
				$params['USERID'] = $_SESSION['UserLogin']['UserID'];
				$res=$this->directory_gurubesar_model->insertupdate($params); 
				$data['data']['errcode'] = $res[0]['ERROR'];
				if($res[0]['ERROR']=='00000')
					$this->session->set_flashdata('err_msg','Data berhasil disimpan');
				else $this->session->set_flashdata('err_msg','Data gagal disimpan');
				redirect(base_url().'index.php/DirGuruBesar/edit/'.$id);
				exit;
			}
			$data['list_uk'] = $this->lunit_kerja->GetArrayAll('x','x','1');
			$this->load->view('DirGuruBesar/header');
			$this->load->view('DirGuruBesar/form',$data); 
		}
		else{
			$this->session->set_flashdata('err_msg','Request Not Found');
			redirect(base_url().'index.php/DirGuruBesar/');
		}
	}
	
	function delete($id){
		$param['ID_GURU_BESAR']=$id;
		$tmp=$this->directory_gurubesar_model->delete($param);
		if($tmp[0]['ERROR'] == '00000'){
			$this->session->set_flashdata('err_msg','Data Berhasil dihapus');
		}
		else{
			$this->session->set_flashdata('err_msg','Data gagal dihapus');
		}
		redirect(base_url().'index.php/DirGuruBesar/');
	}
	
	function import(){
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		require_once PATH.'/system/application/libraries/PHPExcel.php';
		require_once PATH.'/system/application/libraries/PHPExcel/IOFactory.php';
		
		$valid_formats = array("xls","xlsx"); //add the formats you want to upload
		$file = $_FILES['fileexcel']['tmp_name']; //get the temporary uploaded excel name 
		$name = $_FILES['fileexcel']['name']; //get the name of the excel
		$html = "";
		
		if(strlen($name)){
			list($txt, $ext) = explode(".", $name); //extract the name and extension of the excel
			if(in_array($ext,$valid_formats)){ //if the file is valid go on.
				if (!file_exists(PATH.'/files/'.$_SESSION['UserLogin']['UserID'])) {
				    mkdir(PATH.'/files/'.$_SESSION['UserLogin']['UserID']);
				}
				
				move_uploaded_file($file, PATH.'/files/'.$_SESSION['UserLogin']['UserID']."/".$name);
				$objPHPExcel = PHPExcel_IOFactory::load(PATH.'/files/'.$_SESSION['UserLogin']['UserID']."/".$name);
				
				$XMLFILE = "<DB2ADMIN>";
				foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
					$highestRow         = $worksheet->getHighestRow(); // e.g. 10
				    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
				    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
					
					for ($row = 2; $row <= $highestRow; $row++) {
						$tgl_pensiun = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
						$tgl_wafat = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
						$id_gurubesar = str_replace(".", "", microtime(TRUE));
						if($tgl_pensiun == ""){
							$tgl_pensiun = "1900-01-01";
						}
						if($tgl_wafat == ""){
							$tgl_wafat = "1900-01-01";
						}
						$XMLFILE .= "<DIREKTORI_GURU_BESAR>";
						$XMLFILE .= "<ID_GURUBESAR>".$id_gurubesar."</ID_GURUBESAR>
									 <K_PEGAWAI>".$worksheet->getCellByColumnAndRow(0, $row)->getValue()."</K_PEGAWAI>
									 <NAMA>".$worksheet->getCellByColumnAndRow(1, $row)->getValue()."</NAMA>
									 <GLR_DPN>".$worksheet->getCellByColumnAndRow(2, $row)->getValue()."</GLR_DPN>
									 <GLR_BLKG>".$worksheet->getCellByColumnAndRow(3, $row)->getValue()."</GLR_BLKG>
									 <TGL_LAHIR>".$worksheet->getCellByColumnAndRow(4, $row)->getValue()."</TGL_LAHIR>
									 <K_UNIT_KERJA>".$worksheet->getCellByColumnAndRow(5, $row)->getValue()."</K_UNIT_KERJA>
									 <TGL_PENGUKUHAN>".$worksheet->getCellByColumnAndRow(6, $row)->getValue()."</TGL_PENGUKUHAN>
									 <JUDUL_ORASI>".$worksheet->getCellByColumnAndRow(7, $row)->getValue()."</JUDUL_ORASI>
									 <BIDANG_ILMU>".$worksheet->getCellByColumnAndRow(8, $row)->getValue()."</BIDANG_ILMU>
									 <KETERANGAN>".$worksheet->getCellByColumnAndRow(9, $row)->getValue()."</KETERANGAN>
									 <TGL_PENSIUN>".$tgl_pensiun."</TGL_PENSIUN>
									 <TGL_WAFAT>".$tgl_wafat."</TGL_WAFAT>
									 <URL_FOTO>".$worksheet->getCellByColumnAndRow(12, $row)->getValue()."</URL_FOTO>
									 <USERID>".$worksheet->getCellByColumnAndRow(13, $row)->getValue()."</USERID>";
						$XMLFILE .= "</DIREKTORI_GURU_BESAR>";
					}
				}
				$XMLFILE .= "</DB2ADMIN>";
				
				$k_input = explode(" ", microtime());
				$params = array();
				$params['k_input'] = $k_input[1];
				$params['xml'] = $XMLFILE;
				$result = $this->directory_gurubesar_model->importXML($params);
				
				unlink(PATH.'/files/'.$_SESSION['UserLogin']['UserID']."/".$name);
				// echo "<pre>";
				// print_r($result);
				// echo "</pre>";
				echo $result[0]['MSG'];
				// $XMLFILE = str_replace("<","%3C", $XMLFILE);
				// $XMLFILE = str_replace(">","%3E", $XMLFILE);
				// echo "<iframe width=\"100%\" src=\"data:text/xml;charset=utf-8,".$XMLFILE."\" />";
			}else{
				echo "Invalid file format";
			}
		}else{
			echo "Please select file";
		}
	}
}

?>