<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $auth_key
 * @property string $access_token
 * @property string $type
 *
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
  public $password;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['password'], 'required', 'except' => ['update']],
            [['username'], 'string', 'max' => 128],
      			[['password'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 40],
            [['last_name'], 'string', 'max' => 40],
            [['email'], 'string', 'max' => 40],

          //  [['id', 'username', 'password_hash', 'type'], 'required'],
          //  [['id'], 'integer'],
          //  [['username', 'type'], 'string', 'max' => 45],
          //  [['password_hash'], 'string', 'max' => 200],
          //  [['auth_key', 'access_token'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'access_token' => Yii::t('app', 'Access Token'),
            'name' => Yii::t('app', 'Name'),
            'last_name' => Yii::t('app', 'Last name'),
            'email' => Yii::t('app', 'Email'),
            //'type' => Yii::t('app', 'Type'),
        ];
    }


    /**
     * -Convert the password in to password_hash and add the auth_key and the Token.
     */
    public function beforeSave($insert)
  	{
  		if(parent::beforeSave($insert))
  		{
  			if($this->isNewRecord)
  			{
  				$this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($this->password);
  				$this->auth_key = Yii::$app->getSecurity()->generateRandomString();
  				$this->access_token = Yii::$app->getSecurity()->generateRandomString();
  			}
  			else
  			{
  				if( !empty($this->password) )
  				{
  					$this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($this->password);
  				}
  			}
  			return true;
  		}
  		return false;
  	}

    /**
       * @inheritdoc
       */
    public static function findIdentity($id)
    {
      return self::findOne($id);
    }

    /**
       * @inheritdoc
       */
    public static function findIdentityByAccessToken($token, $type = null)
    {
      foreach (self::$users as $user) {
          if ($user['accessToken'] === $token) {
              return new static($user);
          }
      }

      return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::findOne(['username'=>$username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        // return $this->password === $password;
		return Yii::$app->getSecurity()->validatePassword($password,$this->password_hash);
    }
}
