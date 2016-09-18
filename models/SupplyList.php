<?php

namespace app\models;

use Yii;
use app\models\RequestItem;
/**
 * This is the model class for table "supply_list".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $name
 * @property string $nsn
 * @property string $unit_issue
 * @property string $gpsc
 * @property string $price
 * @property integer $quantity
 * @property string $total
 * @property string $real_price
 * @property integer $real_quantity
 * @property string $real_total
 * @property string $margin_total
 * @property integer $status
 * @property string $remark
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property BudgetGroup $group
 */
class SupplyList extends \yii\db\ActiveRecord
{
    public $qty;
    public static function tableName()
    {
        return 'supply_list';
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
            [['group_id', 'name', 'price', 'quantity'], 'required'],
            [['group_id', 'quantity', 'real_quantity', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'remark'], 'string'],
            //[['price', 'total', 'real_price', 'real_total', 'margin_total'], 'number'],
            [['price', 'real_price'], 'number'],
            [['nsn', 'unit_issue', 'gpsc'], 'string', 'max' => 255],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => BudgetGroup::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Group ID',
            'name' => 'ชื่อพัสดุ',
            'nsn' => 'หมายเลขพัสดุ',
            'unit_issue' => 'หน่วยนับ',
            'gpsc' => 'รหัส GPSC',
            'price' => 'ราคาต่อหน่วย',
            'quantity' => 'จำนวน',
            //'total' => 'Total',
            'real_price' => 'Real Price',
            'real_quantity' => 'Real Quantity',
            //'real_total' => 'Real Total',
            //'margin_total' => 'Margin Total',
            'status' => 'Status',
            'remark' => 'Remark',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(BudgetGroup::className(), ['id' => 'group_id']);
    }

    public function getSummary()
    {
        return $this->price * $this->quantity;
    }

    public function getRemaining()
    {
        $qty = RequestItem::find()->where(['supply_id'=>$this->id])->sum('quantity');
        return $this->quantity - $qty;
    }
}
