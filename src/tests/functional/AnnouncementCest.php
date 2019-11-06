<?php

namespace tests;

use artbyrab\Yii2ModuleBase\models\Announcement;
use tests\fixtures\AnnouncementFixture;
use yii\helpers\Html;

/**
 * Base Cest
 *
 * A base functional test to use as an example for your own functional tests.
 */
class AnnouncementCest
{
    /**
     * _before
     *
     * Run before every test
     */
    public function _before(\FunctionalTester $I)
    {
    }

    /**
     * Test the main announcement page exists and contains the correct title,
     * text and at least one of the correct database entries.
     */
    public function openAnnouncementPage(\FunctionalTester $I)
    {
        $I->wantTo('Ensure the announcement main page loads correctly');
        $I->amOnRoute('module-base');
        $I->see('Yii2 Module Base', 'h1');
        $I->see('View the latest announcements', 'p');
        $I->see('Easily implement RBAC in your module', 'h3');
        $I->see('It has never been easier to implement RBAC in your module. ', 'p');
    }

    /**
     * Test the admin page without being logged in.
     *
     * This should redirect us to the login page.
     */
    public function openAnnouncementAdminPageWithoutBeingLoggedIn(\FunctionalTester $I)
    {
        $I->wantTo('Ensure the announcement admin page redirects to login when not logged in');
        $I->amOnRoute('module-base/admin/index');
        $I->see('Login', 'h1');
    }

    /**
     * Test the admin page when logged in
     *
     * This should allow us to login and see the announcement admin page.
     */
    public function openAnnouncementAdminPageWhenLoggedIn(\FunctionalTester $I)
    {
        $I->wantTo('Ensure the announcement admin page works when logged in');
        $I->amOnRoute('module-base/admin/index');
        $I->see('Login', 'h1');
        $I->amGoingTo('Try to login with correct credentials');
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'admin',
        ]);
        $I->see('Logout (admin)');
        $I->dontSeeElement('form#login-form');
        $I->see('Yii2 Module Base Admin area ', 'strong');
    }
}
