<?php
/**
 * Created by PhpStorm.
 * User: andreyshade
 * Date: 28.01.16
 * Time: 12:51
 */

namespace app\models;

use DateTime;
use yii\base\Model;
use app\models\Users;

class PersonalDetailsForm extends Model {
    const FIELD_LOGIN = 'login';
    const FIELD_FIRST_NAME = 'first_name';
    const FIELD_LAST_NAME = 'last_name';
    const FIELD_DATE_OF_BIRTH = 'date_of_birth';
    const FIELD_PROGRAMMING = 'programming';
    const FIELD_SPORT = 'sport';
    const FIELD_HUNTING = 'hunting';
    const FIELD_VIDEO_GAMES = 'video_games';
    const FIELD_TRAVELING = 'traveling';

    public $login;
    public $first_name;
    public $last_name;
    public $date_of_birth;
    public $programming;
    public $sport;
    public $hunting;
    public $video_games;
    public $traveling;

    public function rules() {
        return [
            [[self::FIELD_LOGIN], 'required'],
            [[self::FIELD_LOGIN], 'validateIfExists'],
            [[self::FIELD_DATE_OF_BIRTH], 'date', 'format' => 'dd/mm/yyyy'],
            [[self::FIELD_FIRST_NAME, self::FIELD_LAST_NAME], 'string'],
            [[self::FIELD_PROGRAMMING, self::FIELD_SPORT, self::FIELD_HUNTING, self::FIELD_VIDEO_GAMES, self::FIELD_TRAVELING], 'boolean']
        ];
    }

    public function validateIfExists($attribute, $params){
        if ($this->hasErrors()) {
            return false;
        }
        if ($attribute == self::FIELD_LOGIN && $this->login) {
            $user = Users::findOne(\Yii::$app->user->id);
            if ($this->login == $user->login) {
                return true;
            }
            if (Users::find()->where([Users::FIELD_LOGIN => $this->login])->exists()) {
                $this->addError($attribute, 'User with this login already exists');
            }
        }
        return true;
    }

    public function attributeLabels() {
        return [
            self::FIELD_LOGIN => 'Login',
            self::FIELD_FIRST_NAME => 'First Name',
            self::FIELD_LAST_NAME => 'Last Name',
            self::FIELD_DATE_OF_BIRTH => 'Date of Birth',
            self::FIELD_PROGRAMMING =>  'Programming',
            self::FIELD_SPORT => 'Sport',
            self::FIELD_HUNTING =>'Hunting',
            self::FIELD_VIDEO_GAMES => 'Video Games',
            self::FIELD_TRAVELING => 'Traveling'
        ];
    }

    public function initForm($model) {
        /* @var Users $model */
        $this->login = $model->login;
        $this->first_name = $model->first_name;
        $this->last_name = $model->last_name;
        if ($model->date_of_birth) {
            $this->date_of_birth = DateTime::createFromFormat('Y-m-d', $model->date_of_birth)->format('d/m/Y');
        } else {
            $this->date_of_birth = null;
        }
    }

    public function save() {
        if (!$this->validate()) {
            return false;
        }
        $model = Users::findOne(\Yii::$app->user->id);
        /* @var Users $model */
        $model->login = $this->login;
        $model->first_name = $this->first_name;
        $model->last_name = $this->last_name;
        if ($this->date_of_birth) {
            $model->date_of_birth = DateTime::createFromFormat('d/m/Y', $this->date_of_birth)->format('Y-m-d');
        } else {
            $model->date_of_birth = null;
        }
        $model->save();
        return true;
    }
}