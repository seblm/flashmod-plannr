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
	
	public function getWeddingLink() {
		return $this->weddingLink;
	}
	
	public function setWeddingLink($weddingLink) {
		$this->check($weddingLink, User::WEDDING_LINK);
		$this->weddingLink = $weddingLink;
		return $this;
	}

	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
		$this->check($name, User::NAME);
		$this->name = $name;
		return $this;
	}
	
	public function getWave() {
		return $this->wave;
	}

	public function setWave($wave) {
		if (($wave >= 1 && $wave <= 5) || $wave === null) {
			$this->wave = $wave;
			return $this;
		}
		throw new InvalidArgumentException("Bad wave");
	}
	
	public function getEmail() {
		return $this->email;
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