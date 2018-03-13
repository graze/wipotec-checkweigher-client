<?php

namespace Graze\WipotecCheckweigherClient\Request;

class RequestWriteArticle extends AbstractRequestArticle
{
    /**
     * @return string
     */
    protected function getId()
    {
        return 'write_article';
    }
}
