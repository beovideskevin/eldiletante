<?php

/******** MySQL ************/

DEFINE('SERVER_CONFIG', 'localhost');
DEFINE('SERVER_DATABASE_CONFIG', 'eldile5_edd_db');
DEFINE('SERVER_DATABASE_USER_CONFIG', 'root');
DEFINE('SERVER_DATABASE_PASSWORD_CONFIG', '');

$_ = function ($query = "", $options = "", $extras = "") {
	static $query_obj = null;
	// create the queryObject
	if (empty($query_obj)) 
		$query_obj = new QueryClass();
	// first get the parts of the query into an array
	$args = cleanArguments($query);
	// get the main action, the first word, and unset it 
	$action = strtolower($args[0]);
	array_splice($args, 0, 1);
	// this is tricky...
	if (empty($options) && strpos($action, ":") === false && $action != 'query') {
		$options = $args;
		$repeated_args = true;
	}
	else 
		$repeated_args = false;
	// check if the action is defined
	switch ($action) {
		// connect to a database
		case 'connect':
			return $query_obj->connection($options);
			break;

		// disconnect from the database
		case 'disconnect':
			$query_obj->disconnect($options);
			break;
			
		// get the link to the database
		case 'link':
			return $query_obj->link();
			break;

		// run a literal query and overwrites the default return type with the value 
		case 'single:':
		case 'insertid:':
		case 'obj:':
		case 'assoclist:':
		case 'assoc:':
			$options = substr($action, 0, -1);
		// run a literal query 
		case ':':
			return $query_obj->query($args, $options);
			break;

		// short hand action for getting everything (*) from a table
		case '*':
			$tmp_args[0] = 'SELECT * FROM ';
			$tmp_args[1] = $args[0];
			$tmp_args[2] = " WHERE ";
			for ($index = 1; $index < count($args); $index++) 
				$tmp_args[2] .= $args[$index] . " ";
			if (! $repeated_args) {
				if (is_array($options)) 
					foreach ($options as $o) 
						$tmp_args[2] .= $o . " ";
				else 
					$tmp_args[2] .= $options;
			}
			$tmp_args[3] = $extras;
			$args = $tmp_args;
			return $query_obj->query($args, "default");
			break;

		// short hand action for getting count(*) from a table
		case 'count(*)':
			$tmp_args[0] = 'SELECT COUNT(*) FROM ';
			$tmp_args[1] = $args[0];
			$tmp_args[2] = " WHERE ";
			for ($index = 1; $index < count($args); $index++) 
				$tmp_args[2] .= $args[$index] . " ";
			if (! $repeated_args) {
				if (is_array($options)) 
					foreach ($options as $o) 
						$tmp_args[2] .= $o . " ";
				else 
					$tmp_args[2] .= $options;
			}
			$tmp_args[3] = $extras;
			$args = $tmp_args;
			return $query_obj->query($args, "single");
			break;

		// unknowed action, return error
		default:
			error_log("WOW (not an option): " . $action . " \n query: " . print_r($query, true) . 
						"\n options: " . print_r($options, true) . "\n extras: " . print_r($extras, true));
			return false;
			break;
	}
};

class QueryClass {
	static $link = NULL;
	static $result = NULL;
	static $ret = "assoc"; 
	// a do nothing constructor, internalQuery takes care of whatever needs to be done
	public function __construct () {
		 self::connection();
	}
	public static function connection ($args = "") {
		// if the link is not empty, abort the previous connection
		if (! empty(self::$link)) 
			mysqli_close(self::$link);
		// create the new connection
		if (! defined("SERVER_CONFIG") || ! defined("SERVER_DATABASE_CONFIG") || 
			! defined("SERVER_DATABASE_USER_CONFIG") || ! defined("SERVER_DATABASE_PASSWORD_CONFIG"))
			return false;
		$server = SERVER_CONFIG;
		$user = SERVER_DATABASE_USER_CONFIG;
		$pass = SERVER_DATABASE_PASSWORD_CONFIG;
		$database = SERVER_DATABASE_CONFIG;
		self::$link = @new mysqli($server, $user, $pass, $database);
		if (! self::$link || ! empty(self::$link->connect_errno) || ! empty(self::$link->connect_error)) 
			die('Could not connect: ' . @mysqli_error(self::$link) . "<br>" . 
				self::$link->connect_errno . "<br>" . self::$link->connect_error);
		// return the link
		return self::$link;
	}
	
	public static function disconnect ($args) {
		// check if args is empty and disconnect the current link 
		if (empty($args)) 
			mysqli_close(self::$link);
		else  // disconnect the link in args 
			mysqli_close($args);
	}
	
	public static function link () {
		return self::$link;
	}
	
	public static function query ($args, $opts = "") {
		$q = implode(" ", $args);
		self::$result = self::$link->query($q);
		if (! self::$result) {
			error_log("WOW (query): " . $q);
			return false;
		}
		elseif (! empty($opts)) {
			$res = self::result($opts);
			return $res;
		}
		return true;
	}
	
	public static function result ($args = "", $opts = "") {
		$act = self::$ret;
		if (! empty($args)) 
			$act = trimLower($args);
		elseif (! empty($opts)) 
			$act = trimLower($opts);
		switch ($act) {
			case 'single':
				$tmp = self::$result->fetch_row();
				return $tmp[0];
				break;
			
			case 'insertid':
				return self::$link->insert_id;
				break;
			
			case 'obj':
				return self::$result->fetch_object();
				break;
				
			case 'assoclist':
				return self::$result->fetch_all(MYSQLI_ASSOC);
				break;
			
			case 'assoc':
			default:
				return self::$result->fetch_assoc();
				break;
		}
	}
}

function cleanArguments ($query) {
    $query = explode (' ', trim($query));
    if (strrpos($query[0], ':') !== false) {
        $tmp = explode(':', $query[0]);
        if (count($tmp) > 1 && !empty($tmp[1])) {
            unset($query[0]);
            array_unshift($query, $tmp[0], $tmp[1]);
        }
    }
    $final = array();
    foreach ($query as $q) {
        if ($q == ':' && count($final) == 1) { // special case
            $final[0] .= $q;
            continue;
        }
        $final[] = $q;
    }
    return $final;
}

/******** LANGUAGE & LAYOUT *********/

function applyToCode($html, $all_defs) {
    foreach ($all_defs as $name => $content) {
        $content = addcslashes($content, '\\$'); // this is escaping the $ in the string
        $html = preg_replace('/\<:'.$name.'\/\>/', $content, $html);
    }
	
    return $html;
}

function cleanUpCode($html) {
    // clean up before she comes... living in a dusty town...
    return preg_replace('/\<:(.*)\/\>/', "", $html);
}

/******** TOOLS ************/

function trimLower ($str) {
 	return strtolower(trim($str));
}

function jsOut($str = "") {
    return addslashes(preg_replace('/(\r\n|\n|\r)/', '<br>', $str));
}

function htmlOut ($str = "") {
    return nl2br($str); // just output in html
}

function linkOut ($urlpage = "", $get_args = array()) {
    $url = rawurlencode($urlpage);
    if (! empty($get_args)) {
        $url .= "?";
        foreach ($get_args as $key => $value) 
            $url .= $key . "=" . urlencode($value);
    }
	
    return $url;
}

function queryOut($str = "", $link = NULL) {
    global $_;
    if ($link == NULL)
        $link = $_("link");
    return mysqli_real_escape_string($link, $str);
}
