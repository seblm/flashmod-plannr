<?php

class Users {
	
	private static $FORBIDDEN_EMAILS = array(
		"laurent.le-merdy@laposte",
		"laurentlemerdy@hotmail.com",
		"camille_preco@hotmail.com",
	);
	
	private $users;

	public function Users() {
		$this->users = array(
			"JKi7IbcSBQmA71jB" => new User(
					"sebastian.lemerdy@gmail.com",
					"Frère de Laurent",
					"Sébastian"
			),
		);
	}
	
	public function retrieveUser($urlParameters) {
		if (!array_key_exists("token", $urlParameters) || strlen($urlParameters["token"]) != 16) {
			throw new InvalidArgumentException("Bad token");
		}
		if (!array_key_exists($urlParameters["token"], $this->users)) {
			throw new InvalidArgumentException("User doesn't exists");
		}
		return $this->users[$urlParameters["token"]];
	}
	
	public function createUser($email, $weddingLink, $name) {
		$user = new User($email, $weddingLink, $name, array($this, "checkNewEmail"));
	}
	
	public function checkNewEmail($email) {
		$this->checkEmailForbidden($email);
		$this->checkExistingUser($email);
	}
	
	private function checkEmailForbidden($email) {
		if (in_array($email, Users::$FORBIDDEN_EMAILS)) {
			throw new InvalidArgumentException("Email is forbidden");
		}
	}
	
	private function checkExistingUser($email) {
		if ($this->users !== null && !empty($this->users)) {
			foreach ($this->users as $token => $user) {
				$userValues = $user->getUser();
				if ($userValues[User::EMAIL] == $email) {
					throw new InvalidArgumentException("Email already exists");
				}
			}
		}	
	}
	
}

?>