<?php

require_once("classes/User.php");

class Users {
	
	private static $FORBIDDEN_EMAILS = array(
		"laurent.le-merdy@laposte.net",
		"laurentlemerdy@hotmail.com",
		"camille_preco@hotmail.com",
	);
	public static $ADMIN_TOKEN = "JKi7IbcSBQmA71jB";
	
	private $users;
	
	private $db;

    public function Users($db) {
		$this->db = $db;
		$this->loadUsers();
	}
	
	public function retrieveUser($token) {
		$this->checkToken($token);
		return $this->users[$token];
	}
	
	public function retrieveUserAndTokenByEmail($email) {
		if ($this->users !== null && !empty($this->users)) {
			$userAndToken = $this->getUserAndTokenByEmail($email);
			if ($userAndToken === null) {
				throw new InvalidArgumentException("Email is unknown");
			}
			return $userAndToken;
		}
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
	
	public function saveUsers() {
		try {
			$this->db->beginTransaction();
			$this->db->exec("DELETE FROM users");
			$statement = $this->db->prepare("INSERT INTO users VALUES (:token, :name, :email, :weddingLink, :wave)");
			foreach ($this->users as $token => $user) {
				$statement->execute(array(
						':token' => $token,
						':name' => $user->getName(),
						':email' => $user->getEmail(),
						':weddingLink' => $user->getWeddingLink(),
						':wave' => $user->getWave()
				));
			}
			$this->db->commit();
		} catch (PDOException $e) {
			$this->db->rollback();
		}
		return $this;
	}
	
	public function checkNewEmail($email) {
		$this->checkEmailForbidden($email);
		$this->checkExistingUser($email);
	}
	
	public function removeUserFromWaves($user) {
		$this->checkUser($user);
		$user->setWave(null);
		return $this;
	}
	
	public function putUserOnWave($user, $wave) {
		$this->checkUser($user, $wave);
		if ($wave < 1 || $wave > 5 || $wave === null) {
			throw new InvalidArgumentException("Bad wave");
		}
		if (!in_array($wave, $this->getAvailableWaves())) {
			throw new InvalidArgumentException("Wave $wave is full");
		}
		$user->setWave($wave);
		return $this;
	}
	
	public function getAvailableWaves() {
		$userNamesByWave = $this->getUserNamesByWave();
		$nbUsersByWave = array_map("count", $userNamesByWave);
		$nbUsers = array_sum($nbUsersByWave);
		$maxNbOfUsers = floor($nbUsers / 2) + 1;
		$availableWaves = array();
		
		if ($nbUsersByWave[1] < 2) {
			array_push($availableWaves, 1);
		}
		for ($i = 2; $i <= 5; $i++) {
			if ($nbUsersByWave[$i] < $maxNbOfUsers) {
				array_push($availableWaves, $i);
			}
		}
		
		return $availableWaves;
	}
	
	public function getUserNamesByWave() {
		$userNamesByWave = array();
		for ($i = 0; $i <= 5; $i++) {
			$userNamesByWave[$i] = array();
		}
		foreach ($this->users as $user) {
			$wave = $user->getWave();
			if ($wave === null) {
				$wave = 0;
			}
			array_push($userNamesByWave[$wave], $user->getName());
		}
		for ($i = 0; $i <= 5; $i++) {
			if (count($userNamesByWave[$i]) > 1) {
				sort($userNamesByWave[$i]);
			}
		}
		return $userNamesByWave;
	}
	
	private function loadUsers() {
		$this->users = array();
		try {
			$statement = $this->db->query("SELECT COUNT(*) FROM sqlite_master WHERE type='table' AND name='users'");
			$result = $statement->fetch();
			if ($result[0] == 0) {
				$this->db->exec("CREATE TABLE users (" .
						"token TEXT PRIMARY KEY, " .
						"name TEXT NOT NULL, " .
						"email TEXT UNIQUE NOT NULL, " .
						"weddingLink TEXT NOT NULL, " .
						"wave INTEGER DEFAULT NULL)");
			}
			foreach ($this->db->query("SELECT * FROM users") as $row) {
				$this->users[$row["token"]] = new User($row["email"], $row["weddingLink"], $row["name"]);
				if (isset($row["wave"])) {
					$this->putUserOnWave($this->users[$row["token"]], $row["wave"]);
				}
			}
			if (count($this->users) == 0) {
				$this->users[Users::$ADMIN_TOKEN] = new User("sebastian.lemerdy@gmail.com", "Frère de Laurent", "Sébastian");
				$this->saveUsers();
			}
		} catch (PDOException $e) {
		}
	}
	
	private function checkEmailForbidden($email) {
		if (in_array($email, Users::$FORBIDDEN_EMAILS)) {
			throw new InvalidArgumentException("Email is forbidden");
		}
	}
	
	private function checkExistingUser($email) {
		if ($this->users !== null && !empty($this->users)) {
			if ($this->getUserAndTokenByEmail($email) !== null) {
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
	
	private function checkUser($user, $wave = null) {
		if ($user === null) {
			throw new InvalidArgumentException("Can't put null user on wave $wave");
		}
	}
	
	private function getUserAndTokenByEmail($email) {
		foreach ($this->users as $token => $user) {
			if ($user->getEmail() === $email) {
				return array(
					"token" => $token,
					"user" => $user,
				);
			}
		}
	}
	
	private function generatesToken() {
		return substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789", 16)), 0, 16);
	}
	
}

?>