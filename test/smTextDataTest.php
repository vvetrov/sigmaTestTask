<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use sigmaProducts\dataAdapters\smTextData;

class smTextDataTest extends TestCase {
	private $testFilename;
	public function __construct() {
		parent::__construct();
		$this->testFilename = tempnam(sys_get_temp_dir(), 'tmp');
	}
	public function __destruct()
	{
		@unlink($this->testFilename);
	}

	public function testSetGetDynamic() {
		$adapter = new smTextData($this->testFilename);
		$adapter->setItem('ZA', [1 => 2.0]);
		$adapter->setItem('ZA', [4 => 7.0]);
		$adapter->setItem('YB', [1 => 12.0]);
		$adapter->setItem('FC', [1 => 1.25]);
		$adapter->setItem('FC', [6 => 6.0]);
		$adapter->setItem('GD', [1 => 0.15]);
		$za = $adapter->getItem('ZA');
		$this->assertIsArray($za);
		$this->assertCount(2, $za);
		$this->assertEquals(2.0, $za[1]);
		$this->assertEquals(7.0, $za[4]);
	}

	public function testSetGetSaved() {
		$adapter = new smTextData($this->testFilename);
		$adapter->setItem('ZA', [1 => 2.0]);
		$adapter->setItem('ZA', [4 => 7.0]);
		$adapter->setItem('YB', [1 => 12.0]);
		$adapter->setItem('FC', [1 => 1.25]);
		$adapter->setItem('FC', [6 => 6.0]);
		$adapter->setItem('GD', [1 => 0.15]);
		unset($adapter);
		$adapter = new smTextData($this->testFilename);
		$za = $adapter->getItem('ZA');
		$this->assertIsArray($za);
		$this->assertCount(2, $za);
		$this->assertEquals(2.0, $za[1]);
		$this->assertEquals(7.0, $za[4]);
		$this->assertIsArray($adapter->getItem('YB'));
		$this->assertCount(1, $adapter->getItem('YB'));
		$this->assertIsArray($adapter->getItem('FC'));
		$this->assertCount(2, $adapter->getItem('FC'));
		$this->assertIsArray($adapter->getItem('GD'));
		$this->assertCount(1, $adapter->getItem('GD'));
		$this->assertEquals(0.15, $adapter->getItem('GD')[1]);
	}
}