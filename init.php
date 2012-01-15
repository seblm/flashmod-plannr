<?php

require_once("classes/Users.php");
require_once("classes/User.php");

function unauthorize() {
	header("HTTP/1.1 401 Unauthorized");
	die("Unauthorized");
}

function getRealURL() {
	$url = "http://" . $_SERVER["SERVER_NAME"];
	if ($_SERVER["SERVER_PORT"] != "80") {
		$url .= ":" . $_SERVER["SERVER_PORT"];
	}
	$lastPositionOfSlash = strrpos($_SERVER["SCRIPT_NAME"], '/');
	$url .= substr($_SERVER["SCRIPT_NAME"], 0, strlen($_SERVER["SCRIPT_NAME"]) - $lastPositionOfSlash + 2);
	return $url;
}

session_start();

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
	unauthorize();
}

date_default_timezone_set("Europe/Paris");
require_once("lib/Smarty-2.6.26/Smarty.class.php");
$smarty = new Smarty();
$smarty->register_object("user", $user);

?>