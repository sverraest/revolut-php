<?php

class WebhooksTest extends PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $stub = $this->getMockBuilder('RevolutPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('https://example.org');

        $webhooks = new \RevolutPHP\Webhooks($stub);
        $this->assertEquals('https://example.org', $webhooks->create(['url' => 'https://example.org']));

    }
}