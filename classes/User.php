<?php
class User {
	
	const EMAIL = "email";
	const WEDDING_LINK = "wedding_link";
	const NAME = "name";
	const WAVE = "wave";
	
	private $users = array(
		"JKi7IbcSBQmA71jB" => array(
			User::EMAIL => "sebastian.lemerdy@gmail.com",
			User::WEDDING_LINK => "Frère de Laurent",
			User::NAME => "Sébastian",
			User::WAVE => null,
		),
	);
	
	private $token;
	
	public function __construct($variablesFromUrlOrEmail, $weddingLink = null, $name = null) {
		if (is_array($variablesFromUrlOrEmail)) {
			$this->existingUser($variablesFromUrlOrEmail);
		} else {
			$this->newUser($variablesFromUrlOrEmail, $weddingLink, $name);
		}
	}
	
	public function getUser() {
		return $this->users[$this->token];
	}
	
	public function setWeddingLink($weddingLink) {
		$this->check($weddingLink, User::WEDDING_LINK);
		$this->users[$this->token][User::WEDDING_LINK] = $weddingLink;
		return $this;
	}

	public function setName($name) {
		$this->check($name, User::NAME);
		$this->users[$this->token][User::NAME] = $name;
		return $this;
	}

	public function setWave($wave) {
		if ($wave !== null && !is_int($wave) || $wave < 0 || $wave > 4) {
			throw new InvalidArgumentException("Bad wave");
		}
		$this->users[$this->token][User::WAVE] = $wave;
		return $this;
	}
	
	public function save() {
		// TODO
	}

	private function existingUser($variablesFromUrl) {
		if (!array_key_exists("token", $variablesFromUrl) || strlen($variablesFromUrl["token"]) != 16) {
			throw new InvalidArgumentException("Bad token");
		}
		$this->token = $variablesFromUrl["token"];
	}
	
	private function newUser($email, $weddingLink, $name) {
		if (preg_match("/^[a-zA-Z0-9]+[a-zA-Z0-9\._-]*@[a-zA-Z0-9_-]+([a-zA-Z0-9\._-]+)+$/", $email) != 1) {
			throw new InvalidArgumentException("Bad email");
		}
		$this->check($email, User::EMAIL);
		$this->check($weddingLink, USER::WEDDING_LINK);
		$this->check($name, User::NAME);
	}
	
	private function check($value, $type) {
		if ($value === null || strlen($value) == 0 || strlen($value) > 256) {
			throw new InvalidArgumentException("Bad " . $type);
		}
	}

}
?>