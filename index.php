<?php

// JUST FOR DEBUGGING
// error_reporting (E_ALL);

// JUST FOR THE LOCALHOST
// date_default_timezone_set('America/Los_Angeles');

session_start();

require_once('$_.php');

$_("init");

function index ($args = [])
{
	global $_;

	if (! empty($args['lang']) && in_array($args['lang'], ['es', 'en'])) {
		$_SESSION['LANGUAGE_IN_USE'] = $args['lang'];

		$_("language: {$_SESSION['LANGUAGE_IN_USE']}");
	}
	
	$results = [];

	$_("render", $results);
}

function langEs ($args = [])
{
	$args['lang'] = 'es';

	index($args);
}

function langEn ($args = [])
{
	$args['lang'] = 'en';

	index($args);
}

function ajax ($args = [])
{
	die("ajax");
}

function counter ($args = [])
{
	global $_;

	$client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

	$_(": INSERT INTO counter (ip) VALUES ('?')", [$ip]);
}
