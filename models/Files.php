<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $path
 * @property integer $group_id
 * @property integer $show_all
 * @property string $type
 *
 * @property Group $group
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'path', 'show_all'], 'required'],
            [['group_id', 'show_all'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 400],
            [['path'], 'string', 'max' => 200],
            [['type'], 'string', 'max' => 10],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'path' => Yii::t('app', 'Path'),
            'group_id' => Yii::t('app', 'Group ID'),
            'show_all' => Yii::t('app', 'Show All'),
            'type' => Yii::t('app', 'Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }
}
