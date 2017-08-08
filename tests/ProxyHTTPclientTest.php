<?php

namespace Tests;

use \HTTPClient\Extensions\ProxyHTTPclient;
use \Logics\Tests\InternalWebServer;
use \PHPUnit_Framework_TestCase;

class ProxyHTTPclientTest extends PHPUnit_Framework_TestCase
    {

	use InternalWebServer;

	/**
	 * Name folder which should be removed after tests
	 *
	 * @var string
	 */
	protected $remotepath;

	/**
	 * Testing object
	 *
	 * @var HTTPclientWithCache
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return void
	 */

	protected function setUp()
	    {
		$this->remotepath = $this->webserverURL();
		$this->object     = new ProxyHTTPclient($this->remotepath . "/HTTPclientResponder.php");
	    } //end setUp()


	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 *
	 * @return void
	 */

	protected function tearDown()
	    {
		unset($this->object);
	    } //end tearDown()


	/**
	 * Testing HTTP GET
	 *
	 * @return void
	 */

	public function testGet()
	    {
		$page = $this->object->get();
		$this->assertInternalType("string", $page);
		$lastcode = $this->object->lastcode();
		$this->assertInternalType("int", $lastcode);
		$this->assertEquals(200, $lastcode);

		$this->object = new ProxyHTTPclient(
		    $this->remotepath . "/HTTPclientResponder.php?inline=value",
		    array("param" => "value"),
		    array("HTTPclientTest-headers" => "value"),
		    [
			"useragent" => "HTTPclientTest",
		]);

		$page = $this->object->get();
		$this->assertContains("Method: GET", $page);
		$this->assertContains("User-agent: HTTPclientTest", $page);
		$this->assertContains("HTTPclientTest-headers = 'value'", $page);
		$this->assertContains("GET: inline = 'value'", $page);
		$this->assertContains("GET: param = 'value'", $page);
	    } //end testGet()


    } //end class

?>
