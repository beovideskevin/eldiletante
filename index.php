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
			$fullText = utf8_encode($args['editordata']);
			$_("insertid: INSERT INTO bennettapp (verse, more) VALUES ('?', '?')", [$fullText, ""]);

			// preg_match_all('#<p(.+?)</p>#is', $fullText, $matches); 
			// foreach ($matches[0] as $m) {
			// 	$i = $_("insertid: INSERT INTO bennettapp (verse, more) VALUES ('?', '?')", [$m, ""]);
			// 	if ($i) {
			// 		$res = $_("assoc: SELECT * FROM bennettapp WHERE id = ?", [$i]);
			// 		if (isset($res['verse'])) {
			// 			$verse = utf8_decode($res['verse']);
			// 			$results['RESULT'] .= $verse;
			// 		}
			// 	}
			// } 
		}
	}
	else if (isset($args['verseId']) && !empty($args['verseId'])) {
		$_(": DELETE FROM bennettapp WHERE id = ?", [$args['verseId']]);
	}

	$verses = $_("assoclist: SELECT * FROM bennettapp ORDER BY id DESC");

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
			$results['TABLE'] .= '<tr><td><pre><code>' . utf8_decode($v['verse']) . '</code></pre></td>' .
								 '<td><a class="button-primary" href="/390e53ab5ee8a5e7032be0121864ca121cfa3ff1?verseId='.$v['id'].'">Del</a></td></tr>';
		}

		$results['TABLE'] .= '</tbody></table>';
	}

	return $results;
} 

function poemBennettApp() 
{
	global $_;
	$poem = [];

	$verses = $_("assoclist: SELECT * FROM bennettapp ORDER BY id DESC");

	if (count($verses)) {
		$many = rand(1, count($verses));

		for ($i=0; $i < $many; $i++) {
			$poem[] = utf8_decode($verses[$i]['verse']);
		}
	}

	$results = [
		"OUTPUT" => json_encode($poem)
	];

	return $results;
}

function egoApp($args) 
{
	global $_;

	$recaptcha = $_("getConfig: recaptcha");

	$results = [
		"SITE_KEY" => $recaptcha['siteKey'],
		"RESULT" => "",
		"TABLE"  => ""
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
			$_(": INSERT INTO egoapp (quote, more) VALUES ('?', '?')", [$args['editordata'], ""]);
		}
	}
	else if (isset($args['quoteId']) && !empty($args['quoteId'])) {
		$_(": DELETE FROM egoapp WHERE id = ?", [$args['quoteId']]);
	}

	$quotes = $_("assoclist: SELECT * FROM egoapp ORDER BY id DESC");

	if ($quotes) {
		$results['TABLE'] = '<table class="u-full-width">
								<thead>
								<tr>
									<th>Quote</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>';
		foreach ($quotes as $quote) {
			$results['TABLE'] .= '<tr><td><pre><code>' . $quote['quote'] . '</code></pre></td>' .
								 '<td><a class="button-primary" href="/86698f625e85131b9aba4952f4aa2b7d632391c7?quoteId='.$quote['id'].'">Del</a></td></tr>';
		}

		$results['TABLE'] .= '</tbody></table>';
	}

	return $results;
}

function listEgoApp()
{
	global $_;

	$quotes = $_("assoclist: SELECT * FROM egoapp ORDER BY id DESC");

	$results = [
		"OUTPUT" => json_encode($quotes)
	];

	return $results;
}