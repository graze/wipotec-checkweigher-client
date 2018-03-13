<?php

namespace Graze\WipotecCheckweigherClient\Request;

class RequestSetArticle extends RequestChangeArticle
{
    /**
     * @return string
     */
    protected function getId()
    {
        return 'set_article';
    }
}
