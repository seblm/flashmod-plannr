<?php

require_once("classes/User.php");

function unauthorize() {
	header("HTTP/1.1 401 Unauthorized");
	die("Unauthorized");
}

$user = new User($_GET);

if (!$user->checkUser()) {
	unauthorize();
}

date_default_timezone_set("Europe/Paris");

require_once("lib/Smarty-2.6.26/Smarty.class.php");

$smarty = new Smarty();

$smarty->assign("user", $user->getUser());

?>