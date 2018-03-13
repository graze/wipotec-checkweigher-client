<?php

namespace Graze\WipotecCheckweigherClient\Request;

class RequestReadActiveArticle extends AbstractRequest
{
    /**
     * @return string
     */
    protected function getId()
    {
        return 'read_activearticle';
    }
}
