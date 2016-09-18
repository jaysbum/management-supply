<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "receive_item".
 *
 * @property integer $id
 * @property integer $receive_id
 * @property integer $supply_id
 * @property string $price
 * @property integer $quantity
 * @property string $remark
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property ReceiveSupply $receive
 * @property SupplyList $supply
 */
class ReceiveItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'receive_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['receive_id', 'supply_id', 'price', 'quantity'], 'required'],
            [['receive_id', 'supply_id', 'quantity', 'created_at', 'updated_at'], 'integer'],
            [['price'], 'number'],
            [['remark'], 'string'],
            [['receive_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReceiveSupply::className(), 'targetAttribute' => ['receive_id' => 'id']],
            [['supply_id'], 'exist', 'skipOnError' => true, 'targetClass' => SupplyList::className(), 'targetAttribute' => ['supply_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'receive_id' => 'Receive ID',
            'supply_id' => 'Supply ID',
            'price' => 'ราคาต่อหน่วย',
            'quantity' => 'จำนวน',
            'remark' => 'หมายเหตุ',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceive()
    {
        return $this->hasOne(ReceiveSupply::className(), ['id' => 'receive_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupply()
    {
        return $this->hasOne(SupplyList::className(), ['id' => 'supply_id']);
    }
    public function getTotal()
    {
        return $this->quantity * $this->price;
    }
}
