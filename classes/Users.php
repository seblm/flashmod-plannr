<?php

require_once("classes/User.php");

class Users {
	
	private static $FORBIDDEN_EMAILS = array(
		"laurent.le-merdy@laposte",
		"laurentlemerdy@hotmail.com",
		"camille_preco@hotmail.com",
	);
	private static $ADMIN_TOKEN = "JKi7IbcSBQmA71jB";
	
	private $users;

	public function Users() {
		$this->loadUsers();
	}
	
	public function retrieveUser($token) {
		$this->checkToken($token);
		return $this->users[$token];
	}
	
	public function createUser($email, $weddingLink, $name) {
		$token = $this->generatesToken();
		if ($this->users != null) {
			while (array_key_exists($token, $this->users)) {
				$token = $this->generatesToken();
			}
		}
		$this->users[$token] = new User($email, $weddingLink, $name, array($this, "checkNewEmail"));
		return $token;
	}
	
	public function deleteUser($token) {
		$this->checkToken($token);
		if ($token == Users::$ADMIN_TOKEN) {
			throw new InvalidArgumentException("Can't delete admin user");
		}
		$deletedUser = $this->users[$token];
		unset($this->users[$token]);
		return $deletedUser;
	}
	
	public function checkNewEmail($email) {
		$this->checkEmailForbidden($email);
		$this->checkExistingUser($email);
	}
	
	public function saveUsers() {
		$serialized = serialize($this->users);
		$handle = Users::openFile(false);
		fwrite($handle, $serialized);
		fclose($handle);
	}
	
	public function getUserNamesByWave() {
		$userNamesByWave = array();
		for ($i = 0; $i < 5; $i++) {
			$userNamesByWave[$i] = array();
		}
		foreach ($this->users as $user) {
			if ($user->getWave() !== null) {
				array_push($userNamesByWave[$user->getWave()], $user->getName());
			}
		}
		for ($i = 0; $i < 5; $i++) {
			if (count($userNamesByWave[$i]) > 1) {
				sort($userNamesByWave[$i]);
			}
		}
		return $userNamesByWave;
	}
	
	private function loadUsers() {
		if (is_file(Users::getFileName())) {
			$handle = Users::openFile();
			$serialized = fread($handle, 100000);
			fclose($handle);
			$this->users = unserialize($serialized);
		} else {
			$this->users = array(Users::$ADMIN_TOKEN => new User("sebastian.lemerdy@gmail.com", "Frère de Laurent", "Sébastian"));
			$this->saveUsers();
		}
	}
	
	private function checkEmailForbidden($email) {
		if (in_array($email, Users::$FORBIDDEN_EMAILS)) {
			throw new InvalidArgumentException("Email is forbidden");
		}
	}
	
	private function checkExistingUser($email) {
		if ($this->users !== null && !empty($this->users)) {
			if ($this->getUserByEmail($email) !== null) {
				throw new InvalidArgumentException("Email already exists");
			}
		}	
	}
	
	private function checkToken($token) {
		if ($token === null || !is_string($token) || preg_match("/[a-zA-Z0-9]{16}/", $token) != 1) {
			throw new InvalidArgumentException("Bad token");
		}
		if (!array_key_exists($token, $this->users)) {
			throw new InvalidArgumentException("User doesn't exists");
		}
	}
	
	private function getUserByEmail($email) {
		foreach ($this->users as $token => $user) {
			if ($user->getEmail() == $email) {
				return $user;
			}
		}
	}
	
	private function generatesToken() {
		return substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789", 16)), 0, 16);
	}
	
	private static function openFile($readOnly = true) {
		if ($readOnly) {
			return fopen(Users::getFileName(), "r");
		}
		return fopen(Users::getFileName(), "w");
	}
	
	private static function getFileName() {
		if (defined("TEST")) {
			return "data/users-test";
		}
		return "data/users";
	}
	
}

?>