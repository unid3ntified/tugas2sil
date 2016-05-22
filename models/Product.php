<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property integer $price
 * @property integer $category
 * @property string $dimension
 * @property integer $weight
 * @property integer $discount
 * @property integer $stock
 * @property string $status
 *
 * @property Category $category0
 * @property Discount $discount0
 * @property ShoppingCart[] $shoppingCarts
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status', 'category', 'price', 'discount', 'stock'], 'required'],
            [['description'], 'string'],
            [['price', 'category', 'weight', 'discount', 'stock'], 'integer'],
            [['name', 'dimension'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 30]
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
            'description' => 'Description',
            'image' => 'Image',
            'price' => 'Price',
            'category' => 'Category',
            'dimension' => 'Dimension',
            'weight' => 'Weight',
            'discount' => 'Discount',
            'stock' => 'Stock',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(Category::className(), ['id' => 'category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscount0()
    {
        return $this->hasOne(Discount::className(), ['id' => 'discount']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShoppingCarts()
    {
        return $this->hasMany(ShoppingCart::className(), ['product_id' => 'id']);
    }
}
