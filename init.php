<?php

function unauthorize() {
	header("HTTP/1.1 401 Unauthorized");
	die("Unauthorized");
}

if (!isset($_GET["token"])) {
	unauthorize();
}

$users = array(
	"JKi7IbcSBQmA71jB" => array(
		"email" => "sebastian.lemerdy@gmail.com",
		"lien_maries" => "Frère de Laurent",
		"nom" => "Sébastian,"
	),
);

if (!array_key_exists($_GET["token"], $users)) {
	unauthorize();
}

date_default_timezone_set("Europe/Paris");

require_once("lib/Smarty-2.6.26/Smarty.class.php");

$smarty = new Smarty();

?>