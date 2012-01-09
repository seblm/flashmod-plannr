<?php

require_once("User.php");

class StackTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @test
	 */
    public function should_not_check_inhexisting_user() {
    	$user = new User(array());
        $this->assertFalse($user->checkUser());
    }
    
	/**
	 * @test
	 */
    public function should_not_check_unkown_user() {
    	$user = new User(array("token" => "unkown-token"));
        $this->assertFalse($user->checkUser());
    }
    
    /**
     * @test
     */
    public function should_check_and_retrieve_existing_user() {
        $user = new User(array("token" => "JKi7IbcSBQmA71jB"));
        $this->assertTrue($user->checkUser());
        $user = $user->getUser();
        $this->assertEquals($user["email"], "sebastian.lemerdy@gmail.com");
        $this->assertEquals($user["wedding_link"], "Frère de Laurent");
        $this->assertEquals($user["name"], "Sébastian");
    }
    
}

?>