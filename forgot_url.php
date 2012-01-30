<?php

require_once("classes/Users.php");
require_once("classes/User.php");

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

if (array_key_exists("email", $_POST)) {
	session_start();
	$users = new Users();
	try {
		$userAndToken = $users->retrieveUserAndTokenByEmail($_POST["email"]);
		if (mail(
				imap_8bit_and_encoding($userAndToken["user"]->getName()) . " <" . $userAndToken["user"]->getEmail() . ">",
				imap_8bit_and_encoding("Accès personalisé au flashmob secret du mariage de Laurent & Camille"),
				"Vous recevez ce message car nous avons reçu une demande de rappel de votre adresse personnalisée au flashmob SECRET du mariage de Laurent & Camille.\n" .
				"Vous pouvez accéder au site en cliquant sur le lien ci-dessous :\n" .
				getRealURL() . "/index.php?token=" . $userAndToken["token"] . "\n\n" .
				"ATTENTION : ce lien vous est uniquement destiné et ne doit pas être communiqué à quiconque, et surtout pas à Camille & Laurent",
				"From: " . imap_8bit_and_encoding("Sébastian Le Merdy") . " <sebastian.lemerdy@gmail.com>\r\n" .
				"Bcc: sebastian.lemerdy@gmail.com\r\n"
		)) {
			$_SESSION["infoMessage"] = "Un email a été envoyé à " . $userAndToken["user"]->getName() . ".";
		} else {
			$_SESSION["errorMessage"] = "Une erreur est survenue lors de l'envoi d'un message à " . $userAndToken["user"]->getName() . ".";
		}
	} catch (InvalidArgumentException $e) {
		$_SESSION["errorMessage"] = $e->getMessage();
	}
}

header("Location: " . getRealURL());

?>