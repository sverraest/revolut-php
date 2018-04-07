<?php

class PaymentsTest extends PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $stub = $this->getMockBuilder('RevolutPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');

        $payments = new \RevolutPHP\Payments($stub);
        $this->assertEquals('foo', $payments->create(['foo' => 'bar']));

    }
}
