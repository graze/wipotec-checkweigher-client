<?php

namespace Graze\WipotecCheckweigherClient\Response;

interface ResponseInterface
{
    /**
     * @return string
     */
    public function getError();

    /**
     * @return bool
     */
    public function hasError();

    /**
     * @return mixed[]
     */
    public function getContents();
}
