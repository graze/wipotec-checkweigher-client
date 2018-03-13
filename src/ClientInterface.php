<?php

namespace Graze\WipotecCheckweigherClient;

use Graze\WipotecCheckweigherClient\Request\RequestInterface;

interface ClientInterface
{
    /**
     * @param string $dsn
     */
    public function connect($dsn);

    /**
     * @param RequestInterface $request
     */
    public function sendRequest(RequestInterface $request);
}
