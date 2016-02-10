<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use app\models\Users;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    public static function tableName() {
		return 'users';
	}

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implement');
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne([Users::FIELD_LOGIN => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->user_id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
//        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
		return Yii::$app->security->validatePassword($password, $this->password_hash);
	}

}
