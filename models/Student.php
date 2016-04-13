<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property integer $id
 * @property string $firstName
 * @property string $lastName
 * @property string $birthdate
 * @property string $gender
 * @property string $email
 * @property string $career
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'firstName', 'lastName', 'birthdate', 'gender', 'email', 'career'], 'required'],
            [['id'], 'integer'],
            [['birthdate'], 'safe'],
            [['firstName', 'lastName', 'gender', 'email', 'career'], 'string', 'max' => 45]
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
            'birthdate' => Yii::t('app', 'Birthdate'),
            'gender' => Yii::t('app', 'Gender'),
            'email' => Yii::t('app', 'Email'),
            'career' => Yii::t('app', 'Career'),
        ];
    }
}
