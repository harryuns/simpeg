<?php

class Login extends Controller {
    var $CI = null;
    
    function Login() {
        parent::Controller();
        $this->CI =& get_instance();
    }
    
    function Index() {
		$TimeIsExpire = $this->CI->llogin->TimeIsExpire();
		if ($TimeIsExpire == 0) {
			header("Location: ".$_SESSION['UserLogin']['LinkIndex']);
			exit;
		}
		
        $Array['Message'] = $this->CI->llogin->GetMessage();
        $this->load->view('login', $Array);
    }
    
    function Out() {
        $this->CI->llogin->Out($this->CI->session->UserLogin);
        
        session_destroy();
        $this->session->sess_destroy();
        header('Location: '.HOST.'/');
        exit;
    }
}