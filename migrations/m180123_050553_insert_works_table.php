<?php

use yii\db\Migration;

/**
 * Class m180123_050553_insert_works_table
 */
class m180123_050553_insert_works_table extends Migration
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
    //     echo "m180123_050553_insert_works_table cannot be reverted.\n";

    //     return false;
    // }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {  
        /* เตรียมงาน */
        //$this->insert('')
       /* โครงสร้างบ้าน */
        $this->insert('works', [
            'work_name' => 'ฐานราก และ คานคอดิน',
            'wg_id'   => 1,
            'work_control_statement' => 100
       ]);
       $this->insert('works', [
        'work_name' => 'พื้น คาน เสาชั้น 1',
        'wg_id'   => 1,
        'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'คาน ชั้น 2',
            'wg_id'   => 1,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'พื้น + เสา ชั้น 2',
            'wg_id'   => 1,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'บันได',
            'wg_id'   => 1,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'Clearingและแก้ไขงาน',
            'wg_id'   => 1,
            'work_control_statement' => 100
        ]);

     /* ก่อ - ฉาบ */
        $this->insert('works', [
            'work_name' => 'งานก่อ+เอ็น ชั้น 1',
            'wg_id'   => 2,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานก่อ+เอ็น ชั้น 2',
            'wg_id'   => 2,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานเหลี่ยม+ร่อง+ฉาบ ชั้น 1  ภายนอก',
            'wg_id'   => 2,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งงานเหลี่ยม+ร่อง+ฉาบ ชั้น 2  ภายนอก',
            'wg_id'   => 2,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานขอบกันน้ำ',
            'wg_id'   => 2,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานเหลี่ยม+ร่อง+ฉาบ ชั้น 1  ภายใน ',
            'wg_id'   => 2,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานเหลี่ยม+ร่อง+ฉาบ ชั้น 2  ภายใน ',
            'wg_id'   => 2,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานตั้งวงกบประตู',
            'wg_id'   => 2,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานเคาน์เตอร์ห้องครัว ห้องน้ำ',
            'wg_id'   => 2,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานตกแต่งระเบียง (ม้านั่ง  เสาโชว์ ขอบ/คิ้วต่างๆ)',
            'wg_id'   => 2,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานฉาบ+ปรับระดับ บันได',
            'wg_id'   => 2,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานบันไดลงโถงใต้บันได',
            'wg_id'   => 2,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานเท Topping',
            'wg_id'   => 2,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งาน Clearing',
            'wg_id'   => 2,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'บัวและรางระบายน้ำ',
            'wg_id'   => 2,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานแก้ไข / เพิ่มเติม ระบุ',
            'wg_id'   => 2,
            'work_control_statement' => 100
        ]);

        /* ฝ้า - เพดาน */
        $this->insert('works', [
            'work_name' => 'ติดตั้งฝ้าภายนอกใต้ชายคาแล้วเสร็จ',
            'wg_id'   => 3,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ติดตั้งโครงเคร่าแล้วเสร็จทั้งหมด(ยกเว้นห้องน้ำ+ห้องครัว)',
            'wg_id'   => 3,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ติดตั้งแผ่นฝ้า+ ฉาบ+เก็บงาน แล้วเสร็จทั้งหมด(ยกเว้นห้องน้ำ)',
            'wg_id'   => 3,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ติดตั้งแผ่นฝ้า+ ฉาบ+เก็บงาน (ห้องน้ำ + ห้องครัว)',
            'wg_id'   => 3,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ประกันผลงาน',
            'wg_id'   => 3,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานแก้ไข / เพิ่มเติม ระบุ',
            'wg_id'   => 3,
            'work_control_statement' => 100
        ]);

        /* กระเบื้อง (1) */
        $this->insert('works', [
            'work_name' => 'ห้องครัว งานฉาบหยาบ',
            'wg_id'   => 4,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'กระเบื้องพื้น + ผนัง เคาน์เตอร์',
            'wg_id'   => 4,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ห้องน้ำรวม - ล่าง  งานฉาบหยาบ - กระเบื้องพื้น + ผนัง',
            'wg_id'   => 4,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ห้องน้ำรวม - บน  งานฉาบหยาบ',
            'wg_id'   => 4,
            'work_control_statement' => 100
        ]);

        $this->insert('works', [
            'work_name' => 'ห้องน้ำ Master  งานฉาบหยาบ - กระเบื้องพื้น + ผนัง',
            'wg_id'   => 4,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ระเบียง ชั้นล่าง',
            'wg_id'   => 4,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ระเบียง ชั้นบน',
            'wg_id'   => 4,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'พิ้นบ้าน ชั้นล่าง',
            'wg_id'   => 4,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานติดตั้งเคาน์เตอร์หินแกรนิต',
            'wg_id'   => 4,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานแก้ไข / เพิ่มเติม  ระบุ',
            'wg_id'   => 4,
            'work_control_statement' => 100
        ]);

        /* สีบ้าน */
        $this->insert('works', [
            'work_name' => 'งานทาสีรองพื้น',
            'wg_id'   => 5,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานทาสีจริง รอบที่ 1',
            'wg_id'   => 5,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานทาสีจริง รอบที่ 2',
            'wg_id'   => 5,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานฉาบบางพื้นกันสาด',
            'wg_id'   => 5,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'สีประตูและวงกบ',
            'wg_id'   => 5,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ประกัน',
            'wg_id'   => 5,
            'work_control_statement' => 100
        ]);

        /* สีรั้ว */
          $this->insert('works', [
            'work_name' => 'สีรั้ว',
            'wg_id'   => 6,
            'work_control_statement' => 100
        ]);
        
        /* งานอลูมิเนียม */
        $this->insert('works', [
            'work_name' => 'งานติดตั้งประตู+หน้าต่างอลูมิเนียม',
            'wg_id'   => 7,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ประตูช่องเก็บของ (บานเปิดมีลูกเกล็ด)',
            'wg_id'   => 7,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานตกแต่งระเบียงชั้น 2',
            'wg_id'   => 7,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานแก้ไข / เพิ่มเติม  ระบุ',
            'wg_id'   => 7,
            'work_control_statement' => 100
        ]);

        /* ประตูไม้เทียม */
        $this->insert('works', [
            'work_name' => 'ติดตั้งประตู',
            'wg_id'   => 8,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ติดตั้งกันชนประตู',
            'wg_id'   => 8,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ติดตั้งซับวงกบ',
            'wg_id'   => 8,
            'work_control_statement' => 100
        ]);

        /*สุขาภิบาล / สุขภัณฑ์*/
        $this->insert('works', [
            'work_name' => 'งวดงานที่ 1 วางสลิฟห้องน้ำ รวม - ล่าง',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งวดงานที่ 1 วางสลิฟห้องน้ำ รวม - บน',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งวดงานที่ 3 วางสลิฟห้องน้ำ Master',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งวดงานที่ 4 ตั้งท่อในช่องท่อและเดินท่อรับห้องน้ำ รวม - บน',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งวดงานที่ 5 ตั้งท่อในช่องท่อและเดินท่อรับห้องน้ำ  Master',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งวดงานที่ 6 ต่อเชื่อมท่อในผนัง+เทสระบบน้ำดี ห้องน้ำ รวม - ล่าง',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งวดงานที่ 7 ต่อเชื่อมท่อในผนัง+เทสระบบน้ำดี ห้องน้ำ รวม - บน',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งวดงานที่ 8 ต่อเชื่อมท่อในผนัง+เทสระบบน้ำดี ห้องน้ำ  Master',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งวดงานที่ 9 ต่อท่อเข้าและออกถังบำบัดรับห้องน้ำ รวม - ล่าง',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งวดงานที่ 10 ต่อท่อเข้าและออกถังบำบัดรับห้องน้ำ รวม - บน และMaster',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งวดงานที่ 11 เดินท่อระบบท่อน้ำดีรอบบ้านถึงมิเตอร์หน้าบ้าน ',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งวดงานที่ 12 ติดตั้งสุขภัณฑ์+อุปกรณ์ในห้องน้ำ + อ่างล้างจาน',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งวดงานที่ 13 ติดตั้งถังน้ำสำรองพร้อมปัมป์',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งวดงานที่ 14 เชื่อมท่อเข้ามิเตอร์ประปา',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานติดตั้งถังบำบัด',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานเทฐาน ลงถัง เติมน้ำและกลบทราย',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานก่อปากถังบำบัด',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานเทฐานรัดฝาถังบำบัด',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานวางท่อระบายน้ำรอบบ้าน',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ขุดวางท่อ / กลบดิน',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ติดตั้งบ่อพัก',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'เชื่อมท่อลงบ่อพักสาธารณะ',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'บ่อดักกลิ่น',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานติดตั้ง ตู้อาบน้ำ',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);$this->insert('works', [
            'work_name' => 'อื่นๆ',
            'wg_id'   => 9,
            'work_control_statement' => 100
        ]);

        /*ระบบไฟฟ้า*/
        $this->insert('works', [
            'work_name' => 'สกัดและวางท่อเสร็จ',
            'wg_id'   => 10,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ร้อยสายไฟแล้วเสร็จ',
            'wg_id'   => 10,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ติดตั้งดวงโคมแล้วเสร็จ',
            'wg_id'   => 10,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ส่งบ้านให้ลูกค้า',
            'wg_id'   => 10,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานแก้ไข / เพิ่มเติม ระบุ',
            'wg_id'   => 10,
            'work_control_statement' => 100
        ]);
        
        /* พื้นคอนกรีตรอบบ้าน */
        $this->insert('works', [
            'work_name' => 'โรงรถ พื้นคอนกรีต 10 ซม.',
            'wg_id'   => 11,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'โรงรถ พื้นคอนกรีตพิมพ์ลาย 5 ซม.',
            'wg_id'   => 11,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ทางเข้าบ้าน',
            'wg_id'   => 11,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ฐานวางถังน้ำสำรอง',
            'wg_id'   => 11,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ระเบียงข้างบ้าน',
            'wg_id'   => 11,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ลานซักล้าง',
            'wg_id'   => 11,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานเทพื้นคอนกรีตเพิ่มเติม ระบุ',
            'wg_id'   => 11,
            'work_control_statement' => 100
        ]);
        
        /* ตกแต่งบันได */
        $this->insert('works', [
            'work_name' => 'ไม้บันได ลูกนอน ชานพัก ไม้ราวจับ',
            'wg_id'   => 12,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'สีราวไม้บันได',
            'wg_id'   => 12,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ติดตั้งราวเหล็ก',
            'wg_id'   => 12,
            'work_control_statement' => 100
        ]);

        /* สวนรอบบ้าน */
        $this->insert('works', [
            'work_name' => 'ปลูกหญ้านวลน้อย',
            'wg_id'   => 13,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ปลูกไทรเกาหลี',
            'wg_id'   => 13,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ปลูกไม้ยืนต้น',
            'wg_id'   => 13,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'แผ่นทางเดินบริเวณประตูเล็ก',
            'wg_id'   => 13,
            'work_control_statement' => 100
        ]);

        /* Laminate  / Vinyl / บัว */
        $this->insert('works', [
            'work_name' => 'พื้น Laminate',
            'wg_id'   => 14,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'พื้น Vinyl',
            'wg_id'   => 14,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'บัวเชิงผนัง',
            'wg_id'   => 14,
            'work_control_statement' => 100
        ]);

        /*มิเตอร์น้ำประปา / ไฟฟ้า */
        $this->insert('works', [
            'work_name' => 'มิเตอร์น้ำประปา',
            'wg_id'   => 15,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'มิเตอร์ไฟฟ้า',
            'wg_id'   => 15,
            'work_control_statement' => 100
        ]);

        /* งานรั้วหล่อในที่-งานโครงสร้าง */
        $this->insert('works', [
            'work_name' => 'ฐานรากและเสา',
            'wg_id'   => 16,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'คานคอดิน',
            'wg_id'   => 16,
            'work_control_statement' => 100
        ]);

        /* งานรั้วหล่อในที่-งานก่อ / ฉาบ */
        $this->insert('works', [
            'work_name' => 'แผงถังขยะ',
            'wg_id'   => 17,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'แผงข้างประตูเล็ก',
            'wg_id'   => 17,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'แผงก่อวื่งสูง 30 ซม.',
            'wg_id'   => 17,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'แผงก่ออิฐ 2 ก้อน',
            'wg_id'   => 17,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'บัวคอนกรีต',
            'wg_id'   => 17,
            'work_control_statement' => 100
        ]);

        /* ประตูรั้วและลูกกรงเหล็ก */
        $this->insert('works', [
            'work_name' => 'ประตูเลื่อน',
            'wg_id'   => 18,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานรางประตูเลื่อน',
            'wg_id'   => 18,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ประตูเล็ก',
            'wg_id'   => 18,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ลูกกรงเหล็ก',
            'wg_id'   => 18,
            'work_control_statement' => 100
        ]);

        /* งานรั้วสำเร็จรูป */
        $this->insert('works', [
            'work_name' => 'งานรั้วสำเร็จรูปสูง 1.5 ม.',
            'wg_id'   => 19,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'งานรั้วสำเร็จรูปสูง 2.0 ม.',
            'wg_id'   => 19,
            'work_control_statement' => 100
        ]);

        /* ถนน - ทางเท้า */
        $this->insert('works', [
            'work_name' => 'เทถนน หนา 15 ซม.',
            'wg_id'   => 20,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'เททางเท้า หนา 7 ซม.',
            'wg_id'   => 20,
            'work_control_statement' => 100
        ]);

        /* คันหิน - รางตื้น */
        $this->insert('works', [
            'work_name' => 'คันหิน + รางตื้น',
            'wg_id'   => 21,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'คันหิน (ไม่มีรางตื้น)',
            'wg_id'   => 21,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'คันหินหล่อในที่',
            'wg_id'   => 21,
            'work_control_statement' => 100
        ]);

        /* ตะแกรง */
        $this->insert('works', [
            'work_name' => 'วางตะแกรงเหล็ก+เจาะช่องระบายน้ำ',
            'wg_id'   => 22,
            'work_control_statement' => 100
        ]);

        /* ท่อระบายน้ำ */
        $this->insert('works', [
            'work_name' => 'ขนาด Dia 40 ม.',
            'wg_id'   => 23,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ขนาด Dia 60 ม.',
            'wg_id'   => 23,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ขนาด Dia 80 ม.',
            'wg_id'   => 23,
            'work_control_statement' => 100
        ]);

        /* บ่อพักน้ำ */
        $this->insert('works', [
            'work_name' => 'ขนาด Dia 40 ม. 2 ทาง',
            'wg_id'   => 24,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ขนาด Dia 40 ม. 3 ทาง',
            'wg_id'   => 24,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ขนาด Dia 60 ม. 2 ทาง',
            'wg_id'   => 24,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ขนาด Dia 60 ม. 3 ทาง',
            'wg_id'   => 24,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ขนาด Dia 80 ม. 2 ทาง',
            'wg_id'   => 24,
            'work_control_statement' => 100
        ]);
        $this->insert('works', [
            'work_name' => 'ขนาด Dia 80 ม. 3 ทาง',
            'wg_id'   => 24,
            'work_control_statement' => 100
        ]);




    }

    public function down()
    {
        $this->dropTable('works');
    }
    
}
