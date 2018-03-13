<?php

namespace Graze\WipotecCheckweigherClient\Request;

class RequestReadStatus extends AbstractRequest
{
    /**
     * @return string
     */
    protected function getId()
    {
        return 'read_status';
    }
}
