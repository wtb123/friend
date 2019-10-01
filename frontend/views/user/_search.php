<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php //echo $form->field($model, 'id') ?>

    <?php //echo $form->field($model, 'username') ?>

    <?php //echo$form->field($model, 'auth_key') ?>

    <?php //echo $form->field($model, 'password_hash') ?>

    <?php //echo $form->field($model, 'password_reset_token') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'verification_token') ?>

    <?php  echo $form->field($model, 'phone_number') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索好友', ['class' => 'btn btn-primary']) ?>
        <?php //echo Html::resetButton('上个搜索', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
