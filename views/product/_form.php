<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'category')->dropDownList($categoryList, ['prompt' => 'Pilih kategori produk']) ?>

    <?= $form->field($model, 'status')->dropDownList(['Tersedia', 'Habis', 'Inden', 'Arsip'], ['prompt' => 'Pilih status produk']) ?>

    <?= $form->field($model, 'dimension')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'discount')->dropDownList($discountList, ['prompt' => 'Pilih diskon']) ?>

    <?= $form->field($model, 'stock')->textInput(['maxlength' => 20]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
