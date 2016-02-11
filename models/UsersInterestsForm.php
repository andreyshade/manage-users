<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "users_interests".
 *
 * @property integer $user_interest_id
 * @property integer $user_id
 * @property integer $interest_id
 */
class UsersInterestsForm extends Model
{
    public $user_interest_id;
    public $user_id;
    public $interest_id;
    public $title;

    const FIELD_USER_INTEREST_ID = 'user_interest_id';
    const FIELD_USER_ID = 'user_id';
    const FIELD_INTEREST_ID = 'interest_id';
    const FIELD_TITLE = 'title';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[self::FIELD_TITLE], 'required'],
            [[self::FIELD_TITLE], 'filter', 'filter' => 'trim'],
            [[self::FIELD_TITLE], 'validateExistInterest'],
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
            self::FIELD_TITLE => 'Title'
        ];
    }
//    validate if the user already has same interest
    public function validateExistInterest($attribute, $params) {
        if ($interest = Interests::findOne([Interests::FIELD_TITLE => ucfirst($this->$attribute)])) {

            if (UsersInterests::findOne([UsersInterests::FIELD_USER_ID => Yii::$app->user->id, UsersInterests::FIELD_INTEREST_ID => $interest->interest_id])){
                $this->addError($attribute);
                Yii::$app->session->setFlash('danger', '"' . $this->$attribute . '" is exists in your interests list!');
            }
        }
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $this->title = ucfirst($this->title);
        $user_interest = new UsersInterests();
        $user_interest->user_id = Yii::$app->user->id;
        if (!$interest = Interests::findOne([Interests::FIELD_TITLE => $this->title])) {
            $interest = new Interests();
            $interest->title = $this->title;
            $interest->save();
        }
        $user_interest->interest_id = $interest->interest_id;
        $user_interest->save();
        return true;
    }
}
