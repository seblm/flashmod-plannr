<?php

require_once("init.php");

if (isset($_POST["action"])) {
	$action = $_POST["action"];
	try {
		if ($action == "updateWave") {
			$wave = (int) $_POST["wave"];
			$user->setWave($wave);
			$users->saveUsers();
		} else if ($action = "Mettre à jour mes informations") {
			$user->setName($_POST["name"]);
			$user->setWeddingLink($_POST["weddingLink"]);
			$users->saveUsers();
		}
	} catch (Exception $e) {
		$_SESSION["errorMessage"] = $e->getMessage();
	}
}

header("Location: " . getRealURL() . "/inscription.php?token=" . $token);

?>