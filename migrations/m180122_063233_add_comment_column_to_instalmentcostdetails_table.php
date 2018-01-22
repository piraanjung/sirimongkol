<?php

use yii\db\Migration;

/**
 * Handles adding comment to table `instalmentcostdetails`.
 */
class m180122_063233_add_comment_column_to_instalmentcostdetails_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('instalmentcostdetails', 'comment', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('instalmentcostdetails');
    }
}
