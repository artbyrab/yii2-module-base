<?php

namespace tests;

use yii\helpers\Html;

/**
 * Announcement Cest
 *
 * A function test for the announcement models various views.
 */
class BaseCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
    }

    public function openAppHomePage(\FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
        $I->see('Yii2 Module Base', 'h1');
    }
}
