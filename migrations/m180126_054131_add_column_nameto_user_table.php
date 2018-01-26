<?php

use yii\db\Migration;

/**
 * Class m180126_054131_add_column_nameto_user_table
 */
class m180126_054131_add_column_nameto_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'name', $this->string()->notNull())->after('username');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180126_054131_add_column_nameto_user_table cannot be reverted.\n";

        return false;
    }
    */
}
