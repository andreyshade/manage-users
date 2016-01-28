<?php
/**
 * Created by PhpStorm.
 * User: andreyshade
 * Date: 25.01.16
 * Time: 0:41
 */

namespace app\models;

use yii;
use yii\base\Model;
use app\models\User;

class RegistrationForm extends Model {
    const FIELD_LOGIN = 'login';
    const FIELD_PASSWORD = 'password';
    const FIELD_PASSWORD_CONFIRM = 'password_confirm';

    public $login;
    public $password;
    public $password_confirm;

    public function rules() {
        return [
            [[self::FIELD_LOGIN, self::FIELD_PASSWORD, self::FIELD_PASSWORD_CONFIRM], 'required'],
            [self::FIELD_PASSWORD, 'string', 'min' => 6],
            [[self::FIELD_LOGIN, self::FIELD_PASSWORD, self::FIELD_PASSWORD_CONFIRM], 'filter', 'filter' => 'trim'],
            [self::FIELD_LOGIN, 'validateIfExists'],
            [self::FIELD_PASSWORD_CONFIRM, 'compare', 'compareAttribute' => self::FIELD_PASSWORD,
                'message' => 'The password and confirm password do not match.'
            ],
        ];
    }

    public function validateIfExists($attribute, $params){
        if ($this->hasErrors()) {
            return false;
        }
        if ($attribute == self::FIELD_LOGIN && $this->login) {
            if (Users::find()->where([Users::FIELD_LOGIN => $this->login])->exists()) {
                $this->addError($attribute, 'User with this login already exists');
            }
        }
        return true;
    }


    public function attributeLabels() {
        return [
            self::FIELD_LOGIN => 'Login',
            self::FIELD_PASSWORD => 'Password',
            self::FIELD_PASSWORD_CONFIRM => 'Confirm',
        ];
    }

    public function register() {
        if (!$this->validate()) {
            return false;
        }
        $user = new Users;
        $user->login = $this->login;
        $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        $user->save();


        Yii::$app->user->login(User::findByUsername($this->login), 3600 * 24 * 30);

        return true;

    }

}