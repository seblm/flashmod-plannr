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
		if (is_file("users-test")) {
			unlink("users-test");
		}
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
    
    /**
     * @test
     */
    public function should_save_user() {
    	$user = $this->users->retrieveUser(array("token" => "JKi7IbcSBQmA71jB"))
    		->setWeddingLink("Groom's big brother")->setName("Sébas.")->setWave(1);
    	
    	$this->users->saveUsers();
        $this->users = new Users();
        
    	$user = $this->users->retrieveUser(array("token" => "JKi7IbcSBQmA71jB"));
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
    	$user = $this->users->retrieveUser(array("token" => $token));
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
    	$deletedUser = $this->users->deleteUser(array("token" => $token));
    	
    	try {
    		$this->users->retrieveUser(array("token" => $token));
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
    	$this->users->deleteUser(array("token" => "JKi7IbcSBQmA71jB"));
    }

}

?>