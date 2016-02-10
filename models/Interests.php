<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "interests".
 *
 * @property integer $interest_id
 * @property string $title
 */
class Interests extends \yii\db\ActiveRecord
{
    const FIELD_INTEREST_ID = 'interest_id';
    const FIELD_TITLE = 'title';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'interests';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[self::FIELD_TITLE], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            self::FIELD_INTEREST_ID => 'Interest ID',
            self::FIELD_TITLE => 'Title',
        ];
    }
}
