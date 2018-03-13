<?php

namespace Graze\WipotecCheckweigherClient;

use Graze\TelnetClient\PromptMatcherInterface;
use DomainException;

class TelnetPromptMatcher implements PromptMatcherInterface
{
    /** @var string[] */
    protected $matches = [];

    /** @var string */
    protected $responseText = '';

    /** @var string */
    protected $promptError;

    /**
     * @param string $promptError
     */
    public function __construct($promptError)
    {
        $this->promptError = $promptError;
    }

    /**
     * @param string $prompt
     * @param string $subject
     * @param string $lineEnding
     * @return bool
     */
    public function isMatch($prompt, $subject, $lineEnding = null)
    {
        $responseEnding = "</cw:response>\r\n";

        // Cheap ending check before expensive regex
        if (substr($subject, -1 * strlen($responseEnding)) != $responseEnding) {
            return false;
        }

        if (!preg_match("/^\r\n<\(len\)>\d{7}<\/\(len\)>\r\n(.*)$/s", $subject, $match)) {
            throw new DomainException('Response is invalid, could not find header');
        }

        $responseText = $match[1];

        // The prompt type determines whether an error is expected or not.
        if ($prompt == $this->promptError xor false !== strpos($responseText, '<cw:error_info>')) {
            return false;
        }

        $this->responseText = $responseText;
        return true;
    }

    /**
     * @return string[]
     */
    public function getMatches()
    {
        return $this->matches;
    }

    /**
     * @return string
     */
    public function getResponseText()
    {
        return $this->responseText;
    }
}
