<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use sigmaProducts\dataAdapters\smTextData;
use sigmaProducts\productCalcTerminal;

class smProductCalcTerminalTest extends TestCase
{

    private $testFilename;
    private $adapter;

    public function __construct()
    {
        parent::__construct();
        $this->testFilename = tempnam(sys_get_temp_dir(), 'tmp');
        $this->adapter = new smTextData($this->testFilename);
    }

    public function __destruct()
    {
        @unlink($this->testFilename);
    }

    public function testCase1()
    {
        $terminal = new productCalcTerminal($this->adapter);
        $this->setPricing($terminal);
        $terminal->scanItem("ZA");
        $terminal->scanItem("YB");
        $terminal->scanItem("FC");
        $terminal->scanItem("GD");
        $terminal->scanItem("ZA");
        $terminal->scanItem("YB");
        $terminal->scanItem("ZA");
        $terminal->scanItem("ZA");
        $total = $terminal->getTotal();
        $this->assertEquals(32.4, $total);
    }

    /**
     * @param productCalcTerminal $terminal
     */
    public function setPricing($terminal)
    {
        $terminal->setPricing('ZA', 1, 2.0);
        $terminal->setPricing('ZA', 4, 7.0);
        $terminal->setPricing('YB', 1, 12.0);
        $terminal->setPricing('FC', 1, 1.25);
        $terminal->setPricing('FC', 6, 6.0);
        $terminal->setPricing('GD', 1, 0.15);
    }

    public function testCase2()
    {
        $terminal = new productCalcTerminal($this->adapter);
        $this->setPricing($terminal);
        $terminal->scanItem("FC");
        $terminal->scanItem("FC");
        $terminal->scanItem("FC");
        $terminal->scanItem("FC");
        $terminal->scanItem("FC");
        $terminal->scanItem("FC");
        $terminal->scanItem("FC");
        $total = $terminal->getTotal();
        $this->assertEquals(7.25, $total);
    }

    public function testCase3()
    {
        $terminal = new productCalcTerminal($this->adapter);
        $this->setPricing($terminal);
        $terminal->scanItem("ZA");
        $terminal->scanItem("YB");
        $terminal->scanItem("FC");
        $terminal->scanItem("GD");
        $total = $terminal->getTotal();
        $this->assertEquals(15.4, $total);
    }
}