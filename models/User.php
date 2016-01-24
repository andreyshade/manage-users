<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\Users;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    public static function tableName() {
		return 'users';
	}

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne([Users::FIELD_ACCESS_TOKEN => $token]);
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne([Users::FIELD_LOGIN => $username]);
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
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
		try {
			// need for suppord passwords from old database
			if (!$this->passwordHash) {
				$userPassword = $this->decodePassword($this->password, $this->salt);
				if ($userPassword === NULL) {
					return FALSE;
				}
				return $password == $userPassword;
			}
			return Yii::$app->security->validatePassword($password, $this->passwordHash);
		} catch (\yii\base\InvalidParamException $ex) {
			return FALSE;
		}
	}

    /**
	 * decode old user password
	 * @param string $hash old encoded password
	 * @param string $salt
	 * @return string
	 */
	protected function decodePassword($hash, $salt) {
		if (!$salt) {
			return $hash;
		}
		//  SALT NEED TO BE EXACTLY 10 DIGIT
		if (strlen($salt) != 10) {
			return NULL;
		}
		$array = str_split($salt);

		$nmbOne = 0;
		$nmbTwo = 0;
		$nmbThree = 0;

		for ($i = 0; $i < 10; $i++) {
			if ($i < 5)
				$nmbOne += $array[$i];
			else
				$nmbTwo += $array[$i];
		}

		$nmbThree = ($nmbOne * $nmbOne) + ($nmbTwo + $nmbTwo);

		$array = preg_split('@[a-zA-Z]+@', $hash);
		$psw = '';
		$i = 0;
		foreach ($array as $letter) {
			if ($i == 0) {
				$letter = $letter - $nmbOne;
				$i++;
			} else if ($i == 1) {
				$letter = $letter / $nmbTwo;
				$i++;
			} else if ($i == 2) {
				$letter = $letter - $nmbThree;
				$i++;
			} else {
				$i = 0;
			}
			$letter = chr($letter);
			$psw = $psw . $letter;
		}
		return $psw;
	}

}
