<?php

class AccountsTest extends PHPUnit_Framework_TestCase
{
    public function testAll()
    {
        $stub = $this->getMockBuilder('RevolutPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');

        $accounts = new \RevolutPHP\Accounts($stub);
        $this->assertEquals('foo', $accounts->all());

    }

    public function testGet()
    {
        $stub = $this->getMockBuilder('RevolutPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');

        $accounts = new \RevolutPHP\Accounts($stub);
        $this->assertEquals('foo', $accounts->get('bar'));

    }

    public function testGetDetails()
    {
        $stub = $this->getMockBuilder('RevolutPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');

        $accounts = new \RevolutPHP\Accounts($stub);
        $this->assertEquals('foo', $accounts->getDetails('bar'));

    }
}
