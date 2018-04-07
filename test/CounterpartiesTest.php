<?php

class CounterpartiesTest extends PHPUnit_Framework_TestCase
{
    public function testAll()
    {
        $stub = $this->getMockBuilder('RevolutPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');

        $counterparties = new \RevolutPHP\Counterparties($stub);
        $this->assertEquals('foo', $counterparties->all());

    }

    public function testGet()
    {
        $stub = $this->getMockBuilder('RevolutPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');

        $counterparties = new \RevolutPHP\Counterparties($stub);
        $this->assertEquals('foo', $counterparties->get('bar'));

    }

    public function testCreate()
    {
        $stub = $this->getMockBuilder('RevolutPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');

        $counterparties = new \RevolutPHP\Counterparties($stub);
        $this->assertEquals('foo', $counterparties->create(['foo' => 'bar']));

    }

    public function testDelete()
    {
        $stub = $this->getMockBuilder('RevolutPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('delete')->willReturn(null);

        $counterparties = new \RevolutPHP\Counterparties($stub);
        $this->assertEquals(null, $counterparties->delete('foo'));

    }
}
