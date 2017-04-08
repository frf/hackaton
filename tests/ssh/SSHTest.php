<?php
use PHPUnit\Framework\TestCase;
/**
* @covers SSH
*/
class SSHTest extends TestCase
{
	protected $ssh;
	protected $user;
	protected $password;
	protected $host;
	protected $port;

	public function setUp(){
		$this->ssh 		= new OpenVpnManager\SSH\SSH();
		$this->user 	= 'thiagoalencar';
		$this->password = 'forever007';
		$this->host 	= 'localhost';
		$this->port 	= 22;
	}

	public function testIfCanLoginInRemoteServer(){
		$ssh = $this->ssh->login($this->host, $this->user, $this->password);
		$this->assertEquals(true, $ssh);

	}
}