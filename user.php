<?php

require_once("init.php");

$returnScript = "inscription";

if (isset($_POST["action"])) {
	$action = $_POST["action"];
	try {
		if ($action == "updateWave") {
			$wave = (int) $_POST["wave"];
			$user->setWave($wave);
			$users->saveUsers();
		} else if ($action == "Mettre à jour mes informations") {
			$user->setName($_POST["name"]);
			$user->setWeddingLink($_POST["weddingLink"]);
			$users->saveUsers();
		} else if ($action == "Inviter") {
			$returnScript = "add-a-friend";
			$newToken = $users->createUser($_POST["email"], $_POST["weddingLink"], $_POST["name"]);
			if (mail(
				$_POST["name"] . "<" . $_POST["email"] . ">",
				$user->getName() . " vous a invité à participer au flashmob secret du mariage de Laurent & Camille",
				"Vous recevez ce message car " . $user->getName() . " vous a invité à participer au flashmob SECRET du mariage de Laurent & Camille\n" .
				"Pour avoir plus de détails et pour pouvoir vous entraîner, il vous suffit de cliquer sur le lien ci-dessous :\n" .
				getRealURL() . "/index.php?token=" . $newToken . "\n\n" .
				"ATTENTION : ce lien vous est uniquement destiné et ne doit pas être communiqué à quiconque, et surtout pas à Camille & Laurent",
				"From: " . $user->getName() . " <" . $user->getEmail() . ">\r\n" .
				"Bcc: Sébastian Le Merdy <sebastian.lemerdy@gmail.com>\r\n"
			)) {
				$_SESSION["infoMessage"] = "Un email a été envoyé à " . $_POST["name"] . ".";
			} else {
				$_SESSION["errorMessage"] =
					"Une erreur s'est produite lors de l'envoi du mail : " .
					"communiquez à <a href=\"mailto:" . $_POST["name"] . "<" . $_POST["email"] . "\">" . $_POST["name"] . "</a> " .
					"son adresse d'accès au site : " . getRealURL() . "/index.php?token=" . $newToken;
			}
			$users->saveUsers();
		}
	} catch (Exception $e) {
		$_SESSION["errorMessage"] = $e->getMessage();
	}
}

header("Location: " . getRealURL() . "/$returnScript.php?token=" . $token);

?>