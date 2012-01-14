<?php

require_once("User.php");
require_once("Users.php");

class UsersTest extends PHPUnit_Framework_TestCase {
	
	private $users;
	
	public function setUp() {
		$this->users = new Users();
	}
	
	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 * @expectedExceptionMessage Bad token
	 */
	public function should_not_retrieve_user_without_token() {
		$this->users->retrieveUser(array());
	}
	
	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 * @expectedExceptionMessage Bad token
	 */
	public function should_not_retrieve_unkown_user() {
		$this->users->retrieveUser(array("token" => "unkown-token"));
	}
	
	/**
	 * @test
	 */
	public function should_retrieve_existing_user() {
		$user = $this->users->retrieveUser(array("token" => "JKi7IbcSBQmA71jB"));
		$this->assertNotNull($user);
		$this->assertEquals($user->getEmail(), "sebastian.lemerdy@gmail.com");
		$this->assertEquals($user->getWeddingLink(), "Frère de Laurent");
		$this->assertEquals($user->getName(), "Sébastian");
		$this->assertNull($user->getWave());
	}
	
	/**
	 * @test
	 * @expectedException        InvalidArgumentException
	 * @expectedExceptionMessage Email already exists
	 */
	public function cant_creates_new_user_with_existing_email() {
		$this->users->createUser("sebastian.lemerdy@gmail.com", "Groom's broher", "Sébastian");
	}
	
    /**
     * @test
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Email is forbidden
     */
    public function cant_creates_new_user_with_forbidden_email_laurent() {
    	$this->users->createUser("laurent.le-merdy@laposte", "Groom", "Laurent");
    }

    /**
     * @test
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Email is forbidden
     */
    public function cant_creates_new_user_with_forbidden_email_laurent2() {
    	$this->users->createUser("laurentlemerdy@hotmail.com", "Groom", "Laurent");
    }
    
    /**
     * @test
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Email is forbidden
     */
    public function cant_creates_new_user_with_forbidden_email_camille() {
    	$this->users->createUser("camille_preco@hotmail.com", "Bride", "Camille");
    }
    
}

?>