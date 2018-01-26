<?php

use yii\db\Migration;

/**
 * Class m180118_073833_add_usertype_field_to_user
 */
class m180118_073833_add_usertype_field_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'user_type_id', \yii\db\Schema::TYPE_STRING)->after('username');
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'user_type_id');
    }

}
