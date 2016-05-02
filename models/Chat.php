<?php

namespace app\models;

use Yii;

class Chat extends \yii\redis\ActiveRecord
{
    public function attributes()
    {
        return ['id', 'grupo', 'name', 'message'];
    }
}