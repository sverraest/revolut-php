<?php

class TransactionsTest extends PHPUnit_Framework_TestCase
{
    public function testAll()
    {
        $stub = $this->getMockBuilder('RevolutPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');

        $transactions = new \RevolutPHP\Transactions($stub);
        $this->assertEquals('foo', $transactions->all());

    }

    public function testCancel()
    {
        $stub = $this->getMockBuilder('RevolutPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('delete')->willReturn(null);

        $transactions = new \RevolutPHP\Transactions($stub);
        $this->assertEquals(null, $transactions->cancel('foo'));

    }

    public function testGet()
    {
        $stub = $this->getMockBuilder('RevolutPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');

        $transactions = new \RevolutPHP\Transactions($stub);
        $this->assertEquals('foo', $transactions->get('bar'));

    }

    public function testGetByRequestId()
    {
        $stub = $this->getMockBuilder('RevolutPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');

        $transactions = new \RevolutPHP\Transactions($stub);
        $this->assertEquals('foo', $transactions->getByRequestId('bar'));

    }
}
