<?php

namespace Graze\WipotecCheckweigherClient\Tests;

use Graze\WipotecCheckweigherClient\Parameter;
use PHPUnit\Framework\TestCase;

class ParameterTest extends TestCase
{
    /**
     * @return mixed[]
     */
    public function getNameDataProvider()
    {
        return [
            [Parameter::FREE_TEXT, 'Free text'],
            [999, 'Param 999']
        ];
    }

    /**
     * @dataProvider getNameDataProvider
     * @param int $id
     * @param string $expectedName
     */
    public function testGetName($id, $expectedName)
    {
        $name = Parameter::getName($id);
        $this->assertEquals($expectedName, $name);
    }
}
