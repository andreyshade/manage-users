<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $login
 * @property string $secret
 * @property string $first_name
 * @property string $last_name
 * @property string $date_of_birth
 * @property integer $programming
 * @property integer $sport
 * @property integer $hunting
 * @property integer $video_games
 * @property integer $traveling
 */
class Users extends \yii\db\ActiveRecord
{
    const FIELD_ID = 'id';
    const FIELD_LOGIN = 'login';
    const FIELD_SECRET = 'secret';
    const FIELD_FIRST_NAME = 'first_name';
    const FIELD_LAST_NAME = 'last_name';
    const FIELD_DATE_OF_BIRTH = 'date_of_birth';
    const FIELD_PROGRAMMING = 'programming';
    const FIELD_SPORT = 'sport';
    const FIELD_HUNTING = 'hunting';
    const FIELD_VIDEO_GAMES = 'video_games';
    const FIELD_TRAVELING = 'traveling';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[self::FIELD_DATE_OF_BIRTH], 'safe'],
            [[self::FIELD_PROGRAMMING, self::FIELD_SPORT, self::FIELD_HUNTING, self::FIELD_VIDEO_GAMES, self::FIELD_TRAVELING], 'integer'],
            [[self::FIELD_LOGIN, self::FIELD_SECRET, self::FIELD_FIRST_NAME, self::FIELD_LAST_NAME], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            self::FIELD_ID => 'ID',
            self::FIELD_LOGIN => 'Login',
            self::FIELD_FIRST_NAME => 'First Name',
            self::FIELD_LAST_NAME => 'Last Name',
            self::FIELD_DATE_OF_BIRTH => 'Date Of Birth',
            self::FIELD_PROGRAMMING => 'Programming',
            self::FIELD_SPORT => 'Sport',
            self::FIELD_HUNTING => 'Hunting',
            self::FIELD_VIDEO_GAMES => 'Video Games',
            self::FIELD_TRAVELING => 'Traveling',
        ];
    }
}
