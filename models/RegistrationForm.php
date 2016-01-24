<?php
/**
 * Created by PhpStorm.
 * User: andreyshade
 * Date: 25.01.16
 * Time: 0:41
 */

namespace app\models;


use yii\base\Model;

class RegistrationForm extends Model {
    const FIELD_LOGIN = 'login';
    const FIELD_PASSWORD = 'password';
    const FIELD_PASSWORD_CONFIRM = 'password_confirm';

    public $login;
    public $password;
    public $password_confirm;

    public function attributeLabels()
    {
        return [
            self::FIELD_LOGIN => 'Login',
            self::FIELD_PASSWORD => 'Password',
            self::FIELD_PASSWORD_CONFIRM => 'Confirm',
        ];
    }

}