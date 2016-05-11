<?php
/**
 * Created by PhpStorm.
 * User: Josafat
 * Date: 10/05/2016
 * Time: 05:34 PM
 */

namespace app\controllers;

use yii\web\Controller;
use yii\helpers\StringHelper;
use app\models\Message;
use bubasuma\simplechat\controllers\ControllerTrait;


class MessageController extends Controller
{
    use ControllerTrait;

    /**
     * @return string
     */
    public function getModelClass()
    {
        return Message::className();
    }

    /**
     * @inheritDoc
     */
    public function formatMessage($model)
    {
        //...
        return $model;
    }

    /**
     * @inheritDoc
     */
    public function formatConversation($model)
    {
        //...
        $model['text'] = StringHelper::truncate($model['text'], 20);
        //...
        return $model;
    }

}