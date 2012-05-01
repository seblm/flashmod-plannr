<?php

require_once("classes/User.php");
require_once("classes/Users.php");

class UsersTest extends PHPUnit_Framework_TestCase {
	
	private $users;
	
	private $db;
	
	public function setUp() {
		$this->db = new PDO("sqlite::memory:");
		$this->users = new Users($this->db);
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
		$this->assertEquals("sebastian.lemerdy@gmail.com", $user->getEmail());
		$this->assertEquals("Frère de Laurent", $user->getWeddingLink());
		$this->assertEquals("Sébastian", $user->getName());
		$this->assertNull($user->getWave());
	}
	
	/**
	 * @test
	 * @expectedException        InvalidArgumentException
	 * @expectedExceptionMessage Email is unknown
	 */
	public function should_not_retrieve_user_and_token_by_inexisting_email() {
		$this->users->retrieveUserAndTokenByEmail("inexistant");
	}
	
	/**
	 * @test
	 */
	public function should_retrieve_existing_user_and_token_by_email() {
		$userAndToken = $this->users->retrieveUserAndTokenByEmail("sebastian.lemerdy@gmail.com");
		
		$this->assertNotNull($userAndToken);
		$this->assertCount(2, $userAndToken);
		$this->assertNotNull($userAndToken["user"]);
		$this->assertEquals("sebastian.lemerdy@gmail.com", $userAndToken["user"]->getEmail());
		$this->assertEquals("Frère de Laurent", $userAndToken["user"]->getWeddingLink());
		$this->assertEquals("Sébastian", $userAndToken["user"]->getName());
		$this->assertNull($userAndToken["user"]->getWave());
		$this->assertNotNull($userAndToken["token"]);
		$this->assertEquals("JKi7IbcSBQmA71jB", $userAndToken["token"]);
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
    	$user = $this->users->retrieveUser("JKi7IbcSBQmA71jB")->setWeddingLink("Groom's big brother")->setName("Sébas.");
    	$this->users->putUserOnWave($user, 1);
    	
    	$this->users->saveUsers();
        $this->users = new Users($this->db);
        
    	$user = $this->users->retrieveUser("JKi7IbcSBQmA71jB");
        $this->assertEquals("sebastian.lemerdy@gmail.com", $user->getEmail());
        $this->assertEquals("Groom's big brother", $user->getWeddingLink());
        $this->assertEquals("Sébas.", $user->getName());
        $this->assertEquals(1, $user->getWave());
    }
    
    /**
     * @test
     */
    public function should_creates_and_save_new_user() {
    	$token = $this->users->createUser("new-user@provider.com", "wedlink", "myname");
    	
    	$this->users->saveUsers();
    	$this->users = new Users($this->db);
    	
    	$this->assertTrue($token != "JKi7IbcSBQmA71jB", "A new token must have been generated.");
    	$this->assertRegExp("/[a-zA-Z0-9]{16}/", $token);
    	$user = $this->users->retrieveUser($token);
    	$this->assertEquals("new-user@provider.com", $user->getEmail());
    	$this->assertEquals("wedlink", $user->getWeddingLink());
    	$this->assertEquals("myname", $user->getName());
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
    	$this->assertEquals("new-user@provider.com", $deletedUser->getEmail());
    	$this->assertEquals("wedlink", $deletedUser->getWeddingLink());
    	$this->assertEquals("myname", $deletedUser->getName());
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
    	$this->users->createUser("nowave@provider.com", "unknown", "nowave");
    	$this->users
    		->putUserOnWave($this->users->retrieveUser($this->users->createUser("wave1@provider.com", "unknown", "wave1")), 1)
    		->putUserOnWave($this->users->retrieveUser($this->users->createUser("xave2@provider.com", "unknown", "xave2")), 2)
    		->putUserOnWave($this->users->retrieveUser($this->users->createUser("wave2@provider.com", "unknown", "wave2")), 2)
    		->putUserOnWave($this->users->retrieveUser($this->users->createUser("wave4@provider.com", "unknown", "wave4")), 4)
    		->putUserOnWave($this->users->retrieveUser($this->users->createUser("wave5@provider.com", "unknown", "wave5")), 5);
    	
    	$userNamesByWave = $this->users->getUserNamesByWave();
    	
    	$this->assertCount(6, $userNamesByWave);
    	$this->assertCount(2, $userNamesByWave[0]);
    	$this->assertEquals(array("Sébastian", "nowave"), $userNamesByWave[0]);
    	$this->assertCount(1, $userNamesByWave[1]);
    	$this->assertEquals(array("wave1"), $userNamesByWave[1]);
    	$this->assertCount(2, $userNamesByWave[2]);
    	$this->assertEquals(array("wave2", "xave2"), $userNamesByWave[2]);
    	$this->assertEmpty($userNamesByWave[3]);
    	$this->assertCount(1, $userNamesByWave[4]);
    	$this->assertEquals(array("wave4"), $userNamesByWave[4]);
    	$this->assertCount(1, $userNamesByWave[5]);
    	$this->assertEquals(array("wave5"), $userNamesByWave[5]);
    }
    
    /**
     * @test
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Bad wave
     */
    public function cant_put_user_on_wave_lower_than_minimum() {
    	$this->users->putUserOnWave($this->users->retrieveUser("JKi7IbcSBQmA71jB"), 0);
    }
    
    /**
     * @test
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Bad wave
     */
    public function cant_put_user_on_wave_upper_than_maximum() {
    	$this->users->putUserOnWave($this->users->retrieveUser("JKi7IbcSBQmA71jB"), 6);
    }
    
    /**
     * @test
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Can't put null user on wave 3
     */
    public function cant_put_null_user_on_wave() {
    	$this->users->putUserOnWave(null, 3);
    }
    
    /**
     * @test
     */
    public function should_retrieve_available_waves() {
    	$this->users->putUserOnWave($this->users->retrieveUser($this->users->createUser("wave11@provider.com", "unknown", "wave11")), 2);
    	$this->users->putUserOnWave($this->users->retrieveUser($this->users->createUser("wave22@provider.com", "unknown", "wave12")), 2);
    	
    	$availableWaves = $this->users->getAvailableWaves();
    	
    	$this->assertCount(4, $availableWaves);
    	$this->assertContains(1, $availableWaves);
    	$this->assertContains(3, $availableWaves);
    	$this->assertContains(4, $availableWaves);
    	$this->assertContains(5, $availableWaves);
    }
    
    /**
     * @test
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Wave 1 is full
     */
    public function cant_get_into_wave_where_all_users_on_first_wave_are_already_in_place() {
    	$this->users->createUser("wave1@provider.com", "unkown", "wave");
    	$this->users->createUser("wave2@provider.com", "unkown", "wave");
    	$this->users->createUser("wave3@provider.com", "unkown", "wave");
    	$this->users->createUser("wave4@provider.com", "unkown", "wave");
    	$this->users->putUserOnWave($this->users->retrieveUser("JKi7IbcSBQmA71jB"), 1);
    	$this->users->putUserOnWave($this->users->retrieveUser($this->users->createUser("wave5@provider.com", "unknown", "wave")), 1);
    	$this->users->putUserOnWave($this->users->retrieveUser($this->users->createUser("wave6@provider.com", "unknown", "wave")), 1);
    }
    
    /**
     * @test
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Wave 2 is full
     */
    public function cant_get_into_wave_where_all_users_on_all_waves_are_already_in_place() {
    	$this->users->putUserOnWave($this->users->retrieveUser($this->users->createUser("wave1@provider.com", "unknown", "wave")), 2);
    	$this->users->putUserOnWave($this->users->retrieveUser($this->users->createUser("wave2@provider.com", "unknown", "wave")), 2);
    	$this->users->putUserOnWave($this->users->retrieveUser($this->users->createUser("wave3@provider.com", "unknown", "wave")), 2);
    	$this->users->putUserOnWave($this->users->retrieveUser($this->users->createUser("wave4@provider.com", "unknown", "wave")), 2);
    }
    
}

?>