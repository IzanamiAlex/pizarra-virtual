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
 * @property integer $user_id
 *
 * @property Group[] $groups
 * @property User $user
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
            [['id', 'user_id'], 'integer'],
            [['firstName', 'lastName', 'gender', 'area', 'email'], 'string', 'max' => 45],
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
            'gender' => Yii::t('app', 'Gender'),
            'area' => Yii::t('app', 'Area'),
            'email' => Yii::t('app', 'Email'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['tutor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
