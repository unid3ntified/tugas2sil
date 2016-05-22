<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sales_order".
 *
 * @property integer $id
 * @property string $timestamp
 * @property integer $delivery
 * @property integer $discount
 * @property integer $total
 * @property string $country
 * @property string $city
 * @property string $street
 * @property string $zip
 * @property string $status
 * @property string $note
 * @property string $last_updated
 *
 * @property OrderDetail[] $orderDetails
 * @property ShoppingCart[] $carts
 * @property Delivery $delivery0
 * @property Discount $discount0
 */
class SalesOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sales_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['timestamp', 'last_updated'], 'safe'],
            [['delivery', 'discount', 'total'], 'integer'],
            [['note'], 'string'],
            [['country', 'city'], 'string', 'max' => 50],
            [['street'], 'string', 'max' => 255],
            [['zip'], 'string', 'max' => 12],
            [['status'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'timestamp' => 'Timestamp',
            'delivery' => 'Delivery',
            'discount' => 'Discount',
            'total' => 'Total',
            'country' => 'Country',
            'city' => 'City',
            'street' => 'Street',
            'zip' => 'Zip',
            'status' => 'Status',
            'note' => 'Note',
            'last_updated' => 'Last Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetail::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(ShoppingCart::className(), ['id' => 'cart_id'])->viaTable('order_detail', ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDelivery0()
    {
        return $this->hasOne(Delivery::className(), ['id' => 'delivery']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscount0()
    {
        return $this->hasOne(Discount::className(), ['id' => 'discount']);
    }
}
