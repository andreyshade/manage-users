<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $login
 * @property string $password_hash
 * @property string $first_name
 * @property string $last_name
 * @property string $date_of_birth
 * @property integer $programming
 * @property integer $sport
 * @property integer $hunting
 * @property integer $video_games
 * @property integer $traveling
 */
class Users extends \yii\db\ActiveRecord {
    const FIELD_ID = 'id';
    const FIELD_LOGIN = 'login';
    const FIELD_PASSWORD_HASH = 'password_hash';
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
    public static function tableName() {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [[self::FIELD_DATE_OF_BIRTH], 'safe'],
            [[self::FIELD_PROGRAMMING, self::FIELD_SPORT, self::FIELD_HUNTING, self::FIELD_VIDEO_GAMES, self::FIELD_TRAVELING], 'integer'],
            [[self::FIELD_LOGIN, self::FIELD_PASSWORD_HASH, self::FIELD_FIRST_NAME, self::FIELD_LAST_NAME], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
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

    public function getFullName() {
        if (!$this->first_name && !$this->last_name) {
            return false;
        }
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getInterestsList() {
        $interests = '<div class="text-warning">No interests</div>';

        if ($user = Users::findOne($this->id)) {
            if ($user->programming || $user->sport || $user->hunting || $user->video_games || $user->traveling) {
                $interests = null;
                if ($user->programming) {
                    $interests .= '<li>' . $user->getAttributeLabel(self::FIELD_PROGRAMMING) . '</li>';
                }
                if ($user->sport) {
                    $interests .= '<li>' . $user->getAttributeLabel(self::FIELD_SPORT) . '</li>';
                }
                if ($user->hunting) {
                    $interests .= '<li>' . $user->getAttributeLabel(self::FIELD_HUNTING) . '</li>';
                }
                if ($user->video_games) {
                    $interests .= '<li>' . $user->getAttributeLabel(self::FIELD_VIDEO_GAMES) . '</li>';
                }
                if ($user->traveling) {
                    $interests .= '<li>' . $user->getAttributeLabel(self::FIELD_TRAVELING) . '</li>';
                }
                $interests = 'Interests:<ul class="text-left" >' . $interests . '</ul>';
            }
        }

        return $interests;
    }
}
