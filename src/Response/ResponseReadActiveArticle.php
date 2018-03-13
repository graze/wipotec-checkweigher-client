<?php

namespace Graze\WipotecCheckweigherClient\Response;

class ResponseReadActiveArticle extends AbstractResponse
{
    /** @var string[] */
    private $paramIdToValue;

    /**
     * @param mixed[] $contents
     */
    protected function parseContents(array $contents)
    {
        if (!isset($contents['article_definition']['parameter'])) {
            return;
        }

        foreach ($contents['article_definition']['parameter'] as $param) {
            $id = $param['id'];
            $value = $param['value'];
            $this->paramIdToValue[$id] = $value;
        }
    }

    /**
     * @param int $id
     * @return string
     */
    public function getArticleParam($id)
    {
        return isset($this->paramIdToValue[$id]) ? $this->paramIdToValue[$id] : null;
    }
}
