<?php

class ExchangesTest extends PHPUnit_Framework_TestCase
{
    public function testExchange()
    {
        $response = 
        '{
            "id": "d56d5596-523b-4613-2cc7-54974a37bcac",
            "state": "completed",
            "created_at": "2018-10-10T10:10:10.0Z",
            "completed_at": "2018-10-10T10:10:10.0Z"
          }';

        $stub = $this->getMockBuilder('RevolutPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn($response);

        $request = json_decode(
            '{
                "from": {
                    "account_id": "d56dd396-523b-4613-8cc7-54974c17bcac",
                    "currency": "USD",
                    "amount": 135.5
                },
                "to": {
                    "account_id": "a44dd365-523b-4613-8457-54974c8cc7ac",
                    "currency": "EUR"
                },
                "reference" : "Time to party",
                "request_id": "e0cbf84637264ee082a848b"
            }', true
        );

        $exchanges = new \RevolutPHP\Exchanges($stub);
        $this->assertEquals($response, $exchanges->exchange($request));

    }
}
