<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalog_gpsc".
 *
 * @property integer $id
 * @property string $gpsc
 * @property string $desc
 * @property string $group
 */
class CatalogGpsc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog_gpsc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gpsc'], 'required'],
            [['desc'], 'string'],
            [['gpsc'], 'string', 'max' => 14],
            [['group'], 'string', 'max' => 8],
            [['gpsc'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gpsc' => 'Gpsc',
            'desc' => 'Desc',
            'group' => 'Group',
        ];
    }
}
