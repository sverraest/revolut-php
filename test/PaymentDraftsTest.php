<?php

class PaymentDraftsTest extends PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $stub = $this->getMockBuilder('RevolutPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');

        $drafts = new \RevolutPHP\PaymentDrafts($stub);
        $this->assertEquals('foo', $drafts->create(['foo' => 'bar']));
        
    }
    
    public function testAll()
    {
        $stub = $this->getMockBuilder('RevolutPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');

        $drafts = new \RevolutPHP\PaymentDrafts($stub);
        $this->assertEquals('foo', $drafts->all());

    }

    public function testDelete()
    {
        $stub = $this->getMockBuilder('RevolutPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('delete')->willReturn(null);

        $drafts = new \RevolutPHP\PaymentDrafts($stub);
        $this->assertEquals(null, $drafts->delete('foo'));

    }

    public function testGet()
    {
        $stub = $this->getMockBuilder('RevolutPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');

        $drafts = new \RevolutPHP\PaymentDrafts($stub);
        $this->assertEquals('foo', $drafts->get('bar'));

    }
}
