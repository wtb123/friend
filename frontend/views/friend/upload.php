<?php

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Friend */

$this->title = '创建朋友圈';
$this->params['breadcrumbs'][] = ['label' => '朋友圈', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friend-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options'=>['entype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('发表', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
