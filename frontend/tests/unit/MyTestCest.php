<?php namespace frontend\tests\unit;
use frontend\tests\UnitTester;

class MyTestCest
{
    public function _before(UnitTester $I)
    {
    }

    /**
     *  @example [2, 2, 4]
     *  @example [2, 3, 5]
     *  @example [2, 10, 12]
     *  @example [2, -5, -3]
     */
    public function tryToTest(UnitTester $I, \Codeception\Example $example)
    {
        $I->assertEquals($example[0] + $example[1], $example[2]);
    }
}
