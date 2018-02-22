<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "house_model_have_workgroup".
 *
 * @property int $id
 * @property int $house_model_id
 * @property int $wg_id
 * @property double $cost_control
 */
class HouseModelHaveWorkgroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'house_model_have_workgroup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['house_model_id', 'wg_id'], 'required'],
            [['house_model_id', 'wg_id'], 'integer'],
            [['cost_control'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'house_model_id' => 'House Model ID',
            'wg_id' => 'Wg ID',
            'cost_control' => 'Cost Control',
        ];
    }
}
