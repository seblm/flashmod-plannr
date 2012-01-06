<?php

if (!isset($_GET["token"])) {
	unauthorize();
}

$users = array(
	"JKi7IbcSBQmA71jB" => array(
		email => "sebastian.lemerdy@gmail.com",
		lien_maries => "Frère de Laurent",
	),
);

if (!array_key_exists($_GET["token"], $users)) {
	unauthorize();
}

function unauthorize() {
	header("HTTP/1.1 401 Unauthorized");
	die("Unauthorized");
}

?>