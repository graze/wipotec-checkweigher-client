<?php

namespace Graze\WipotecCheckweigherClient\Tests;

use Graze\TelnetClient\TelnetClientInterface;
use Graze\TelnetClient\TelnetResponseInterface;
use Graze\WipotecCheckweigherClient\Client;
use Graze\WipotecCheckweigherClient\Request\RequestInterface;
use Graze\WipotecCheckweigherClient\Request\RequestReadStatus;
use Graze\WipotecCheckweigherClient\Request\RequestWriteArticle;
use Graze\WipotecCheckweigherClient\Response\ResponseGeneric;
use Graze\WipotecCheckweigherClient\Response\ResponseReadStatus;
use Graze\WipotecCheckweigherClient\TelnetPromptMatcher;
use Mockery;
use PHPUnit_Framework_TestCase;

class ClientTest extends PHPUnit_Framework_TestCase
{
    public function testConnect()
    {
        $dsn = '127.0.0.1:55001';
        $timeout = 1.2;

        $telnetClient = Mockery::mock(TelnetClientInterface::class);
        $client = new Client($telnetClient);

        // Connecting without timeout
        $telnetClient->shouldReceive('connect')
            ->with($dsn, null, Client::PROMPT_ERROR, '', null)
            ->once();
        $client->connect($dsn);

        // Connecting with timeout
        $telnetClient->shouldReceive('connect')
            ->with($dsn, null, Client::PROMPT_ERROR, '', $timeout)
            ->once();
        $client->connect($dsn, $timeout);
    }

    /**
     * @return mixed[]
     */
    public function sendRequestDataProvider()
    {
        return [
            [RequestWriteArticle::class, ResponseGeneric::class],
            [RequestReadStatus::class, ResponseReadStatus::class]
        ];
    }

    /**
     * @dataProvider sendRequestDataProvider
     * @param string $requestClass
     * @param string $expectedResponseClass
     */
    public function testSendRequest($requestClass, $expectedResponseClass)
    {
        // Instantiate instead of mocking as the proper namespace is required for determining the response class.
        $request = new $requestClass();

        $telnetResponse = Mockery::mock(TelnetResponseInterface::class);

        $telnetClient = Mockery::mock(TelnetClientInterface::class);
        $telnetClient->shouldReceive('execute')
            ->with($request->getXml())
            ->andReturn($telnetResponse);

        $client = new Client($telnetClient);
        $response = $client->sendRequest($request);

        $this->assertInstanceOf($expectedResponseClass, $response);
    }

    public function testFactory()
    {
        $client = Client::factory();
        $this->assertInstanceOf(Client::class, $client);
    }
}
