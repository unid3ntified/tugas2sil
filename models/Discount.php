<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "discount".
 *
 * @property integer $id
 * @property string $name
 * @property integer $value
 * @property string $note
 *
 * @property Product[] $products
 * @property SalesOrder[] $salesOrders
 */
class Discount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'integer'],
            [['note'], 'string'],
            [['name'], 'string', 'max' => 50]
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
            'value' => 'Value',
            'note' => 'Note',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['discount' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesOrders()
    {
        return $this->hasMany(SalesOrder::className(), ['discount' => 'id']);
    }
}
