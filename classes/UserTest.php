<?php

require_once("User.php");

class StackTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @test
	 * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Bad token
	 */
    public function should_not_check_inhexisting_user() {
    	$user = new User(array());
    }
    
	/**
	 * @test
	 * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Bad token
	 */
    public function should_not_check_unkown_user() {
    	$user = new User(array("token" => "unkown-token"));
    }
    
    /**
     * @test
     */
    public function should_check_and_retrieve_existing_user() {
        $user = new User(array("token" => "JKi7IbcSBQmA71jB"));
        $user = $user->getUser();
        $this->assertEquals($user[User::EMAIL], "sebastian.lemerdy@gmail.com");
        $this->assertEquals($user[User::WEDDING_LINK], "Frère de Laurent");
        $this->assertEquals($user[User::NAME], "Sébastian");
        $this->assertNull($user[User::WAVE]);
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
		new User("sebastian.lemerdy@gmail.com", null, "name");
    }
    
	/**
     * @test
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Bad wedding_link
     */
    public function cant_creates_new_user_with_too_long_wedding_link() {
		new User("sebastian.lemerdy@gmail.com", "wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link wedding_link", "name");
    }
    
    /**
     * @test
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Bad name
     */
    public function cant_creates_new_user_with_empty_name() {
    	new User("sebastian.lemerdy@gmail.com", "wedding_link", "");
    }
    
    /**
     * test (disabled because we have to handle that email already exists into user's list and then set $token)
     */
    public function update_infos() {
    	// TODO
    	$user = new User("sebastian.lemerdy@gmail.com", "Groom's brother", "Sébastian");
    	$user->setWeddingLink("Groom's big brother")->setName("Sébas.")->setWave(1)->save();
    	$user = new User(array("token" => "JKi7IbcSBQmA71jB"));
        $user = $user->getUser();
        $this->assertEquals($user[User::EMAIL], "sebastian.lemerdy@gmail.com");
        $this->assertEquals($user[User::WEDDING_LINK], "Groom's big brother");
        $this->assertEquals($user[User::NAME], "Sébas.");
        $this->assertEquals($user[User::WAVE], 1);
    }
    
}

?>