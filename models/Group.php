<?php

namespace app\models;

use Yii;
use app\models\Assign;
/**
 * This is the model class for table "group".
 *
 * @property integer $id
 * @property integer $tutor_id
 * @property string $name
 *
 * @property Assign[] $assigns
 * @property Files[] $files
 * @property User $tutor
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tutor_id'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['tutor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['tutor_id' => 'id']],

            /*[['group_id'], 'integer'],
            //[['name'], 'string', 'max' => 45],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']], */
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID group'),
            'tutor_id' => Yii::t('app', 'Tutor'),
            'name' => Yii::t('app', 'Name group'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssigns()
    {
        return $this->hasMany(Assign::className(), ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTutor()
    {
        return $this->hasOne(User::className(), ['id' => 'tutor_id']);
    }
}
