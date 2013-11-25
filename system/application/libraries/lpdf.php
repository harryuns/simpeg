<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class lpdf {
 
    function lpdf()
    {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }
 
    function load($param=NULL)
    {
        include_once PATH.'/system/application/libraries/mpdf56/mpdf.php';
 
        if ($params == NULL)
        {
            //$param = '"en-GB-x","A4","","",10,10,10,10,6,3';
            //$param = ''c','A4''
        }
 
        //return new mPDF('utf-8','A4');
        return new mPDF('',    // mode - default ''        		
        		'',    // format - A4, for example, default ''        		
        		0,     // font size - default 0        		
        		'',    // default font family        		
        		5,    // margin_left        		
        		5,    // margin right        		
        		5,     // margin top        		
        		5,    // margin bottom        		
        		0,     // margin header        		
        		0,     // margin footer        		
        		'P');  // L - landscape, P - portrait
    }
}