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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nsn', 'name', 'unit_issue'], 'required'],
            [['price'], 'number'],
            [['created_at', 'updated_at'], 'integer'],
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
            'nsn' => 'Nsn',
            'name' => 'Name',
            'unit_issue' => 'Unit Issue',
            'price' => 'Price',
            'gpsc' => 'Gpsc',
            'remark' => 'Remark',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
