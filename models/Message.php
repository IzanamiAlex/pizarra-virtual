<?php
/**
 * Created by PhpStorm.
 * User: Josafat
 * Date: 10/05/2016
 * Time: 05:30 PM
 */

namespace app\models;
use bubasuma\simplechat\db\Model;
use app\models\User;
use yii\db\ActiveQuery;



class Message extends Model
{

    public function getContact()
    {
        return $this->hasOne(User::className(), ['id' => 'contact_id']);
    }

    /**
     * @inheritDoc
     */
    public static function conversations($userId)
    {
        return parent::conversations($userId)->with([
            //...
            'contact' => function ($contact) {
                /**@var $contact ActiveQuery * */
                $contact->with([
                    //...
                ])->select(['id', ]);
            },
            //...
        ]);
    }

}