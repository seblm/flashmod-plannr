<?php

require_once("classes/User.php");

class UserTest extends PHPUnit_Framework_TestCase {
	
	private $users;
	
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
        $this->assertEquals("sebastian.lemerdy@gmail.com", $user->getEmail());
        $this->assertEquals("Groom's big brother", $user->getWeddingLink());
        $this->assertEquals("Sébas.", $user->getName());
        $this->assertEquals(1, $user->getWave());
    }
    
    /**
     * @test
     */
    public function can_set_wave_with_string() {
    	$user = new User("sebastian.lemerdy@gmail.com", "Frère de Laurent", "Sébastian");
    	$user->setWave("1");
    	$this->assertEquals(1, $user->getWave());
    }
    
    /**
     * @test
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Bad wave
     */
    public function cant_set_wave_lower_than_minimum() {
    	$user = new User("sebastian.lemerdy@gmail.com", "Frère de Laurent", "Sébastian");
    	$user->setWave(0);
    }
    
    /**
     * @test
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Bad wave
     */
    public function cant_set_wave_upper_than_maximum() {
    	$user = new User("sebastian.lemerdy@gmail.com", "Frère de Laurent", "Sébastian");
    	$user->setWave(6);
    }
    
    /**
     * @test
     */
    public function should_set_null_wave() {
    	$user = new User("sebastian.lemerdy@gmail.com", "Frère de Laurent", "Sébastian");
    	$user->setWave(null);
    	$this->assertNull($user->getWave());
    }
    
}

?>