<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m160210_201716_create_users_interests_table extends Migration
{
    public function up()
    {
        $this->createTable('users_interests', [
            'user_interest_id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER,
            'interest_id' => Schema::TYPE_INTEGER
        ]);
    }

    public function down()
    {
        $this->dropTable('users_interests');
    }
}
