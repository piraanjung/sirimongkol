<?php

use yii\db\Migration;

/**
 * Handles the creation of table `house_model_have_workgroup`.
 */
class m180221_091416_create_house_model_have_workgroup_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('house_model_have_workgroup', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('house_model_have_workgroup');
    }
}
