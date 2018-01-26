<?php

use yii\db\Migration;

/**
 * Class m180125_113844_insert_house_table
 */
class m180125_113844_insert_house_table extends Migration
{
    // /**
    //  * @inheritdoc
    //  */
    // public function safeUp()
    // {

    // }

    // /**
    //  * @inheritdoc
    //  */
    // public function safeDown()
    // {
    //     echo "m180125_113844_insert_house_table cannot be reverted.\n";

    //     return false;
    // }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->insert('houses',[
            'house_name' => '85 A',
            'house_model_id' => 1,
            'project_id' => 6,
            'house_status' => 0,
            'create_date' => date('Y-m-d'),
            'update_date' => date('Y-m-d'),

        ]);

        $this->insert('houses',[
            'house_name' => '101 A',
            'house_model_id' => 1,
            'project_id' => 6,
            'house_status' => 0,
            'create_date' => date('Y-m-d'),
            'update_date' => date('Y-m-d'),

        ]);

        $this->insert('houses',[
            'house_name' => '103 A',
            'house_model_id' => 1,
            'project_id' => 6,
            'house_status' => 0,
            'create_date' => date('Y-m-d'),
            'update_date' => date('Y-m-d'),

        ]);
        $this->insert('houses',[
            'house_name' => '104 A',
            'house_model_id' => 1,
            'project_id' => 6,
            'house_status' => 0,
            'create_date' => date('Y-m-d'),
            'update_date' => date('Y-m-d'),

        ]);
        $this->insert('houses',[
            'house_name' => '89 A',
            'house_model_id' => 1,
            'project_id' => 6,
            'house_status' => 0,
            'create_date' => date('Y-m-d'),
            'update_date' => date('Y-m-d'),

        ]);
    }

    public function down()
    {
        $this->dropTable('houses');
    }

}
