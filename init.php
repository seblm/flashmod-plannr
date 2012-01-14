<?php

require_once("classes/Users.php");

function unauthorize() {
	header("HTTP/1.1 401 Unauthorized");
	die("Unauthorized");
}

$users = new Users();

try {
	$user = $users->retrieveUser($_GET);
} catch (InvalidArgumentException $e) {
	unauthorize();
}

date_default_timezone_set("Europe/Paris");

require_once("lib/Smarty-2.6.26/Smarty.class.php");

$smarty = new Smarty();

$smarty->register_object("user", $user);

?>