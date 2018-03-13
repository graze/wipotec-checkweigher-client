<?php

namespace Graze\WipotecCheckweigherClient\Request;

use Exception;

class RequestGeneric extends AbstractRequest
{
    /** @var string */
    private $id;

    /** @var mixed[] */
    private $params = [];

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        if (!$this->id) {
            throw new Exception('Id has not been set');
        }

        return $this->id;
    }

    /**
     * @param mixed[] $params
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * @return mixed[]
     */
    public function getParams()
    {
        return $this->params;
    }
}
