<?php

namespace Graze\WipotecCheckweigherClient\Tests\Request;

use Graze\WipotecCheckweigherClient\TelnetPromptMatcher;
use PHPUnit\Framework\TestCase;

class TelnetPromptMatcherTest extends TestCase
{
    /**
     * @return mixed[]
     */
    public function isMatchDataProvider()
    {
        $validResponse = <<<EOF
\r
<(len)>0000123</(len)>\r
<?xml version="1.0" encoding="UTF-8" standalone="no" ?>\r
<cw:response xmlns:cw="uri:de.checkweigher">\r
</cw:response>\r

EOF;

        $errorResponse = <<<EOF
\r
<(len)>0000456</(len)>\r
<?xml version="1.0" encoding="UTF-8" standalone="no" ?>\r
<cw:response xmlns:cw="uri:de.checkweigher">\r
  <cw:error_info>\r
  </cw:error_info>\r
</cw:response>\r

EOF;

        return [
            [$validResponse, false, true],
            [$validResponse, true, false],
            [$errorResponse, false, false],
            [$errorResponse, true, true]
        ];
    }

    /**
     * @dataProvider isMatchDataProvider
     * @param string $subject
     * @param bool $isError
     * @param bool $expectedResult
     */
    public function testIsMatch($subject, $isError, $expectedResult)
    {
        $errorPrompt = 'ERROR';
        $prompt = $isError ? $errorPrompt : 'VALID';

        $promptMatcher = new TelnetPromptMatcher($errorPrompt);
        $result = $promptMatcher->isMatch($prompt, $subject);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @expectedException DomainException
     * @expectedExceptionMessage Response is invalid, could not find header
     */
    public function testIsMatchInvalidHeaderException()
    {
        $prompt = '';
        $subject = <<<EOF
<?xml version="1.0" encoding="UTF-8" standalone="no" ?>\r
<cw:response xmlns:cw="uri:de.checkweigher">\r
</cw:response>\r

EOF;

        $promptMatcher = new TelnetPromptMatcher('ERROR');
        $isMatch = $promptMatcher->isMatch($prompt, $subject, '');
    }
}
