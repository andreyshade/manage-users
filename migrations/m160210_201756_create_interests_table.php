<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m160210_201756_create_interests_table extends Migration
{
    public function up()
    {
        $this->createTable('interests', [
            'interest_id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING
        ]);
    }

    public function down()
    {
        $this->dropTable('interests');
    }
}
