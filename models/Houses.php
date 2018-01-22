<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "houses".
 *
 * @property int $id
 * @property string $house_name
 * @property int $house_model_id
 * @property int $project_id
 * @property int $house_status
 * @property string $create_date
 * @property string $update_date
 */
class Houses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'houses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['house_name', 'house_model_id', 'project_id'], 'required'],
            [['house_model_id', 'project_id', 'house_status'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            [['house_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'house_name' => 'แปลงบ้าน',
            'house_model_id' => 'แบบบ้าน',
            'project_id' => 'โครงการ',
            'house_status' => 'สถานะ',
            'create_date' => 'วันที่บันทึกข้อมูล',
            'update_date' => 'วันที่แก้ไขข้อมูล',
        ];
    }
}
