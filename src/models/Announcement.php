<?php

namespace artbyrab\Yii2ModuleBase\models;

use Yii;

/**
 * This is the model class for table "announcement".
 *
 * This is just an example model for show in the module.
 *
 * @property int $id
 * @property string $title
 * @property string $message
 * @property string $created_datetime
 * @property string $updated_datetime
 */
class Announcement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module-base_announcement}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'message'], 'required'],
            [['message'], 'string'],
            [['created_datetime', 'updated_datetime'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'message' => 'Message',
            'created_datetime' => 'Created Datetime',
            'updated_datetime' => 'Updated Datetime',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_datetime = date('Y-m-d H:i:s');
        }

        $this->updated_datetime = date('Y-m-d H:i:s');

        return parent::beforeSave($insert);
    }
}
