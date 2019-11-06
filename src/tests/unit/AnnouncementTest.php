<?php

namespace tests;

use Yii;
use artbyrab\Yii2ModuleBase\models\Announcement;

/**
 * Announcement Test
 *
 * A base unit test for you to use as an example for your own unit tests.
 */
class AnnouncementTest extends \Codeception\Test\Unit
{
    /**
     * @var object An instance of the object class Announcement to speed up
     * testing and reduce code in the test functions.
     */
    public $announcement;

    /**
     * Set up
     *
     * Performed before every test.
     */
    protected function setUp()
    {
        $this->announcement = new Announcement();
        $this->announcement->title = 'A test announcement';
        $this->announcement->message = 'This is simply a test announcement.';
    }

    /**
     * Tear down
     *
     * Performed after every test.
     */
    protected function tearDown()
    {
        unset($this->announcement);
    }

    /**
     * Test the save function when creating a new record.
     */
    public function testSave()
    {
        $saved = $this->announcement->save();

        $databaseRecord = Announcement::find()
            ->where(['title' => $this->announcement->title])
            ->one();

        $this->assertTrue($saved);
        $this->assertEquals($databaseRecord->message, $this->announcement->message);
        $this->assertNotEmpty($databaseRecord->created_datetime);
        $this->assertNotEmpty($databaseRecord->updated_datetime);

        $databaseRecord->delete();
    }
}
