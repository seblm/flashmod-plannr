<?php

class User {
	
	const EMAIL = "email";
	const WEDDING_LINK = "wedding_link";
	const NAME = "name";
	const WAVE = "wave";
	
	private $weddingLink;
	private $name;
	private $wave;
	private $email;
	
	public function User($email, $weddingLink, $name, $checkExistingUserCallback = null) {
		$this->setEmail($email, $checkExistingUserCallback);
		$this->setWeddingLink($weddingLink);
		$this->setName($name);
	}
	
	public function getUser() {
		return array(
			User::EMAIL => $this->email,
			User::WEDDING_LINK => $this->weddingLink,
			User::NAME => $this->name,
			User::WAVE => $this->wave,
		);
	}
	
	public function setWeddingLink($weddingLink) {
		$this->check($weddingLink, User::WEDDING_LINK);
		$this->weddingLink = $weddingLink;
		return $this;
	}

	public function setName($name) {
		$this->check($name, User::NAME);
		$this->name = $name;
		return $this;
	}

	public function setWave($wave) {
		if ($wave !== null && !is_int($wave) || $wave < 0 || $wave > 4) {
			throw new InvalidArgumentException("Bad wave");
		}
		$this->wave = $wave;
		return $this;
	}
	
	private function setEmail($email, $checkExistingUserCallback) {
		if (preg_match("/^[a-zA-Z0-9]+[a-zA-Z0-9\._-]*@[a-zA-Z0-9_-]+([a-zA-Z0-9\._-]+)+$/", $email) != 1) {
			throw new InvalidArgumentException("Bad email");
		}
		$this->check($email, User::EMAIL);
		if ($checkExistingUserCallback !== null) {
			call_user_func($checkExistingUserCallback, $email);
		}
		$this->email = $email;
	}
	
	private function check($value, $type) {
		if ($value === null || strlen($value) == 0 || strlen($value) > 256) {
			throw new InvalidArgumentException("Bad " . $type);
		}
	}

}
?>