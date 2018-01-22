<?php

use yii\db\Migration;

/**
 * Class m180122_162249_insert_user_tabel
 */
class m180122_162249_insert_user_tabel extends Migration
{
    /**
     * @inheritdoc
     */
    // public function safeUp()
    // {

    // }

    // /**
    //  * @inheritdoc
    //  */
    // public function safeDown()
    // {
    //     echo "m180122_162249_insert_user_tabel cannot be reverted.\n";

    //     return false;
    // }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->insert('user', [
            'username'          => 'user1',
            'email'             => 'user1@gmail.com',
            'password_hash'     => '$2y$12$hW7aA2Dp3pn2UAENbckUse1kUq6s37HH5IQzy27fBzoM6sideD53O', 
            'auth_key'          => 1234, 
            'confirmed_at'      => 0, 
            'unconfirmed_email' => 'user1@gmail.com',
            'blocked_at'        => 0, 
            'registration_ip'   => 'user1@gmail.com',
            'created_at'        => 1, 
            'updated_at'        => 1, 
            'flags'             => 1, 
            'last_login_at'     => 1,
            'user_type_id'      => 2
       ]);
       
       $this->insert('user', [
        'username'          => 'ceo',
        'email'             => 'ceo@gmail.com',
        'password_hash'     => '$2y$12$hW7aA2Dp3pn2UAENbckUse1kUq6s37HH5IQzy27fBzoM6sideD53O', 
        'auth_key'          => 1234, 
        'confirmed_at'      => 0, 
        'unconfirmed_email' => 'ceo@gmail.com',
        'blocked_at'        => 0, 
        'registration_ip'   => 'ceo@gmail.com',
        'created_at'        => 1, 
        'updated_at'        => 1, 
        'flags'             => 1, 
        'last_login_at'     => 1,
        'user_type_id'      => 3
   ]);     
    }

    public function down()
    {
        echo "m180122_162249_insert_user_tabel cannot be reverted.\n";

        $this->dropTable('user');
    }
    
}
