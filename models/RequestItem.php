<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request_item".
 *
 * @property integer $id
 * @property integer $supply_id
 * @property integer $request_id
 * @property integer $budget_id
 * @property string $price
 * @property string $quantity
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property BudgetGroup $budget
 * @property RequestSupply $request
 * @property SupplyList $supply
 */
class RequestItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_item';
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
            [['supply_id', 'request_id', 'budget_id', 'price', 'quantity'], 'required'],
            [['supply_id', 'request_id', 'budget_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['price', 'quantity'], 'number'],
            [['budget_id'], 'exist', 'skipOnError' => true, 'targetClass' => BudgetGroup::className(), 'targetAttribute' => ['budget_id' => 'id']],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => RequestSupply::className(), 'targetAttribute' => ['request_id' => 'id']],
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
            'supply_id' => 'รหัสพัสดุ',
            'request_id' => 'รหัสใบแจ้ง',
            'budget_id' => 'รหัสงบประมาณ',
            'price' => 'ราคาต่อหน่วย',
            'quantity' => 'จำนวน',
            'status' => 'สถานะ',
            'created_at' => 'วันที่ทำรายการ',
            'updated_at' => 'วันที่ปรับปรุงรายการ',
        ];
    }

    public function getBudget()
    {
        return $this->hasOne(BudgetGroup::className(), ['id' => 'budget_id']);
    }

    public function getRequest()
    {
        return $this->hasOne(RequestSupply::className(), ['id' => 'request_id']);
    }

    public function getSupply()
    {
        return $this->hasOne(SupplyList::className(), ['id' => 'supply_id']);
    }

    public function getPayment()
    {
        return \app\models\RequestSupply::findOne($this->request_id)->paystatus;
    }
}
