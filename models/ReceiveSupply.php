<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "receive_supply".
 *
 * @property integer $id
 * @property integer $doc_num
 * @property integer $year
 * @property string $doc_date
 * @property string $remark
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property ReceiveItem[] $receiveItems
 */
class ReceiveSupply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'receive_supply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doc_num', 'year', 'doc_date'], 'required'],
            [['doc_num', 'year', 'created_at', 'updated_at'], 'integer'],
            [['doc_date'], 'safe'],
            [['remark'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doc_num' => 'เลขที่เอกสาร',
            'year' => 'ปีงบประมาณ',
            'doc_date' => 'วันที่เอกสาร',
            'remark' => 'หมายเหตุ',
            'created_at' => 'วันที่สร้างรายการ',
            'updated_at' => 'วันที่ปรับปรุงรายการ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiveItems()
    {
        return $this->hasMany(ReceiveItem::className(), ['supply_id' => 'id']);
    }
    public function getCount()
    {
       return \app\models\ReceiveItem::find(['receive_id'=>$this->id])->count('id');
    }
    public function getTotal()
    {
       return \app\models\ReceiveItem::find(['receive_id'=>$this->id])->sum('quantity * price');
    }
}
