<?php

namespace Graze\WipotecCheckweigherClient;

use Graze\WipotecCheckweigherClient\Request\RequestInterface;
use Graze\WipotecCheckweigherClient\Response\ResponseGeneric;
use Graze\TelnetClient\InterpretAsCommand;
use Graze\TelnetClient\TelnetClient;
use Graze\TelnetClient\TelnetClientInterface;
use Socket\Raw\Factory as SocketFactory;

class Client implements ClientInterface
{
    // The checkweigher telnet interface doesn't actually have a prompt however we need an identifier to distinguish
    // error responses, this is explicitly passed instead of using the default error prompt in case it changes.
    const PROMPT_ERROR = 'ERROR';

    /** @var TelnetClientInterface */
    protected $telnetClient;

    /**
     * @param TelnetClientInterface $telnetClient
     */
    public function __construct(TelnetClientInterface $telnetClient)
    {
        $this->telnetClient = $telnetClient;

        // Set a limit to the number of bytes to read per request, this should hopefully prevent infinite loops if the
        // prompt is never returned. 1000 bytes should be plenty.
        $this->telnetClient->setMaxBytesRead(1000);
    }

    /**
     * @param string $dsn
     * @param float|null $timeout
     */
    public function connect($dsn, $timeout = null)
    {
        $this->telnetClient->connect($dsn, null, self::PROMPT_ERROR, '', $timeout);
    }

    /**
     * @param float $timeout
     */
    public function setReadTimeout($timeout)
    {
        $this->telnetClient->setReadTimeout($timeout);
    }

    /**
     * @param RequestInterface $request
     */
    public function sendRequest(RequestInterface $request)
    {
        $telnetResponse = $this->telnetClient->execute($request->getXml());

        // Use a specific response class if it exists.
        // e.g. with Request/RequestReadStatus try to use Response/ResponseReadStatus.
        $responseClassName = str_replace('Request', 'Response', get_class($request));
        if (!class_exists($responseClassName)) {
            $responseClassName = ResponseGeneric::class;
        }

        $response = new $responseClassName($telnetResponse);

        return $response;
    }

    /**
     * @return Client
     */
    public static function factory()
    {
        $telnetClient = new TelnetClient(
            new SocketFactory(),
            new TelnetPromptMatcher(self::PROMPT_ERROR),
            new InterpretAsCommand()
        );

        return new static($telnetClient);
    }
}
