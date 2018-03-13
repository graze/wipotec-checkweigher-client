<?php

namespace Graze\WipotecCheckweigherClient\Request;

use Graze\Dispatch\Checkweigher\Client\Parameter;

abstract class AbstractRequestArticle extends AbstractRequest
{
    /** @var string[] */
    private $paramIdToValue = [];

    /**
     * @param int $id
     * @param mixed $value
     */
    public function setArticleParam($id, $value)
    {
        $this->paramIdToValue[$id] = $value;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getArticleParam($id)
    {
        return isset($this->paramIdToValue[$id]) ? $this->paramIdToValue[$id] : null;
    }

    /**
     * @return mixed[]
     */
    protected function getParams()
    {
        $articleParams = [];
        foreach ($this->paramIdToValue as $id => $value) {
            $articleParams[] = [
                'id' => $id,
                'name' => Parameter::getName($id),
                'value' => $value
            ];
        }

        $params = [
            'article_definition' => [
                'parameter' => $articleParams
            ]
        ];

        return $params;
    }
}
