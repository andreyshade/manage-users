<?php

use yii\db\Migration;
use yii\db\pgsql\Schema;

class m160124_195506_create_users_table extends Migration
{
    public function up()
    {
        $this->createTable('users', [
            'id' => Schema::TYPE_PK,
            'login' => Schema::TYPE_STRING,
            'password_hash' => Schema::TYPE_STRING,
            'salt' => Schema::TYPE_STRING,
            'first_name' => Schema::TYPE_STRING,
            'last_name' => Schema::TYPE_STRING,
            'date_of_birth' => Schema::TYPE_DATE,
            'programming' => Schema::TYPE_BOOLEAN,
            'sport' => Schema::TYPE_BOOLEAN,
            'hunting' => Schema::TYPE_BOOLEAN,
            'video_games' => Schema::TYPE_BOOLEAN,
            'traveling' => Schema::TYPE_BOOLEAN
        ]);
    }

    public function down()
    {
        $this->dropTable('users');
    }
}
