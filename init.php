<?php

require_once("classes/Users.php");
require_once("classes/User.php");
require_once("lib/Smarty-2.6.26/Smarty.class.php");

function unauthorize($smarty) {
	header("HTTP/1.1 401 Unauthorized");
	$smarty->display("unauthorized.tpl");
	$_SESSION = array();
	exit;
}

function getRealURL() {
	$url = "http://" . $_SERVER["SERVER_NAME"];
	if ($_SERVER["SERVER_PORT"] != "80") {
		$url .= ":" . $_SERVER["SERVER_PORT"];
	}
	$lastPositionOfSlash = strrpos($_SERVER["SCRIPT_NAME"], '/');
	$url .= substr($_SERVER["SCRIPT_NAME"], 0, $lastPositionOfSlash);
	return $url;
}

function imap_8bit_and_encoding($string) {
	return "=?iso-8859-1?Q?" . str_replace('%', '=', rawurlencode(utf8_decode($string))) . "?=";
}

date_default_timezone_set("Europe/Paris");
session_start();

$smarty = new Smarty();
$users = new Users();
$token = "";
if (array_key_exists("token", $_GET)) {
	$token = $_GET["token"];
} else if (array_key_exists("token", $_POST)) {
	$token = $_POST["token"];
}

try {
	$user = $users->retrieveUser($token);
} catch (InvalidArgumentException $e) {
	unauthorize($smarty);
}

$smarty->register_object("user", $user);

?>