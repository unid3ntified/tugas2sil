<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Ubah Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-8 col-md-offset-4">
    <div class="col-lg-5">
	    <?php $form = ActiveForm::begin(); ?>      
	        <?= $form->field($model, 'old_password')->passwordInput() ?>
	        <?= $form->field($model, 'new_password')->passwordInput() ?>
	        <?= $form->field($model, 'repeat_password')->passwordInput() ?>
	        <div class="form-group">
	            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
	        </div>
	    <?php ActiveForm::end(); ?>
	</div>
</div>
