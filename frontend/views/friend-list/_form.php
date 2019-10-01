<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FriendList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="friend-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // echo  $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'friend_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
