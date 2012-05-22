<?php

require_once("classes/Logger.php");

class LoggerTest extends PHPUnit_Framework_TestCase {
	
	private $db;
	private $user;
	
	public function setUp() {
		$this->db = new PDO("sqlite::memory:");
		$this->user = new User("email@provider.com", "weddingLink", "name");
	}
	
	/**
	 * @test
	 */
	public function should_log_access() {
		Logger::log($this->user, $this->db);
		
		try {
			$statement = $this->db->query("SELECT access_log.*, CURRENT_TIMESTAMP AS now FROM access_log");
			if (FALSE === $statement) {
				$this->fail();
			}
			$row = $statement->fetch();
			$this->assertEquals("email@provider.com", $row["email"]);
			$this->assertEquals($row["now"], $row["date"]);
			$this->assertEquals($_SERVER["SCRIPT_NAME"], $row["page"]);
			$statement->closeCursor();
		} catch (PDOException $e) {
			$this->fail();
		}
	}
	
	/**
	 * @test
	 */
	public function should_log_only_one_line_per_access() {
		Logger::log($this->user, $this->db);
		
		$statement = $this->db->query("SELECT COUNT(*) AS count FROM access_log");
		if (FALSE === $statement) {
			$this->fail();
		}
		$row = $statement->fetch();
		$this->assertEquals(1, $row["count"]);
		$statement->closeCursor();
	}
	
	/**
	 * @test
	 */
	public function should_creates_table() {
		Logger::log($this->user, $this->db);
		
		$statement = $this->db->query("SELECT COUNT(*) AS count FROM sqlite_master WHERE type='table' AND name='access_log'");
		if (FALSE === $statement) {
			$this->fail();
		}

		$result = $statement->fetch();
		$this->assertEquals(1, $result["count"]);
		$statement->closeCursor();
	}
	
}