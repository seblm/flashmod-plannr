<?php

require_once("classes/User.php");
require_once("classes/Users.php");

class UsersTest extends PHPUnit_Framework_TestCase {
	
	private $users;
	
	public function setUp() {
		if (!defined("TEST")) {
			define("TEST", true);
		}
		$this->users = new Users();
	}
	
	public function tearDown() {
		if (is_file("data/users-test")) {
			unlink("data/users-test");
		}
	}
	
	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 * @expectedExceptionMessage Bad token
	 */
	public function should_not_retrieve_user_without_token() {
		$this->users->retrieveUser(null);
	}
	
	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 * @expectedExceptionMessage Bad token
	 */
	public function should_not_retrieve_user_with_incorrect_token() {
		$this->users->retrieveUser("incorrect_token");
	}
	
	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 * @expectedExceptionMessage User doesn't exists
	 */
	public function should_not_retrieve_unkown_user() {
		$this->users->retrieveUser("tokenWith16chars");
	}
	
	/**
	 * @test
	 */
	public function should_retrieve_existing_user() {
		$user = $this->users->retrieveUser("JKi7IbcSBQmA71jB");
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
    	$this->users->createUser("laurent.le-merdy@laposte.net", "Groom", "Laurent");
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
    
    /**
     * @test
     */
    public function should_save_user() {
    	$user = $this->users->retrieveUser("JKi7IbcSBQmA71jB")
    		->setWeddingLink("Groom's big brother")->setName("Sébas.")->setWave(1);
    	
    	$this->users->saveUsers();
        $this->users = new Users();
        
    	$user = $this->users->retrieveUser("JKi7IbcSBQmA71jB");
        $this->assertEquals($user->getEmail(), "sebastian.lemerdy@gmail.com");
        $this->assertEquals($user->getWeddingLink(), "Groom's big brother");
        $this->assertEquals($user->getName(), "Sébas.");
        $this->assertEquals($user->getWave(), 1);
    }
    
    /**
     * @test
     */
    public function should_creates_and_save_new_user() {
    	$token = $this->users->createUser("new-user@provider.com", "wedlink", "myname");
    	
    	$this->users->saveUsers();
    	$this->users = new Users();
    	
    	$this->assertTrue($token != "JKi7IbcSBQmA71jB", "A new token must have been generated.");
    	$this->assertRegExp("/[a-zA-Z0-9]{16}/", $token);
    	$user = $this->users->retrieveUser($token);
    	$this->assertEquals($user->getEmail(), "new-user@provider.com");
    	$this->assertEquals($user->getWeddingLink(), "wedlink");
    	$this->assertEquals($user->getName(), "myname");
    	$this->assertNull($user->getWave());
    }
    
    /**
     * @test
     */
    public function should_deletes_user() {
    	$token = $this->users->createUser("new-user@provider.com", "wedlink", "myname");
    	$deletedUser = $this->users->deleteUser($token);
    	
    	try {
    		$this->users->retrieveUser($token);
    		$this->fail();
    	} catch (Exception $e) {
    		$this->assertThat($e, new PHPUnit_Framework_Constraint_Exception("InvalidArgumentException"));
    		$this->assertThat($e, new PHPUnit_Framework_Constraint_ExceptionMessage("User doesn't exists"));
    	}
    	$this->assertEquals($deletedUser->getEmail(), "new-user@provider.com");
    	$this->assertEquals($deletedUser->getWeddingLink(), "wedlink");
    	$this->assertEquals($deletedUser->getName(), "myname");
    	$this->assertNull($deletedUser->getWave());
    }
    
    /**
     * @test
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Can't delete admin user
     */
    public function cant_deletes_admin_user() {
    	$this->users->deleteUser("JKi7IbcSBQmA71jB");
    }
    
    /**
     * @test
     */
    public function should_retrieve_user_names_by_wave() {
    	$token = $this->users->createUser("wave1-2@provider.com", "unkown", "wave1-2");
    	$this->users->retrieveUser($token)->setWave(0);
    	$token = $this->users->createUser("wave1@provider.com", "unkown", "wave1");
    	$this->users->retrieveUser($token)->setWave(0);
    	$token = $this->users->createUser("wave2@provider.com", "unkown", "wave2");
    	$this->users->retrieveUser($token)->setWave(1);
    	$token = $this->users->createUser("wave4@provider.com", "unkown", "wave4");
    	$this->users->retrieveUser($token)->setWave(3);
    	$token = $this->users->createUser("wave5@provider.com", "unkown", "wave5");
    	$this->users->retrieveUser($token)->setWave(4);
    	
    	$userNamesByWave = $this->users->getUserNamesByWave();
    	
    	$this->assertCount(5, $userNamesByWave);
    	$this->assertCount(2, $userNamesByWave[0]);
    	$this->assertEquals($userNamesByWave[0], array("wave1", "wave1-2"));
    	$this->assertCount(1, $userNamesByWave[1]);
    	$this->assertEmpty($userNamesByWave[2]);
    	$this->assertCount(1, $userNamesByWave[3]);
    	$this->assertEquals($userNamesByWave[3], array("wave4"));
    	$this->assertCount(1, $userNamesByWave[4]);
    	$this->assertEquals($userNamesByWave[4], array("wave5"));
    }

}

?>