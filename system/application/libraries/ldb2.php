<?php
class LDB2 extends Controller {
    var $Handle;
    
    function LDB2() {
        $CI =& get_instance();
        $this->InvalidFileUpload = '0';
        $this->Connect(DB_NAME, DB_USER, DB_PASSWORD);
    }
    
    function Connect($DbName, $User, $PassWord) {
        $this->RemoveUploadExtentionNonJpg();
		
		if (DB_PORT) {
//			$string_db = "DATABASE=$DbName;HOSTNAME=175.45.184.192;PORT=11111;PROTOCOL=TCPIP;UID=$User;PWD=$PassWord;";
			$string_db = "DATABASE=$DbName;HOSTNAME=".DB_PORT_IP.";PORT=".DB_PORT_NO.";PROTOCOL=TCPIP;UID=$User;PWD=$PassWord;";
			$this->Handle = db2_connect($string_db, '', '') or $this->UnderMaintaince();
		} else {
			$this->Handle = db2_connect($DbName, $User, $PassWord) or $this->UnderMaintaince();
			echo time();
			exit;
		}
		
        if (!$this->Handle)
            return false;
        return true;
    }
    
    function RemoveUploadExtentionNonJpg() {
        foreach ($_FILES as $Key => $Element) {
            $Remove  = '0';
            if (isset($Element['name']) && !empty($Element['name'])) {
                $Extenxion = GetExtention($Element['name']);
				$Extenxion = strtolower($Extenxion);
                
                if (! in_array($Extenxion, array('jpg', 'jpeg', 'png', 'pdf', 'xlsx', 'xls'))) {
                    $this->InvalidFileUpload = '1';
                    $Remove = '1';
                }
            } else {
                $Remove = '1';
            }
            
            if ($Remove == '1') {
                unset($_FILES[$Key]);
            }
        }
    }
	
	function UnderMaintaince() {
		echo "Under Maintaince\n";
		echo "<!-- " . db2_conn_error() . " -->";
		exit;
	}
}
?>