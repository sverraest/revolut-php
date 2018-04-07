<?php

class TransfersTest extends PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $stub = $this->getMockBuilder('RevolutPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');

        $transfers = new \RevolutPHP\Transfers($stub);
        $this->assertEquals('foo', $transfers->create(['foo' => 'bar']));

    }
}