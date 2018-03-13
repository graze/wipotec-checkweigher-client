<?php

namespace Graze\WipotecCheckweigherClient\Response;

class ResponseReadStatus extends AbstractResponse
{
    /** @var int */
    private $statusId;

    /** @var string */
    private $statusName;

    /**
     * @param mixed[] $contents
     */
    protected function parseContents(array $contents)
    {
        if (isset($contents['status']['status_id'])) {
            $this->statusId = $contents['status']['status_id'];
        }

        if (isset($contents['status']['status_name'])) {
            $this->statusName = $contents['status']['status_name'];
        }
    }

    /**
     * @return int
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        return $this->statusName;
    }
}
