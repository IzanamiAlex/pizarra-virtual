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
class Chat extends \yii\redis\ActiveRecord
{
    public function attributes()
    {
        return ['id','username', 'message', 'group'];
    }
}
