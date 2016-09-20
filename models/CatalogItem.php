<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalog_item".
 *
 * @property integer $id
 * @property string $nsn
 * @property string $name
 * @property string $unit_issue
 * @property string $price
 * @property string $gpsc
 * @property string $remark
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $niin
 * @property integer $new
 */
class CatalogItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog_item';
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
            [['nsn', 'name', 'unit_issue', 'niin','gpsc','price','parent_nsn'], 'required'],
            [['price'], 'number'],
            [['created_at', 'updated_at', 'new','niin'], 'integer'],
            [['nsn', 'name', 'unit_issue', 'gpsc', 'remark'], 'string', 'max' => 255],
            [['nsn'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nsn' => 'หมายเลขพัสดุ',
            'name' => 'ชื่อพัสดุ',
            'unit_issue' => 'หน่วยนับ',
            'price' => 'ราคา',
            'gpsc' => 'รหัส GPSC',
            'remark' => 'หมายเหตุ',
            'created_at' => 'วันที่สร้างรายการ',
            'updated_at' => 'วันที่ปรับปรุงรายการ',
            'niin' => 'รหัส NIIN',
            'new' => 'รายการใหม่',
            'parent_nsn' => 'พัสดุหลัก'
        ];
    }
}
