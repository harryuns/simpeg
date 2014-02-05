<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LLogin extends Controller {
    function LLogin() {
        $CI =& get_instance();
        @session_start();
		
		// Check POST Parameter for Request Report
		$RequestReport = (isset($_POST['RequestReport'])) ? 1 : 0;
		$RequestSiado = (isset($_POST['RequestSiado'])) ? 1 : 0;
		
        if (isset($_SESSION['UserLogin']) && isset($_SESSION['UserLogin']['TimeActive'])) {
			if ($this->TimeIsExpire() == 0) {
                $_SESSION['UserLogin']['TimeActive'] = strtotime("now");
                $CI->session->UserLogin = $_SESSION['UserLogin'];
            }
        }
		
        $REQUEST_URI = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';        
        $Match = strpos($REQUEST_URI, 'index.php/Peserta');
        $Match1 = strpos($REQUEST_URI, 'index.php/Peserta/All');
		$MatchCetak1 = strpos($REQUEST_URI, 'index.php/SeleksiDosen/CetakPeserta');
		$MatchCetak2= strpos($REQUEST_URI, 'index.php/SeleksiDosen/CetakHadir');		
        $this->In();
		
		if ($RequestReport == 1) {
			// Request Report so let it pass
		} else if (isset($_SERVER['no_login']) && $_SERVER['no_login']) {
			// No login for this parameter
		} else if ($RequestSiado == 1 || $this->RequestSiado()) {
			// Request Siado so let it pass
		} else if ($Match  || $Match1 || $MatchCetak1 || $MatchCetak2){
			// Request Cetak Peserta so let it pass
		} else if (!isset($CI->session->UserLogin) || (isset($CI->session->UserLogin) && !isset($CI->session->UserLogin['UserID']))) {
            if (! $this->IsLoginUrl($CI)) {
                header("Location: ".HOST);
                exit;
            }
        }
    }
	
	function RequestSiado() {
		$K_PEGAWAI = '';
		
		if (isset($_COOKIE['External_Application']) && !empty($_COOKIE['External_Application'])) {
			$ArrayData = @unserialize($_COOKIE['External_Application']);
			if (isset($ArrayData['ApplicationName']) && $ArrayData['ApplicationName'] == 'Siado') {
				$K_PEGAWAI = $ArrayData['BaisNip'];
			}
		}
		
		$REQUEST_URI = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
		
		if (empty($K_PEGAWAI)) {
			return false;
		}
		
		$Match = strpos($REQUEST_URI, $K_PEGAWAI);
		if ($Match === false) {
			return true;
		} else {
			return false;
		}
	}
	
	function TimeIsExpire() {
		$TimeActive = (isset($_SESSION['UserLogin']) && isset($_SESSION['UserLogin']['TimeActive'])) ? $_SESSION['UserLogin']['TimeActive'] : strtotime("-1 week");
		$CurrentTime = strtotime("now");
		$TimeActiveCheck = $TimeActive + IDLE_TIME;
		
		$TimeIsExpire = ($TimeActiveCheck > $CurrentTime) ? 0 : 1;
		return $TimeIsExpire;
	}
    
    function IsLoginUrl($CI) {
        $ArrayLink = $CI->uri->rsegments;
        if (!is_array($ArrayLink)) {
            $ArrayLink = array();
        }
        
        $Result = false;
        if (    (isset($ArrayLink[1]) && $ArrayLink[1] == 'login')
                && (isset($ArrayLink[2]) && $ArrayLink[2] == 'index')) {
            $Result = true;
        }
        
        return $Result;
    }
    
    function genRandomString() {
        $length = 5;
        $characters ='0123456789abcdefghijklmnopqrstuvwxyz';
        $string = '';    

        for ($p = 0; $p < $length; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters))];
        }

        return $string;
    }
    
    function In() {
        $LoginName = (isset($_POST['LoginName']) && !empty($_POST['LoginName'])) ? trim($_POST['LoginName']) : '';
        $LoginPass = (isset($_POST['LoginPass']) && !empty($_POST['LoginPass'])) ? trim($_POST['LoginPass']) : '';
        $RemoteAddress = (isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
        $RemoteAddress = ($RemoteAddress == '::1') ? '0.0.0.0' : $RemoteAddress;
        $ApplicationID = SERVICE_ID;
        
        $UserLogin = array();
        if (!empty($LoginName) && !empty($LoginPass)) {
            $StringRandom = 'xxxx';
            $URLRequest  = LOGIN_URL.'?userid='.$LoginName.'&passport='.MD5($StringRandom . $LoginPass) . '_' . $LoginName.'&challenge='.$StringRandom.'&appid='.$ApplicationID;
            $URLRequest .= '&ipaddr='.$RemoteAddress;
			
			if ($_SERVER['REMOTE_ADDR'] == '172.18.3.8' && false) {
				echo $URLRequest;
				print_r($_SERVER); exit;
			}
			
            $XMLContent = $this->GetContent($URLRequest);
            $ArrayLogin = $this->XMLToArray($XMLContent);
			
            if (isset($ArrayLogin['BAIS_XML']) && isset($ArrayLogin['BAIS_XML']['CONTENT'])) { 
                if (isset($ArrayLogin['BAIS_XML']['CONTENT']['USER'])) {
                    $User = $ArrayLogin['BAIS_XML']['CONTENT']['USER'];
					$UserName = (isset($User['attr']) && isset($User['attr']['ID']) && !empty($User['attr']['ID'])) ? $User['attr']['ID'] : '';
                    $Group = (isset($User['GROUP'])) ? $User['GROUP'] : array();
                    $GroupAttr = (isset($Group['attr'])) ? $Group['attr'] : array();
                    $GroupAttrID = (isset($GroupAttr['ID'])) ? trim($GroupAttr['ID']) : 0;
					$PegawaiNip = @$User['NIP']['attr']['Code'];
					
                    $Authority = $ArrayLogin['BAIS_XML']['CONTENT']['AUTHORITY'];
                    $Access['Register'] = (isset($Authority['DIKENAL']) && isset($Authority['DIKENAL']['value'])) ? $Authority['DIKENAL']['value'] : '0';
                    $Access['Active'] = (isset($Authority['AKTIVASI']) && isset($Authority['AKTIVASI']['value'])) ? $Authority['AKTIVASI']['value'] : '0';
                    $Access['Service'] = (isset($Authority['DAFTAR']) && isset($Authority['DAFTAR']['value'])) ? $Authority['DAFTAR']['value'] : '0';
                    $Access['Password'] = (isset($Authority['PASSWD']) && isset($Authority['PASSWD']['value'])) ? $Authority['PASSWD']['value'] : '0';
                    $Access['Schedule'] = (isset($Authority['WAKTU']) && isset($Authority['WAKTU']['value'])) ? $Authority['WAKTU']['value'] : '0';
                    $Access['Block'] = (isset($Authority['BERHAK']) && isset($Authority['BERHAK']['value'])) ? $Authority['BERHAK']['value'] : '0';
                    
                    $AccessResult = '1';
                    foreach ($Access as $Key => $Value) {
                        if ($Value != '1') {
                            $AccessResult = '0';
                        }
                    }
                    
					/*
					// Devel Hack
					$GroupAttrID = 88;
					$PegawaiNip = '195811261986091001';
					
					//   88 => dosen
					// 1005 => dosen
					// 1013 => administrator simpeg
					// 1061 => tenaga kependidikan
					
					/*	*/
					
					// Success Login
                    if ($AccessResult == '1' && !empty($UserName)) {
						if (in_array($GroupAttrID, array(120, 1013, 1014))) {
							$UserLogin['UserID'] = $LoginName;
							$UserLogin['Passport'] = '';
							$UserLogin['UserName'] = $UserName;
							$UserLogin['UserDisplay'] = $User['attr']['ID'];
							$UserLogin['UserGroupID'] = $GroupAttrID;
							$UserLogin['TimeActive'] = strtotime("now");
							$UserLogin['ApplicationRequest'] = 'Simpeg';
							$UserLogin['LinkIndex'] = HOST.'/index.php/Pegawai';
							
							$UserLogin['Fakultas']['Title'] = $User['FAKULTAS']['value'];
							$UserLogin['Fakultas']['ID'] = (empty($User['FAKULTAS']['attr']['Code'])) ? 'x' : $User['FAKULTAS']['attr']['Code'];
							
							$_SESSION['UserLogin'] = $UserLogin;
							header('Location: '.HOST.'/index.php/Pegawai');
							exit;
						} else if (in_array($GroupAttrID, array(88, 1005, 1061))) {
							$UserLogin['UserID'] = $LoginName;
							$UserLogin['Passport'] = '';
							$UserLogin['UserName'] = $UserName;
							$UserLogin['UserDisplay'] = $User['attr']['ID'];
							$UserLogin['UserGroupID'] = $GroupAttrID;
							$UserLogin['TimeActive'] = strtotime("now");
							$UserLogin['ApplicationRequest'] = 'Simpeg';
							
							$UserLogin['Fakultas']['Title'] = $User['FAKULTAS']['value'];
							$UserLogin['Fakultas']['ID'] = (empty($User['FAKULTAS']['attr']['Code'])) ? 'x' : $User['FAKULTAS']['attr']['Code'];
							
							$UserLogin['Nip'] = $PegawaiNip;
							$UserLogin['LinkIndex'] = HOST.'/index.php/Pegawai/Tambah/'.ConvertLink($UserLogin['Nip']);
							
							$_SESSION['UserLogin'] = $UserLogin;
							setcookie("External_Application", '', time() - 3600, "/", ".ub.ac.id");
							header('Location: '.$UserLogin['LinkIndex']);
							exit;
						}
                    }
                }
            }
        }
        
		if (isset($_COOKIE['External_Application'])) {
			$CookieData = $_COOKIE['External_Application'];
			$Cookie = json_decode(@gzuncompress(base64_decode($CookieData)));
			
			$Param = array( 'ApplicationRequest' => '' );
			if (is_object($Cookie)) {
				if (isset($Cookie->ApplicationRequest)) {
					$Param['ApplicationRequest'] = $Cookie->ApplicationRequest;
					$Param['Nip'] = $Cookie->Nip;
					$Param['UserID'] = $Cookie->UserID;
					$Param['ReturnLink'] = $Cookie->ReturnLink;
				}
			}
			
			if ($Param['ApplicationRequest'] == 'Siado') {
				$UserLogin['UserID'] = $Param['UserID'];
				$UserLogin['Passport'] = '';
				$UserLogin['UserName'] = $Param['UserID'];
				$UserLogin['UserDisplay'] = $Param['UserID'];
				$UserLogin['UserGroupID'] = $Param['UserID'];
				$UserLogin['TimeActive'] = strtotime("now");
				$UserLogin['ApplicationRequest'] = $Param['ApplicationRequest'];
				
				$UserLogin['Fakultas']['Title'] = 'Seluruh fakultas';
				$UserLogin['Fakultas']['ID'] = 'x';
				
				$UserLogin['Nip'] = $Param['Nip'];
				$UserLogin['ReturnLink'] = $Param['ReturnLink'];
				$UserLogin['LinkIndex'] = HOST.'/index.php/Pegawai/Tambah/'.ConvertLink($UserLogin['Nip']);
				
				$_SESSION['UserLogin'] = $UserLogin;
				setcookie("External_Application", '', time() - 3600, "/", ".ub.ac.id");
				header('Location: '.$UserLogin['LinkIndex']);
				exit;
			}
		}
		
        return $UserLogin;
    }
    
    function GetContent($Link) {
        $Content = '';
        $Handle = @fopen($Link, "r");
        
        if ($Handle) {
            while (!feof($Handle)) {
                $Content .= fread($Handle, 8192);
            }
            fclose($Handle);
        }
        
        return $Content;
    }
    
    function Out($UserLogin) {
		return;
		
        $URLRequest  = LOGIN_URL.'?serviceid='.SERVICE_ID.'&cat=user&act=out';
        $URLRequest .= '&userid='.$UserLogin['UserID'].'&passport='.$UserLogin['Passport'];
        
        $XMLContent = @file_get_contents($URLRequest);
        $ArrayLogout = $this->XMLToArray($XMLContent);
    }
    
	function IsUserFakultas() {
		$FakultasID = '';
		if (isset($_SESSION['UserLogin']))
			$FakultasID = $_SESSION['UserLogin']['Fakultas']['ID'];		
		$IsUserFakultas = '1';
		if ($FakultasID == 'x') {
			$IsUserFakultas = '0';
		}
		
		return $IsUserFakultas;
	}
	
	function is_user_fakultas() {
		$result = ($this->IsUserFakultas()) ? true : false;
		return $result;
	}
	
    function GetMessage() {
        $Message = '';
        if (isset($_POST['LoginName'])) {
            $Message = '<div style="text-align:center; padding:0 0 5px 0; color:#FF0000;">Maaf account anda tidak dikenali.</div>';
        }
        return $Message;
    }
    
	function GetUser() {
		$User = array();
		if (isset($_SESSION['UserLogin'])) {
			$User = $_SESSION['UserLogin'];
		}
		return $User;
	}
	
	function GetUserID() {
		$UserID = '';
		if (isset($_SESSION['UserLogin']) && is_array($_SESSION['UserLogin'])) {
			if (isset($_SESSION['UserLogin']['UserID']) && !empty($_SESSION['UserLogin']['UserID'])) {
				$UserID = $_SESSION['UserLogin']['UserID'];
			}
		}
		return $UserID;
	}
	
	function get_user_group() {
		$user = $this->GetUser();
		return (isset($user['UserGroupID'])) ? $user['UserGroupID'] : '';
	}
	
	function get_user_nip() {
		$user = $this->GetUser();
		return (isset($user['Nip'])) ? $user['Nip'] : '';
	}
	
    function XMLToArray($Content, $GetAttribute = 1) {
        if (!$Content) {
            return array();
        }
        
        if (!function_exists('xml_parser_create')) {
            return array();
        }
        
        $parser = xml_parser_create();
        xml_parser_set_option( $parser, XML_OPTION_CASE_FOLDING, 0 );
        xml_parser_set_option( $parser, XML_OPTION_SKIP_WHITE, 1 );
        xml_parse_into_struct( $parser, $Content, $xml_values );
        xml_parser_free( $parser );
        
        if (!$xml_values) {
            return;
        }
        
        //Initializations
        $xml_array = array();
        $parents = array();
        $opened_tags = array();
        $arr = array();
        $current = &$xml_array;
        
        foreach ($xml_values as $data) {
            unset($attributes, $value);
            
            extract($data);
            $result = '';
            
            if ($GetAttribute) {
                $result = array();
                if(isset($value)) $result['value'] = $value;
                
                if (isset($attributes)) {
                    foreach($attributes as $attr => $val) {
                        if ($GetAttribute == 1)
                            $result['attr'][$attr] = $val;
                    }
                }
            } else if (isset($value)) {
                $result = $value;
            }
            
            if ($type == "open") {
                $parent[$level-1] = &$current;
                
                if (!is_array($current) or (!in_array($tag, array_keys($current)))) {
                    $current[$tag] = $result;
                    $current = &$current[$tag];
                } else {
                    if (isset($current[$tag][0])) {
                        array_push($current[$tag], $result);
                    } else {
                        $current[$tag] = array($current[$tag],$result);
                    }
                    
                    $last = count($current[$tag]) - 1;
                    $current = &$current[$tag][$last];
                }
            
            } else if ($type == "complete") {
                if (!isset($current[$tag])) {
                    $current[$tag] = $result;
                } else {
                    if ((is_array($current[$tag]) and $GetAttribute == 0) or (isset($current[$tag][0]) and is_array($current[$tag][0]) and $GetAttribute == 1)) {
                        array_push($current[$tag], $result);
                    } else {
                        $current[$tag] = array($current[$tag], $result);
                    }
                }
            
            } else if($type == 'close') {
                $current = &$parent[$level-1];
            }
        }
        
        return($xml_array);
    }
	
	function OnlyAccessedBySimpeg() {
		if ($_SESSION['UserLogin']['ApplicationRequest'] != 'Simpeg') {
			header("Location: ".HOST."/");
			exit;
		}
	}
}
?>