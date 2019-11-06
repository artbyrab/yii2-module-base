<?php

namespace artbyrab\Yii2ModuleBase\migrations;

use Yii;
use yii\db\Migration;

/**
 * Handles the creation of table `announcement`.
 *
 * Announcements are simply that, a simple announcement being made.
 *
 * Please note, migrations cannot have comments if you are using the SqlLite
 * test database as comments will not work.
 */
class m181204_190100_create_announcement_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%module-base_announcement}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'message' => $this->text()->notNull(),
            'created_datetime' => $this->dateTime(),
            'updated_datetime' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%module-base_announcement}}');
    }
}
