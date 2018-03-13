<?php

namespace Graze\WipotecCheckweigherClient\Response;

use Exception;
use Graze\TelnetClient\TelnetResponseInterface;
use Graze\XmlUtils\XmlConverter;
use SimpleXMLElement;

class AbstractResponse implements ResponseInterface
{
    /** @var mixed[] */
    private $contents;

    /** @var string */
    private $error;

    /**
     * @param TelnetResponseInterface $telnetResponse
     */
    public function __construct(TelnetResponseInterface $telnetResponse)
    {
        try {
            $xml = @new SimpleXMLElement($telnetResponse->getResponseText(), 0, false, 'cw', true);
        } catch (Exception $e) {
            $this->setError($e->getMessage());
            return;
        }

        $xmlConverter = new XmlConverter();
        $this->contents = $xmlConverter->convertToArray($xml);

        if ($telnetResponse->isError()) {
            $error = 'unknown';
            if (!isset($xml['error_info']['error_text'])) {
                $error = $xml['error_info']['error_text'];
            }

            $this->setError('Telnet response error: '.$error);
            return;
        }

        $this->parseContents($this->contents);
    }

    /**
     * @param string $error
     */
    private function setError($error)
    {
        $this->error = $error;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return bool
     */
    public function hasError()
    {
        return (bool)$this->error;
    }

    /**
     * @param mixed[] $contents
     */
    protected function parseContents(array $contents)
    {
    }

    /**
     * @return mixed[]
     */
    public function getContents()
    {
        return $this->contents;
    }
}
