<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\FriendList */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '好友列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="friend-list-view">

    <h1><?php //echo Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
           // 'user_id',
          //  'friend_id',
            [
            'attribute'=>'friend_id',
            'value'=>$model->friend->username,
            ],
            [
                'attribute'=>'friend_id',
                'label'=>'手机号码',
                'value'=>$model->friend->phone_number,
            ],
            [
                'attribute'=>'friend_id',
                'label'=>'邮箱',
                'value'=>$model->friend->email,
            ],
            [
                'attribute'=>'friend_id',
                'label'=>'注册时间',
                'value'=>$model->friend->created_at,
            ],
        ],
    ]) ?>

</div>
