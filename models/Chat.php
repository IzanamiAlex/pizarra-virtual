<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "chat".
 *
 * @property \MongoId|string $_id
 * @property mixed $username
 * @property mixed $message
 * @property mixed $group
 */
class Chat extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['Chat', 'chat'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'username',
            'message',
            'group',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'message', 'group'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'username' => 'Username',
            'message' => 'Message',
            'group' => 'Group',
        ];
    }
}
