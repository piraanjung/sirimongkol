<?php

use yii\db\Migration;

/**
 * Class m180123_050536_insert_work_group_table
 */
class m180123_050536_insert_work_group_table extends Migration
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
    //     echo "m180123_050536_insert_work_group_table cannot be reverted.\n";

    //     return false;
    // }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

        /* งานก่อสร้างบ้าน */
        $this->insert('work_group', [
            'wg_name' => 'โครงสร้างบ้าน',
            'wc_id'   => 1
       ]);
       $this->insert('work_group', [
        'wg_name' => 'ก่อ-ฉาบ',
        'wc_id'   => 1
        ]);
        $this->insert('work_group', [
            'wg_name' => 'ฝ้า-เพดาน',
            'wc_id'   => 1
        ]);
        $this->insert('work_group', [
            'wg_name' => 'กระเบื้อง (1)',
            'wc_id'   => 1
        ]);
        $this->insert('work_group', [
            'wg_name' => 'สีบ้าน',
            'wc_id'   => 1
        ]);
        $this->insert('work_group', [
            'wg_name' => 'สีรั้ว',
            'wc_id'   => 1
        ]);
        $this->insert('work_group', [
            'wg_name' => 'งานอลูมิเนียม',
            'wc_id'   => 1
        ]);
        $this->insert('work_group', [
            'wg_name' => 'ประตูไม้เทียม',
            'wc_id'   => 1
        ]);
        $this->insert('work_group', [
            'wg_name' => 'สุขาภิบาล / สุขภัณฑ์',
            'wc_id'   => 1
        ]);
        $this->insert('work_group', [
            'wg_name' => 'ระบบไฟฟ้า',
            'wc_id'   => 1
        ]);
        $this->insert('work_group', [
            'wg_name' => 'พื้นคอนกรีตรอบบ้าน',
            'wc_id'   => 1
        ]);
        $this->insert('work_group', [
            'wg_name' => 'ตกแต่งบันได',
            'wc_id'   => 1
        ]);
        $this->insert('work_group', [
            'wg_name' => 'สวนรอบบ้าน',
            'wc_id'   => 1
        ]);
        $this->insert('work_group', [
            'wg_name' => 'Laminate  / Vinyl / บัว',
            'wc_id'   => 1
        ]);
        $this->insert('work_group', [
            'wg_name' => 'มิเตอร์น้ำประปา / ไฟฟ้า',
            'wc_id'   => 1
        ]);
        
        /* รั้วบ้าน / รั้วโครงการ */

        $this->insert('work_group', [
            'wg_name' => 'งานรั้วหล่อในที่-งานโครงสร้าง',
            'wc_id'   => 2
        ]);
        $this->insert('work_group', [
            'wg_name' => 'งานรั้วหล่อในที่-งานก่อ / ฉาบ',
            'wc_id'   => 2
        ]);
        $this->insert('work_group', [
            'wg_name' => 'ประตูรั้วและลูกกรงเหล็ก',
            'wc_id'   => 2
        ]);
        $this->insert('work_group', [
            'wg_name' => 'งานรั้วสำเร็จรูป',
            'wc_id'   => 2
        ]);

        /* งานเทถนน/ทางเท้า/คันหิน/รางตื้น /ท่อระบายน้ำ / บ่อพักน้ำ */

        $this->insert('work_group', [
            'wg_name' => 'ถนน / ทางเท้า',
            'wc_id'   => 3
        ]);
        $this->insert('work_group', [
            'wg_name' => 'คันหิน/รางตื้น',
            'wc_id'   => 3
        ]);
        $this->insert('work_group', [
            'wg_name' => 'ตะแกรง',
            'wc_id'   => 3
        ]);
        $this->insert('work_group', [
            'wg_name' => 'ท่อระบายน้ำ',
            'wc_id'   => 3
        ]);
        $this->insert('work_group', [
            'wg_name' => 'บ่อพักน้ำ',
            'wc_id'   => 3
        ]);
        $this->insert('work_group', [
            'wg_name' => 'บ่อตรวจ',
            'wc_id'   => 3
        ]);
    }

    public function down()
    {
        $this->dropTable('work_group');
    }
    
}
