<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FriendList */

$this->title = '添加好友';
$this->params['breadcrumbs'][] = ['label' => '通讯录', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friend-list-create">

    <h1><?php //echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
