<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Daftar Baru';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-5">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Daftarkan diri Anda sekarang dengan mengisi form di bawah ini:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'signup-form',
        'options' => ['class' => 'form-horizontal'],
        
    ]); ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'repeat_password')->passwordInput() ?>

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

    <div class="form-group" align = "right">
        <?= Html::submitButton('Daftar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>