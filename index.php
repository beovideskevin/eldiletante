<?php

// JUST FOR DEBUGGING
// error_reporting (E_ALL);

// JUST FOR THE LOCALHOST
// date_default_timezone_set('America/Los_Angeles');

session_start(); 

require_once('$_.php');

$_("config: config");
$_("connect");
$results = $_("route");
echo $_("render", $results);

function index ($args = [])
{
	global $_;

	if (! empty($args['lang']) && in_array($args['lang'], ['es', 'en'])) {
		$_SESSION['LANGUAGE_IN_USE'] = $args['lang'];

		$_("setlang: {$_SESSION['LANGUAGE_IN_USE']}");
	}

	$results = [];

	return $results;
}

function langEs ($args = [])
{
	$args['lang'] = 'es';

	return index($args);
}

function langEn ($args = [])
{
	$args['lang'] = 'en';

	return index($args);
}

function gallery ($args = []) 
{
	header("location: https://www.deviantart.com/eldiletantedigital/");
}

function show () 
{
	header("location: https://www.deviantart.com/eldiletantedigital/");
}

function ajax ($args = [])
{
	die("ajax");
}

function notFound ($args) 
{
	error_log('WOW (404): ' . print_r($args, true));
	error_log('IP: ' . getRealIpAddr());

	return index();
}

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
    	$ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
    	$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
    	$ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function nft($args) {
	global $_;

	$recaptcha = $_("getConfig: recaptcha");

	$results = [
		"TITLE"          => $_("getlang: PORTFOLIO_NFT"),
		"SITE_KEY"       => $recaptcha['siteKey'],
		"SCRIPTS_HEAD"   => '<script src="/works/common/p5/p5.min.js"></script>'
	];

	if (isset($args['editordata']) && !empty($args['editordata'])) {
		if (isset($args['g-recaptcha-response']) && $args['g-recaptcha-response']) {
			$output = json_decode(
				file_get_contents(
					"https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha['secretKey'] .
					"&response=" . $args['g-recaptcha-response']
				), 
				true
			);
			if (isset($output['success']) && $output['success'] == true) {
				$fullText = preg_replace("/[^a-z]/", "", strtolower(strip_tags($args['editordata']))); 
	
				$results["SCRIPTS_BOTTOM"] = $_("inject: /works/padi/netart/nft/js/nft.js", ["TEXT_CONTENT" => $fullText]);
			}
			else {
				$results['RESULT'] = "<p>Error with the captcha</p>";
			}	
		}
		else {
			$results['RESULT'] = "<p>Error with the captcha</p>";
		}	
	}

	return $results;
}