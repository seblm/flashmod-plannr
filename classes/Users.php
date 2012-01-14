<?php

require_once("User.php");

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
		$this->checkUrlParameters($urlParameters);
		return $this->users[$urlParameters["token"]];
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
			if ($this->getUserByEmail($email) !== null) {
				throw new InvalidArgumentException("Email already exists");
			}
		}	
	}
	
	private function checkUrlParameters($urlParameters) {
		if (!array_key_exists("token", $urlParameters) || strlen($urlParameters["token"]) != 16) {
			throw new InvalidArgumentException("Bad token");
		}
		if (!array_key_exists($urlParameters["token"], $this->users)) {
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
	
}

?>