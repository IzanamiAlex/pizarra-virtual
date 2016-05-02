<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $file
 * @property integer $group_id
 *
 * @property Group $group
 */
class File extends \yii\db\ActiveRecord
{
    public $board_file;
    public $group_file = 0;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'file'], 'required'],
            [['group_id'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 400],
            [['file'], 'string', 'max' => 200],
            [['board_file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, png, jpg, jpeg, bmp, doc, docx'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['group_file'], 'boolean'],
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
            'file' => Yii::t('app', 'File'),
            'board_file' => Yii::t('app', 'File'),
            'group_file' => Yii::t('app', 'Visibility'),
            'group_id' => Yii::t('app', 'Group ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }
    
    public function beforeSave($insert)
	{
		if(parent::beforeSave($insert))
		{
			// FILE
			$fileName = uniqid() . '.' . $this->board_file->extension;
			$this->board_file->saveAs('files/files/' . $fileName);
			$this->file = $fileName;
            
			return true;
		}
		return false;
	}
}
