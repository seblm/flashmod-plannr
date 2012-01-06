<?php

if (!isset($_GET["token"])) {
	unauthorize();
}

$users = array(
	"JKi7IbcSBQmA71jB" => "sebastian.lemerdy@gmail.com",
);

if (!array_key_exists($_GET["token"], $users)) {
	unauthorize();
}

function unauthorize() {
	header("HTTP/1.1 401 Unauthorized");
	die("Unauthorized");
}
?>