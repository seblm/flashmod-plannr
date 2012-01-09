<?php
class User {
	
	private $users = array(
		"JKi7IbcSBQmA71jB" => array(
			"email" => "sebastian.lemerdy@gmail.com",
			"wedding_link" => "Frère de Laurent",
			"name" => "Sébastian"
		),
	);
	
	private $token;
	
	public function User($GET) {
		if (array_key_exists("token", $GET)) {
			$this->token = $GET["token"];
		}
	}

	public function checkUser() {
		return array_key_exists($this->token, $this->users);
	}
	
	public function getUser() {
		if ($this->checkUser()) {
			return $this->users[$this->token];
		}
	}

}
?>