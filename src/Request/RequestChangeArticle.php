<?php

namespace Graze\WipotecCheckweigherClient\Request;

use Graze\Dispatch\Checkweigher\Client\Parameter;

class RequestChangeArticle extends AbstractRequestArticle
{
    /** @var bool */
    private $resetCounter;

    /**
     * @return string
     */
    protected function getId()
    {
        return 'change_article';
    }

    /**
     * @param bool $resetCounter
     */
    public function setResetCounter($resetCounter)
    {
        $this->resetCounter = $resetCounter;
    }

    /**
     * @return mixed[]
     */
    protected function getParams()
    {
        $params = parent::getParams();

        if (!is_null($this->resetCounter)) {
            $params['article_definition']['reset_counter'] = (int)$this->resetCounter;
        }

        return $params;
    }
}
