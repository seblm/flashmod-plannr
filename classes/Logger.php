<?php

require_once("classes/User.php");
require_once("classes/Users.php");

class Logger {
	
	public static function log($user, $db) {
		try {
			Logger::createTableIfNeeded($db);
			if (Users::$ADMIN_EMAIL != $user->getEmail()) {
				Logger::logAccess($user, $db);
			}
		} catch (PDOException $e) {
		}
	}
	
	private static function createTableIfNeeded($db) {
		$statement = $db->query("SELECT COUNT(*) FROM sqlite_master WHERE type='table' AND name='access_log'");
		$result = $statement->fetch();
		if ($result[0] == 0) {
			$db->exec("CREATE TABLE access_log (" .
					"date TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP, " .
					"email TEXT NOT NULL REFERENCES users (email), " .
					"page TEXT NOT NULL)");
		}
	}
	
	private static function logAccess($user, $db) {
		$statement = $db->prepare("INSERT INTO access_log (email, page) values (:email, :page)");
		$statement->execute(array(
				':email' => $user->getEmail(),
				':page' => $_SERVER["SCRIPT_NAME"]
		));
	}
	
}