<?php

require_once("User.php");
require_once("Users.php");

class UserTest extends PHPUnit_Framework_TestCase {
	
	private $users;
	
	public function setUp() {
		if (!defined("TEST")) {
			define("TEST", true);
		}
		$this->users = new Users();
	}
	
	public function tearDown() {
		if (is_file("users-test")) {
			unlink("users-test");
		}
	}
	
    /**
     * @test
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Bad email
     */
    public function cant_creates_new_user_with_incorrect_email() {
		new User("email", "wedding_link", "name");
    }
    
    /**
     * @test
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Bad wedding_link
     */
    public function cant_creates_new_user_with_null_wedding_link() {
		new User("email@provider.com", null, "name");
    }
    
	/**
     * @test
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Bad wedding_link
     */
    public function cant_creates_new_user_with_too_long_wedding_link() {
		new User("NAME@PROVIDER.COM", "wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link", "name");
    }
    
    /**
     * @test
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Bad name
     */
    public function cant_creates_new_user_with_empty_name() {
    	new User("name.surname@provider.com", "wedding_link", "");
    }
    
    /**
     * @test
     */
    public function update_infos() {
    	$user = new User("sebastian.lemerdy@gmail.com", "Frère de Laurent", "Sébastian");
    	$user->setWeddingLink("Groom's big brother")->setName("Sébas.")->setWave(1);
        $this->assertEquals($user->getEmail(), "sebastian.lemerdy@gmail.com");
        $this->assertEquals($user->getWeddingLink(), "Groom's big brother");
        $this->assertEquals($user->getName(), "Sébas.");
        $this->assertEquals($user->getWave(), 1);
    }
    
}

?>