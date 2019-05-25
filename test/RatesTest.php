<?php

class RatesTest extends PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $response = 
        '{
            "from": {
                "amount":100,
                "currency":"USD"
            },
            "to": {
                "amount":78.9,
                "currency":"EUR"
            },
            "rate":0.789,
            "fee": {
                "amount":0.85,
                "currency":"EUR"
            },
            "rate_date":"2019-01-16T13:01:47.229Z"
        }';

        $stub = $this->getMockBuilder('RevolutPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn($response);

        $rates = new \RevolutPHP\Rates($stub);
        $this->assertEquals($response, $rates->get('USD', 'EUR', 100));

    }
}
