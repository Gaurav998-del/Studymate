<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	function checksession()
	{
		$ci =& get_instance(); 
		if(isset($ci->session->email))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function checksessionAdmin()
	{
		$ci =& get_instance(); 
		if(isset($ci->session->emailAdmin))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function getuserid()
	{
		$ci =& get_instance();
		return $ci->session->userid;
	}
	function getBaseUrl($atRoot=FALSE, $atCore=FALSE, $parse=FALSE){
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

            $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
            $core = $core[0];

            $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
            $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
            $base_url = sprintf( $tmplt, $http, $hostname, $end );
        }
        else $base_url = 'http://localhost/';

        if ($parse) {
            $base_url = parse_url($base_url);
            if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
        }

        return $base_url;
    }
	function sendEmail($to,$message,$subject)
	{
		$ci =& get_instance();
		$getEmailSettings=$ci->App_model->getData('siteSettings',$resultType="row_array",$arg=['select'=>['smtpUsername','smtpPassword']]);
		$smtpUsername=$getEmailSettings['smtpUsername'];
		$smtpPassword=$getEmailSettings['smtpPassword'];
		if(strlen($smtpUsername)>0 && strlen($smtpPassword)>0)
		{
			$email_config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.gmail.com',
				'smtp_port' => 465,
				'smtp_user' => $smtpUsername,
				'smtp_pass' => $smtpPassword,
				'mailtype'  => 'html',
				'charset'   => 'iso-8859-1'
			);
			$ci->load->library('email', $email_config);
			$ci->email->set_newline("\r\n");
			$ci->email->from('stackoverflow1122@gmail.com','howstack');
			$ci->email->to($to);
			$ci->email->subject($subject);
			$ci->email->message($message);
			$ci->email->send();
		}
	}
	function update_config_installed() {
		$CI = & get_instance();
		$config_path = APPPATH . 'config/config.php';
		$CI->load->helper('file');
		if (!is_really_writable($config_path)) {
			show_error($config_path . ' should be writable.');
        }
		$config_file = read_file($config_path);
		$config_file = trim($config_file);
		$config_file = str_replace("\$config['installed'] = false;", "\$config['installed'] = true;", $config_file);
		$config_file = str_replace("\$config['base_url'] = '';", "\$config['base_url'] = '" . getBaseUrl() . "';", $config_file);
		if (!$fp = fopen($config_path, FOPEN_WRITE_CREATE_DESTRUCTIVE)) {
			show_error($config_path . ' should be writable.');
		}
		flock($fp, LOCK_EX);
		fwrite($fp, $config_file, strlen($config_file));
		flock($fp, LOCK_UN);
		fclose($fp);
		return TRUE;
	}
	function update_autoload_installed() {
		$CI = & get_instance();
		$config_path = APPPATH . 'config/autoload.php';
		$CI->load->helper('file');
		if (!is_really_writable($config_path)) {
			show_error($config_path . ' should be writable.');
        }
		$config_file = read_file($config_path);
		$config_file = trim($config_file);
		$config_file = str_replace("\$autoload['libraries'] =  array('email', 'session');", "\$autoload['libraries'] =  array('database','email', 'session');", $config_file);
		if (!$fp = fopen($config_path, FOPEN_WRITE_CREATE_DESTRUCTIVE)) {
			show_error($config_path . ' should be writable.');
		}
		flock($fp, LOCK_EX);
		fwrite($fp, $config_file, strlen($config_file));
		flock($fp, LOCK_UN);
		fclose($fp);
		
		return TRUE;
	}
	function encodeContent($content)
	{
		$ci =& get_instance();
		return htmlspecialchars($ci->security->xss_clean(trim($content)),ENT_QUOTES | ENT_HTML5);
	}
	function secureInput($input)
	{
		$ci =& get_instance();
		$input=filter_var(trim($input), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$input=$ci->security->xss_clean($input);
		return $input;
	}
	function decodeContent($content)
	{
		return stripcslashes(htmlspecialchars_decode($content,ENT_QUOTES));
	}
	function responseGenerate($type,$html="")
	{
		$result=['type'=>$type,'html'=>$html];
		echo json_encode($result);
		exit;
	}
	function format_uri($text)
	{
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		$text = preg_replace('~[^-\w]+~', '', $text);
		$text = trim($text, '-');
		$text = preg_replace('~-+~', '-', $text);
		$text = strtolower($text);
		if (empty($text)) {
			return 'n-a';
		}
		return $text;
	}
	function time_elapsed_string($datetime, $full = false) {
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}