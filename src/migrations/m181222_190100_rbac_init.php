<?php

namespace artbyrab\Yii2ModuleBase\migrations;

use Yii;
use yii\db\Migration;

/**
 * Handles the initial Roles and permissions for the RBAC in this module
 *
 * This will create the default roles we need to get going.
 *
 * Please note if you run this in the test db after already migrating the
 * main db while using PhpManager as the auth class you might get an error on
 * the migration. This is due to the auth already being stored in a folder.
 *
 * To mitigate this issue i have put a conditional in the migration.
 */
class m181222_190100_rbac_init extends Migration
{
    private $auth;

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        // get the Yii2 auth manager
        $auth = Yii::$app->authManager;

        // create view admin permission
        $viewAdminRecords = $auth->createPermission('viewModuleBaseAdminArea');
        $viewAdminRecords->description = 'View the moduleBaseAdmin area.';
        $auth->add($viewAdminRecords);

        // create the edit admin permission
        $editAdminRecords = $auth->createPermission('editModuleBaseAdminArea');
        $editAdminRecords->description = 'Edit the moduleBaseAdmin area.';
        $auth->add($editAdminRecords);

        // create the admin role
        $admin = $auth->createRole('moduleBaseAdmin');
        $admin->description = 'ModuleBaseAdmin, can view and edit all records in the admin dashboard.';
        $auth->add($admin);

        // if we dont check if the child already exists this will break on the
        // test db migrations if you have already migrations the main app.
        if ($auth->hasChild($admin, $viewAdminRecords) == false) {
            $auth->addChild($admin, $viewAdminRecords);
        }

        // if we dont check if the child already exists this will break on the
        // test db migrations if you have already migrations the main app.
        if ($auth->hasChild($admin, $editAdminRecords) == false) {
            $auth->addChild($admin, $editAdminRecords);
        }
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        Yii::$app->authManager->removeAll();
    }
}
