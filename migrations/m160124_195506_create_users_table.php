<?php

use yii\db\Migration;
use yii\db\pgsql\Schema;

class m160124_195506_create_users_table extends Migration
{
    public function up()
    {
        $this->createTable('users', [
            'user_id' => Schema::TYPE_PK,
            'login' => Schema::TYPE_STRING,
            'password_hash' => Schema::TYPE_STRING,
            'first_name' => Schema::TYPE_STRING,
            'last_name' => Schema::TYPE_STRING,
            'date_of_birth' => Schema::TYPE_DATE
        ]);
    }

    public function down()
    {
        $this->dropTable('users');
    }
}
