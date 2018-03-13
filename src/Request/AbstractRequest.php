<?php

namespace Graze\WipotecCheckweigherClient\Request;

use Datetime;
use Graze\XmlUtils\XmlConverter;
use SimpleXMLElement;

abstract class AbstractRequest implements RequestInterface
{
    /**
     * @return string
     */
    abstract protected function getId();

    /**
     * @return mixed[]
     */
    protected function getParams()
    {
        return [];
    }

    /**
     * @return string
     */
    public function getXml()
    {
        $now = new Datetime();

        $data = [
            'request_id'    => $this->getId(),
            'date'          => $now->format('Y-m-d'),
            'time'          => $now->format('H:i:s')
        ];

        $data += $this->getParams();

        // Create the base XML then add the data.
        $baseXml = '<?xml version="1.0" encoding="UTF-8"?><cw:request xmlns:cw="uri:de.checkweigher"></cw:request>';
        $xmlElement = new SimpleXMLElement($baseXml);

        $xmlConverter = new XmlConverter();
        $xmlConverter->addArrayAsChildren($data, $xmlElement);

        $xmlContents = $xmlElement->asXML();

        $header = sprintf("\r\n<(len)>%07d</(len)>\r\n", strlen($xmlContents));

        return $header.$xmlContents;
    }
}
