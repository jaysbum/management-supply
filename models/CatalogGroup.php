<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalog_group".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property string $list_item
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $start_niin
 * @property string $end_niin
 */
class CatalogGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog_group';
    }

    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
        ];
    }
    public function rules()
    {
        return [
            [['name', 'parent_id', 'start_niin', 'end_niin'], 'required'],
            [['parent_id', 'created_at', 'updated_at','start_niin', 'end_niin'], 'integer'],
            [['list_item'], 'string'],
            [['name'],'exist'],
            [['name'], 'string', 'max' => 255],
            ['end_niin', 'compare', 'compareAttribute' => 'start_niin', 'operator' => '>'],
            [['start_niin', 'end_niin'],'integer','min'=>7310000,'max'=>7399999],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อกุ่มพัสดุ',
            'parent_id' => 'รหัสกลุ่มหลัก',
            'list_item' => 'รายการพัสดุในกลุ่ม',
            'created_at' => 'วันที่สร้างรายการ',
            'updated_at' => 'วันที่ปรับปรุงรายการ',
            'start_niin' => 'หมายเลข NIIN เริ่มต้น',
            'end_niin' => 'หมายเลข NIIN สิ้นสุด',
        ];
    }
}
