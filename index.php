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

function bennettapp($args) 
{
	global $_;

	$recaptcha = $_("getConfig: recaptcha");

	$results = [
		"SITE_KEY" => $recaptcha['siteKey'],
		"RESULT" => ""
	];

	if (isset($args['g-recaptcha-response']) && $args['g-recaptcha-response'] &&
		isset($args['editordata']) && !empty($args['editordata'])) {
		$output = json_decode(
			file_get_contents(
				"https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha['secretKey'] .
				"&response=" . $args['g-recaptcha-response']
			), 
			true
		);
		if (isset($output['success']) && $output['success'] == true) {
			$fullText = $args['editordata']; // utf8_encode($args['editordata']);
			$_("insertid: INSERT INTO bennettapp (verse, more) VALUES (?, ?)", [$fullText, ""]);
		}
	}
	
	// Get all the verses
	$verses = $_("assoclist: SELECT * FROM bennettapp ORDER BY id DESC");
	
	// Check if we want to delete one
	if (isset($args['verseId']) && !empty($args['verseId'])) {
		foreach ($verses as $index => $verse) {
			if (sha1($verse['id']) == $args['verseId']) {
				$_(": DELETE FROM bennettapp WHERE id = ?", [$verse['id']]);
				unset($verses[$index]);
				break;
			}
		}
	}

	if ($verses) {
		$results['TABLE'] = '<table class="u-full-width">
								<thead>
								<tr>
									<th>Quote</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>';
		foreach ($verses as $v) {
			$results['TABLE'] .= '<tr><td><pre><code>' . $v['verse'] . '</code></pre></td>' . // utf8_decode($v['verse'])
								 '<td><a class="button-primary" href="/390e53ab5ee8a5e7032be0121864ca121cfa3ff1?verseId=' .
								 sha1($v['id']) . '">Del</a></td></tr>';
		}
		$results['TABLE'] .= '</tbody></table>';
	}

	return $results;
} 

function poemBennettApp() 
{
	global $_;
	$poem = [];
	$used = [];

	$verses = $_("assoclist: SELECT * FROM bennettapp ORDER BY id DESC");

	if (count($verses)) {
		$min = count($verses) <= 5 ? 0 : 5; 
		$max = count($verses) <= 12 ? count($verses) : 12;
		$many = rand($min, $max);
		for ($c = 0; $c < $many; $c++) {
			while (in_array(($i = rand(1, count($verses)) - 1), $used));
			$poem[] = $verses[$i]['verse']; // utf8_decode($verses[$i]['verse']);
			$used[] = $i;
		}
	}
	
	$results = [
		"OUTPUT" => json_encode($poem)
	];

	return $results;
}
