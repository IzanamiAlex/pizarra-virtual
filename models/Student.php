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
 * @property integer $user_id
 *
 * @property Assign[] $assigns
 * @property User $user
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
            [['id', 'user_id'], 'integer'],
            [['birthdate'], 'safe'],
            [['firstName', 'lastName', 'gender', 'email', 'career'], 'string', 'max' => 45],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssigns()
    {
        return $this->hasMany(Assign::className(), ['student_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
