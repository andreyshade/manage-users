<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_interests".
 *
 * @property integer $user_interest_id
 * @property integer $user_id
 * @property integer $interest_id
 */
class UsersInterests extends \yii\db\ActiveRecord
{
    const FIELD_USER_INTEREST_ID = 'user_interest_id';
    const FIELD_USER_ID = 'user_id';
    const FIELD_INTEREST_ID = 'interest_id';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_interests';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[self::FIELD_USER_ID, self::FIELD_INTEREST_ID], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            self::FIELD_USER_INTEREST_ID => 'User Interest ID',
            self::FIELD_USER_ID => 'User ID',
            self::FIELD_INTEREST_ID => 'Interest ID',
        ];
    }
}
