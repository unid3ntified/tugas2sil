<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shopping_cart".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $product_id
 * @property integer $quantity
 * @property integer $total
 * @property string $last_updated
 *
 * @property OrderDetail[] $orderDetails
 * @property SalesOrder[] $orders
 * @property User $user
 * @property Product $product
 */
class ShoppingCart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shopping_cart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'product_id', 'quantity', 'total'], 'integer'],
            [['last_updated'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
            'total' => 'Total',
            'last_updated' => 'Last Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetail::className(), ['cart_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(SalesOrder::className(), ['id' => 'order_id'])->viaTable('order_detail', ['cart_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
