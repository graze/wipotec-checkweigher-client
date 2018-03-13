<?php

namespace Graze\WipotecCheckweigherClient\Response;

interface ResponseInterface
{
    /**
     * Whether an error was returned.
     *
     * @return bool
     */
    public function hasError();

    /**
     * Get the error message.
     *
     * @return string
     */
    public function getError();

    /**
     * Get the raw response as an array.
     *
     * @return mixed[]
     */
    public function getContents();
}
