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

    <div class="content-padded">
    <div class="form-group">
    <?php $form = ActiveForm::begin(['options'=>['entype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'content',['inputOptions'=>['placeholder'=>'记录身边人，身边事']])->textarea(['rows' =>6,'cols'=>50])->label(false) ?>

    <?= $form->field($model, 'imageFile')->fileInput()->label(false) ?>

    <?= Html::submitButton('创建', ['class' => 'btn btn-success']) ?>
    </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
