<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tutor".
 *
 * @property integer $id
 * @property string $firstName
 * @property string $lastName
 * @property string $gender
 * @property string $area
 * @property string $email
 */
class Tutor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tutor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'firstName', 'lastName', 'gender', 'area', 'email'], 'required'],
            [['id'], 'integer'],
            [['firstName', 'lastName', 'gender', 'area', 'email'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'firstName' => Yii::t('app', 'First Name'),
            'lastName' => Yii::t('app', 'Last Name'),
            'gender' => Yii::t('app', 'Gender'),
            'area' => Yii::t('app', 'Area'),
            'email' => Yii::t('app', 'Email'),
        ];
    }
}
