<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FriendList */

$this->title = 'Create Friend List';
$this->params['breadcrumbs'][] = ['label' => 'Friend Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friend-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
