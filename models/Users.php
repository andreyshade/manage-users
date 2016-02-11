<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $user_id
 * @property string $login
 * @property string $password_hash
 * @property string $first_name
 * @property string $last_name
 * @property string $date_of_birth
 */
class Users extends \yii\db\ActiveRecord {
    const FIELD_USER_ID = 'user_id';
    const FIELD_LOGIN = 'login';
    const FIELD_PASSWORD_HASH = 'password_hash';
    const FIELD_FIRST_NAME = 'first_name';
    const FIELD_LAST_NAME = 'last_name';
    const FIELD_DATE_OF_BIRTH = 'date_of_birth';

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [[self::FIELD_DATE_OF_BIRTH], 'safe'],
            [[self::FIELD_LOGIN, self::FIELD_PASSWORD_HASH, self::FIELD_FIRST_NAME, self::FIELD_LAST_NAME], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            self::FIELD_USER_ID => 'User ID',
            self::FIELD_LOGIN => 'Login',
            self::FIELD_FIRST_NAME => 'First Name',
            self::FIELD_LAST_NAME => 'Last Name',
            self::FIELD_DATE_OF_BIRTH => 'Date Of Birth',
        ];
    }

    public function getFullName() {
        if (!$this->first_name && !$this->last_name) {
            return false;
        }
        return $this->first_name . ' ' . $this->last_name;
    }

    const RELATION_INTRESERTS = 'interests';
    public function getInterests() {
        return $this->hasMany(UsersInterests::className(), [UsersInterests::FIELD_USER_ID => self::FIELD_USER_ID]);
    }

}
