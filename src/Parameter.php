<?php

namespace Graze\WipotecCheckweigherClient;

class Parameter
{
    const CORRECT_WEIGHT = 35;
    const FREE_TEXT = 10000;
    const LENGTH = 90;
    const LOT_NUMBER = 120;
    const MINUS_WEIGHT = 32;
    const NAME = 102;
    const NOMINAL = 21;
    const NUMBER = 103;
    const OPTIMISATION = 297;
    const ORDER_NUMBER = 444;
    const OVERWEIGHT = 38;
    const PLUS_WEIGHT = 37;
    const SORT_NUMBER = 263;
    const TARE = 244;
    const TO = 296;
    const TO1 = 22;
    const TO2 = 23;
    const TU1 = 20;
    const TU2 = 19;
    const UNDERWEIGHT = 32;

    /** @var string[] */
    private static $idToName = [
        self::CORRECT_WEIGHT => 'Correct weight',
        self::FREE_TEXT => 'Free text',
        self::LENGTH => 'Length',
        self::LOT_NUMBER => 'Lot number',
        self::MINUS_WEIGHT => 'Minus weight',
        self::NAME => 'Name',
        self::NOMINAL => 'Nominal',
        self::NUMBER => 'Number',
        self::OPTIMISATION => 'Optimisation',
        self::ORDER_NUMBER => 'Order number',
        self::OVERWEIGHT => 'Overweight',
        self::PLUS_WEIGHT => 'Plus weight',
        self::SORT_NUMBER => 'Sort number',
        self::TARE => 'Tare',
        self::TO => 'TO',
        self::TO1 => 'TO1',
        self::TO2 => 'TO2',
        self::TU1 => 'TU1',
        self::TU2 => 'TU2',
        self::UNDERWEIGHT => 'Underweight'
    ];

    /**
     * @param int $id
     * @return string
     */
    public function getName($id)
    {
        if (isset(self::$idToName[$id])) {
            return self::$idToName[$id];
        }

        return sprintf('Param %d', $id);
    }
}
