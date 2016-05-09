<?php

namespace app\models;

use Yii;
use app\models\Group;

/**
 * This is the model class for table "file".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $file_name
 * @property integer $group_id
 *
 * @property Group $group
 */
class File extends \yii\db\ActiveRecord
{
    public $board_file;
    public $isGroupFile = 0;
    
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
            [['name'], 'required'],
            [['group_id'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 400],
            [['file_name'], 'string', 'max' => 200],
            [['board_file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, png, jpg, jpeg, bmp, doc, docx, mp3'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['isGroupFile'], 'boolean'],
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
            'file_name' => Yii::t('app', 'File'),
            'board_file' => Yii::t('app', 'File'),
            'isGroupFile' => Yii::t('app', 'Visibility'),
            'group_id' => Yii::t('app', 'Group'),
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
			$fileName = uniqid() . '.' . $this->board_file->extension;
			$this->board_file->saveAs('files/files/' . $fileName);
			$this->file_name = $fileName;
            
			return true;
		}
		return false;
	}
}