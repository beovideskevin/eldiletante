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

function gallery ($args = []) {
	header("location: https://www.deviantart.com/eldiletantedigital/");
}

function show () {
	header("location: https://www.deviantart.com/eldiletantedigital/");
}

function ajax ($args = [])
{
	die("ajax");
}
