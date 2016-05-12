<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-6">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'gender')->dropDownList(['Pria', 'Wanita'], ['prompt' => 'Pilih jenis kelamin']) ?>

    <?= $form->field($model, 'birthdate') ?>

    <?= $form->field($model, 'birthplace') ?>

    <?= $form->field($model, 'phone') ?>

    <?= $form->field($model, 'phone2') ?>

    <?= $form->field($model, 'country') ?>

    <?= $form->field($model, 'city') ?>

    <?= $form->field($model, 'street') ?>

    <?= $form->field($model, 'zip') ?>

    <?= $form->field($model, 'occupation') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
