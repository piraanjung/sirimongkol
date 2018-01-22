<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work_group".
 *
 * @property int $id
 * @property string $wg_name
 * @property int $wc_id
 */
class WorkGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'work_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wg_name'], 'required'],
            [['wc_id'], 'integer'],
            [['wg_name'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'wg_name' => 'Wg Name',
            'wc_id' => 'Wc ID',
        ];
    }
}
