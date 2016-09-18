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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'parent_id'], 'required'],
            [['parent_id', 'created_at', 'updated_at'], 'integer'],
            [['list_item'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'parent_id' => 'Parent ID',
            'list_item' => 'List Item',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
