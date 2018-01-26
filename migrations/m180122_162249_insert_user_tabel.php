<?php

use yii\db\Migration;
use dektrium\user\helpers\Password;

/**
 * Class m180122_162249_insert_user_tabel
 */
class m180122_162249_insert_user_tabel extends Migration
{

    public function up()
    {
        $this->insert('user', [
            'username'          => 'admin',
            'email'             => 'user1@gmail.com',
            'password_hash'     => Password::hash('123456'), 
            'auth_key'          => 1234, 
            'confirmed_at'      => 0, 
            'unconfirmed_email' => 'admin@gmail.com',
            'blocked_at'        => 0, 
            'registration_ip'   => 'admin@gmail.com',
            'created_at'        => strtotime("now"), 
            'updated_at'        => strtotime("now"), 
            'flags'             => 1, 
            'last_login_at'     => 0,
            'user_type_id'      => 1
       ]);
       
       $this->insert('user', [
        'username'          => 'ceo',
        'email'             => 'ceo@gmail.com',
        'password_hash'     => Password::hash('123456'), 
        'auth_key'          => 1234, 
        'confirmed_at'      => 0, 
        'unconfirmed_email' => 'ceo@gmail.com',
        'blocked_at'        => 0, 
        'registration_ip'   => 'ceo@gmail.com',
        'created_at'        => strtotime("now"), 
        'updated_at'        => strtotime("now"), 
        'flags'             => 1, 
        'last_login_at'     => 0,
        'user_type_id'      => 3
   ]);     
    }

    public function down()
    {
        echo "m180122_162249_insert_user_tabel cannot be reverted.\n";

        $this->dropTable('user');
    }
    
}
