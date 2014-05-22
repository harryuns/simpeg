<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2010, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter HTML Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/html_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Heading
 *
 * Generates an HTML heading tag.  First param is the data.
 * Second param is the size of the heading tag.
 *
 * @access	public
 * @param	string
 * @param	integer
 * @return	string
 */
if ( ! function_exists('heading'))
{
	function heading($data = '', $h = '1')
	{
		return "<h".$h.">".$data."</h".$h.">";
	}
}

// ------------------------------------------------------------------------

/**
 * Unordered List
 *
 * Generates an HTML unordered list from an single or multi-dimensional array.
 *
 * @access	public
 * @param	array
 * @param	mixed
 * @return	string
 */
if ( ! function_exists('ul'))
{
	function ul($list, $attributes = '')
	{
		return _list('ul', $list, $attributes);
	}
}

// ------------------------------------------------------------------------

/**
 * Ordered List
 *
 * Generates an HTML ordered list from an single or multi-dimensional array.
 *
 * @access	public
 * @param	array
 * @param	mixed
 * @return	string
 */
if ( ! function_exists('ol'))
{
	function ol($list, $attributes = '')
	{
		return _list('ol', $list, $attributes);
	}
}

// ------------------------------------------------------------------------

/**
 * Generates the list
 *
 * Generates an HTML ordered list from an single or multi-dimensional array.
 *
 * @access	private
 * @param	string
 * @param	mixed
 * @param	mixed
 * @param	intiger
 * @return	string
 */
if ( ! function_exists('_list'))
{
	function _list($type = 'ul', $list, $attributes = '', $depth = 0)
	{
		// If an array wasn't submitted there's nothing to do...
		if ( ! is_array($list))
		{
			return $list;
		}

		// Set the indentation based on the depth
		$out = str_repeat(" ", $depth);

		// Were any attributes submitted?  If so generate a string
		if (is_array($attributes))
		{
			$atts = '';
			foreach ($attributes as $key => $val)
			{
				$atts .= ' ' . $key . '="' . $val . '"';
			}
			$attributes = $atts;
		}

		// Write the opening list tag
		$out .= "<".$type.$attributes.">\n";

		// Cycle through the list elements.  If an array is
		// encountered we will recursively call _list()

		static $_last_list_item = '';
		foreach ($list as $key => $val)
		{
			$_last_list_item = $key;

			$out .= str_repeat(" ", $depth + 2);
			$out .= "<li>";

			if ( ! is_array($val))
			{
				$out .= $val;
			}
			else
			{
				$out .= $_last_list_item."\n";
				$out .= _list($type, $val, '', $depth + 4);
				$out .= str_repeat(" ", $depth + 2);
			}

			$out .= "</li>\n";
		}

		// Set the indentation for the closing tag
		$out .= str_repeat(" ", $depth);

		// Write the closing list tag
		$out .= "</".$type.">\n";

		return $out;
	}
}

// ------------------------------------------------------------------------

/**
 * Generates HTML BR tags based on number supplied
 *
 * @access	public
 * @param	integer
 * @return	string
 */
if ( ! function_exists('br'))
{
	function br($num = 1)
	{
		return str_repeat("<br />", $num);
	}
}

// ------------------------------------------------------------------------

/**
 * Image
 *
 * Generates an <img /> element
 *
 * @access	public
 * @param	mixed
 * @return	string
 */
if ( ! function_exists('img'))
{
	function img($src = '', $index_page = FALSE)
	{
		if ( ! is_array($src) )
		{
			$src = array('src' => $src);
		}

		$img = '<img';

		foreach ($src as $k=>$v)
		{

			if ($k == 'src' AND strpos($v, '://') === FALSE)
			{
				$CI =& get_instance();

				if ($index_page === TRUE)
				{
					$img .= ' src="'.$CI->config->site_url($v).'" ';
				}
				else
				{
					$img .= ' src="'.$CI->config->slash_item('base_url').$v.'" ';
				}
			}
			else
			{
				$img .= " $k=\"$v\" ";
			}
		}

		$img .= '/>';

		return $img;
	}
}

// ------------------------------------------------------------------------

/**
 * Doctype
 *
 * Generates a page document type declaration
 *
 * Valid options are xhtml-11, xhtml-strict, xhtml-trans, xhtml-frame,
 * html4-strict, html4-trans, and html4-frame.  Values are saved in the
 * doctypes config file.
 *
 * @access	public
 * @param	string	type	The doctype to be generated
 * @return	string
 */
if ( ! function_exists('doctype'))
{
	function doctype($type = 'xhtml1-strict')
	{
		global $_doctypes;

		if ( ! is_array($_doctypes))
		{
			if ( ! require_once(APPPATH.'config/doctypes.php'))
			{
				return FALSE;
			}
		}

		if (isset($_doctypes[$type]))
		{
			return $_doctypes[$type];
		}
		else
		{
			return FALSE;
		}
	}
}

// ------------------------------------------------------------------------

/**
 * Link
 *
 * Generates link to a CSS file
 *
 * @access	public
 * @param	mixed	stylesheet hrefs or an array
 * @param	string	rel
 * @param	string	type
 * @param	string	title
 * @param	string	media
 * @param	boolean	should index_page be added to the css path
 * @return	string
 */
if ( ! function_exists('link_tag'))
{
	function link_tag($href = '', $rel = 'stylesheet', $type = 'text/css', $title = '', $media = '', $index_page = FALSE)
	{
		$CI =& get_instance();

		$link = '<link ';

		if (is_array($href))
		{
			foreach ($href as $k=>$v)
			{
				if ($k == 'href' AND strpos($v, '://') === FALSE)
				{
					if ($index_page === TRUE)
					{
						$link .= ' href="'.$CI->config->site_url($v).'" ';
					}
					else
					{
						$link .= ' href="'.$CI->config->slash_item('base_url').$v.'" ';
					}
				}
				else
				{
					$link .= "$k=\"$v\" ";
				}
			}

			$link .= "/>";
		}
		else
		{
			if ( strpos($href, '://') !== FALSE)
			{
				$link .= ' href="'.$href.'" ';
			}
			elseif ($index_page === TRUE)
			{
				$link .= ' href="'.$CI->config->site_url($href).'" ';
			}
			else
			{
				$link .= ' href="'.$CI->config->slash_item('base_url').$href.'" ';
			}

			$link .= 'rel="'.$rel.'" type="'.$type.'" ';

			if ($media	!= '')
			{
				$link .= 'media="'.$media.'" ';
			}

			if ($title	!= '')
			{
				$link .= 'title="'.$title.'" ';
			}

			$link .= '/>';
		}


		return $link;
	}
}

// ------------------------------------------------------------------------

/**
 * Generates meta tags from an array of key/values
 *
 * @access	public
 * @param	array
 * @return	string
 */
if ( ! function_exists('meta'))
{
	function meta($name = '', $content = '', $type = 'name', $newline = "\n")
	{
		// Since we allow the data to be passes as a string, a simple array
		// or a multidimensional one, we need to do a little prepping.
		if ( ! is_array($name))
		{
			$name = array(array('name' => $name, 'content' => $content, 'type' => $type, 'newline' => $newline));
		}
		else
		{
			// Turn single array into multidimensional
			if (isset($name['name']))
			{
				$name = array($name);
			}
		}

		$str = '';
		foreach ($name as $meta)
		{
			$type 		= ( ! isset($meta['type']) OR $meta['type'] == 'name') ? 'name' : 'http-equiv';
			$name 		= ( ! isset($meta['name'])) 	? '' 	: $meta['name'];
			$content	= ( ! isset($meta['content']))	? '' 	: $meta['content'];
			$newline	= ( ! isset($meta['newline']))	? "\n"	: $meta['newline'];

			$str .= '<meta '.$type.'="'.$name.'" content="'.$content.'" />'.$newline;
		}

		return $str;
	}
}

// ------------------------------------------------------------------------

/**
 * Generates non-breaking space entities based on number supplied
 *
 * @access	public
 * @param	integer
 * @return	string
 */
if ( ! function_exists('nbs'))
{
	function nbs($num = 1)
	{
		return str_repeat("&nbsp;", $num);
	}
}

if ( ! function_exists('EscapeString'))
{
	function EscapeString($Array) {
		$ArrayResult = array();
		foreach($Array as $Key => $Element) {
			if (!is_array ($Element)) {
				$ArrayResult[$Key] = mysql_escape_string($Element);
			}
		}
		return $ArrayResult;
	}
}

if ( ! function_exists('GetOption'))
{
    function GetOption($OptAll, $ArrayOption, $Selected) {
        $temp = ($Selected == 0) ? 'selected' : '';
        $Content = ($OptAll) ? '<option value="x" '.$temp.'>Semua<option>' : '';
		
        foreach ($ArrayOption as $Value => $Title) {
            $temp = ($Selected === (string)$Value && strlen($Selected) == strlen($Value)) ? 'selected' : '';
            
            if (is_array($Title) && isset($Title['Content'])) {
                $Title = $Title['Content'];
            }
            $Content .= '<option value="'.$Value.'" '.$temp.'>'.$Title.'</option>';
        }
		
        return $Content;
    }
}

if ( ! function_exists('ShowOption'))
{
    function ShowOption($Param) {
		$Param['OptAll'] = (isset($Param['OptAll'])) ? $Param['OptAll'] : false;
		$Param['ArrayID'] = (isset($Param['ArrayID'])) ? $Param['ArrayID'] : 'id';
		$Param['ArrayTitle'] = (isset($Param['ArrayTitle'])) ? $Param['ArrayTitle'] : 'title';
		$Param['Selected'] = (isset($Param['Selected'])) ? $Param['Selected'] : '';
		$Param['Selected'] = preg_replace('/[^a-z0-9]+/i', '', $Param['Selected']);
		
		$Content = '';
		$Selected = '';
		if ($Param['OptAll']) {
			$Selected = ($Param['Selected'] == '0') ? 'selected' : '';
			$Content .= '<option value="0" ' . $Selected . '>Semua<option>';
		}
		
		foreach ($Param['Array'] as $Array) {
			$Selected = ($Param['Selected'] == $Array[$Param['ArrayID']]) ? 'selected' : '';
			$Content .= '<option value="'.$Array[$Param['ArrayID']].'" '.$Selected.'>'.$Array[$Param['ArrayTitle']].'</option>';
		}
		
        return $Content;
    }
}

if ( ! function_exists('GetLengthChar'))
{
	function GetLengthChar($String, $LengthMax, $Follower = '') {
		if (strlen($String) > $LengthMax) {
			$String = substr($String, 0, $LengthMax);
			$Stringpos = strrpos($String, ' ');
			if (false !== $Stringpos) $String = substr($String, 0, $Stringpos);
			if (!empty($Follower)) {
				$String .= $Follower;
			}
		}
		return $String;
	}
}

if ( ! function_exists('TableCount'))
{
	function TableCount($Table) {
		$CountRecord = 0;
		$SelectCount  = "SELECT COUNT(*) CountRecord FROM $Table";
		$SelectResult = mysql_query($SelectCount) or CallErrorQuery(__LINE__, $SelectCount);
		if (false !== $Row = mysql_fetch_assoc($SelectResult)) {
			$CountRecord = $Row['CountRecord'];
		}
		return $CountRecord;
	}
}

if ( ! function_exists('GetFileExtention'))
{
	function GetFileExtention($FileName) {
		if (empty($FileName)) {
			return '';
		}
		
		$FileName = strtolower($FileName);
		$Extention = (preg_match('/.(jpg|jpeg|png|gif)/i', $FileName, $Match)) ? $Match[0] : '.jpg';
		return $Extention;
	}
}

if ( ! function_exists('ArrayToJSON'))
{
	function ArrayToJSON($Array) {
		$Result = '';
		foreach ($Array as $Key => $Element) {
			$Element = mysql_escape_string($Element);
			$Result .= (empty($Result)) ? "'$Key': '$Element'" : ",'$Key':'$Element'";
		}
		$Result = '{' . $Result . '}';
		return $Result;
	}
}

if ( ! function_exists('ConvertToUnixTime'))
{
	function ConvertToUnixTime($String) {
		preg_match('/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/i', $String, $Match);
		$UnixTime = mktime ($Match[4], $Match[5], $Match[6], $Match[2], $Match[3], $Match[1]);
		$UnixTime = 'new Date('.$UnixTime.')';
		return $UnixTime;
	}
}

if ( ! function_exists('MoneyFormat'))
{
	function MoneyFormat($Value) {
		return number_format($Value, 2, '.', '.');
	}
}

if ( ! function_exists('ArrayKeyToString'))
{
	function ArrayKeyToString($Array) {
		$String = '';
		foreach ($Array as $Key => $Element) {
			$String .= ($String == '') ? $Element : ', ' . $Element;
		}
		return $String;
	}
}

if ( ! function_exists('XMLToArray'))
{
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
}

if ( ! function_exists('GetPageFromArray'))
{
	function GetPageFromArray($Array, $PageStart, $PageEnd) {
		$Counter = 0;
		
		$ArrayResult = array();
		foreach ($Array as $Key => $Element) {
			if ($Counter >= $PageStart && $Counter < $PageEnd) {
				$ArrayResult[] = $Array[$Key];
			}
			
			$Counter++;
		}
		
		return $ArrayResult;
	}
}

if ( ! function_exists('IsValidEmail'))
{
	function IsValidEmail($Email) {
        $Result = false;
        preg_match('/[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/i', $Email, $Match);
        
        if (count($Match) == 1 && !empty($Match[0])) {
            $Result = true;
        }
        
		return $Result;
	}
}

if ( ! function_exists('ConvertLink'))
{
    function ConvertLink($String) {
		$Encryption = new Encryption();
		return $Encryption->encode($String);
    }
}

if ( ! function_exists('RestoreLink'))
{
    function RestoreLink($String) {
		$Encryption = new Encryption();
		return $Encryption->decode($String);
    }
}

if ( ! function_exists('ChangeFormatDate'))
{
    /*
        $Mode 0 => Swap Year and Date
        $Mode 1 => Return Day
        $Mode 2 => Return Month
        $Mode 3 => Return Year
    */
    function ChangeFormatDate($Date, $Mode = '0') {
        $Date = preg_replace('/[^0-9\-]/i', '', $Date);
        if (empty($Date)) {
            return '';
        }
        
        $ArrayDate = explode('-', $Date);
		if (count($ArrayDate) != 3) {
			return '';
		}
		
        $ResultDate = $ArrayDate[2].'-'.$ArrayDate[1].'-'.$ArrayDate[0];
        
        $Result = '';
        if ($Mode == '1') {
            $Result = (strlen($ArrayDate[2]) == 2) ? $ArrayDate[2] : $ArrayDate[0];
        } else if ($Mode == '2') {
            $Result = $ArrayDate[1];
        } else if ($Mode == '3') {
            $Result = (strlen($ArrayDate[0]) == 4) ? $ArrayDate[0] : $ArrayDate[2];
        } else {
            $Result = $ResultDate;
        }
        
        return $Result;
    }
}

if ( ! function_exists('DateToStandartDate')) {
	function DateToStandartDate($Value) {
		if (empty($Value)) {
			return '';
		}
		
		$Array = explode('/', $Value);
		if (count($Array) != 3) {
			return '';
		}
		
		$Result = $Array[2] . '-' . $Array[0] . '-' . $Array[1];
		
		return $Result;
	}
}

if ( ! function_exists('CollectDate'))
{
    function CollectDate($Parameter, $Prefix, $EmptyReturn = 'x') {
        $Day = (isset($Parameter[$Prefix.'_DAY'])) ? $Parameter[$Prefix.'_DAY'] : '';
        $Month = (isset($Parameter[$Prefix.'_MONTH'])) ? $Parameter[$Prefix.'_MONTH'] : '';
        $Year = (isset($Parameter[$Prefix.'_YEAR'])) ? $Parameter[$Prefix.'_YEAR'] : '';
        
        $Date = $Year.'-'.$Month.'-'.$Day;
        if (strlen($Date) != 10) {
            $Date = $EmptyReturn;
        }
        
        return $Date;
    }
}

if ( ! function_exists('GetPageFromArray'))
{
    function GetPageFromArray($Array, $PageStart, $PageEnd) {
        $Counter = 0;
        
        $ArrayResult = array();
        foreach ($Array as $Key => $Element) {
            if ($Counter >= $PageStart && $Counter < $PageEnd) {
                $ArrayResult[$Key] = $Array[$Key];
            }
            
            $Counter++;
        }
        
        return $ArrayResult;
    }
}

if ( ! function_exists('WriteLog'))
{
    function WriteLog($K_PEGAWAI, $String) {
		$FileName = $K_PEGAWAI.'.txt';
		$FileLocation = PATH.'/Log/Transaction/'.$FileName;
		
		$String = date("Y-m-d H:i:s : ") . $_SESSION['UserLogin']['UserID'] . ' : ' . $String;
		$String = preg_replace('/\s+/', ' ', $String) . "\n";
		
		$Handle = fopen($FileLocation, FOPEN_WRITE_CREATE);
		fwrite($Handle, $String);
		fclose($Handle);
		
		WriteLogErrorQuery($String);
    }
}

if ( ! function_exists('GetSummaryYearMonth'))
{
    function GetSummaryYearMonth($Value) {
		if (empty($Value)) {
			return '0.00';
		}
		
		$ValueInteger = $Value * 100;
		$ValueString = str_pad($ValueInteger, 10, '0', STR_PAD_LEFT);
		$ArrayValue[0] = substr($ValueString, -4, 2);
		$ArrayValue[1] = substr($ValueString, -2, 2);
		
		if ($ArrayValue[1] >= 12) {
			$Inc = floor($ArrayValue[1] / 12);
			
			$ArrayValue[0] = $ArrayValue[0] + $Inc;
			$ArrayValue[1] = $ArrayValue[1] % 12;
			$ArrayValue[1] = str_pad($ArrayValue[1], 2, '0', STR_PAD_LEFT);
		}
		
		$Result = $ArrayValue[0] . '.' . $ArrayValue[1];
		$Result = number_format($Result, 2, '.', '');
		
		return $Result;
    }
}

if (! class_exists('Encryption')) {
class Encryption {
	var $skey 	= SALT;
 
    public  function safe_b64encode($string) {
 
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }
 
	public function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
 
    public  function encode($value){ 
 
	    if(!$value){return false;}
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
        return trim($this->safe_b64encode($crypttext)); 
    }
 
    public function decode($value){
 
        if(!$value){return false;}
        $crypttext = $this->safe_b64decode($value); 
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }
}
}

if ( ! function_exists('get_select_tree')) {
function get_select_tree($array, $is_first = true) {
	$result = '';
	foreach ($array as $row) {
		$content_child = '';
		if (count($row['CHILDREN']) > 0) {
			$content_child = get_select_tree($row['CHILDREN'], false);
		}
		
		$result .= '<li ><a class="cursor select" data-row=\''.json_encode($row).'\'>'.$row['CONTENT'].'</a>'.$content_child.'</li>';
	}
	
	if (!empty($result)) {
		if ($is_first) {
			$result = '<ul class="pde">'.$result.'</ul>'; 
		} else {
			$result = '<ul>'.$result.'</ul>';
		}
	}
	
	return $result;
}
}

if (! function_exists('get_length_char')) {
	function get_length_char($String, $LengthMax, $Follower = '') {
		$String = strip_tags($String);
		if (strlen($String) > $LengthMax) {
			$String = substr($String, 0, $LengthMax);
			$Stringpos = strrpos($String, ' ');
			if (false !== $Stringpos) $String = substr($String, 0, $Stringpos);
			if (!empty($Follower)) {
				$String .= $Follower;
			}
		}
		return $String;
	}
}

/* End of file html_helper.php */
/* Location: ./system/helpers/html_helper.php */