<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Friend */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '朋友圈', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="friend-view">

    <h1><?php //echo Html::encode($this->title) ?></h1>

    <p>
        <?php //echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定删除这条朋友圈吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            //'user_id',
            [
                'attribute'=>'user_id',
                'value'=>$model->user->username,
            ],
            'content',
           // 'picture_url',
           [
            'attribute'=>'picture_url',
            'format'=>'raw',
            'value'=>function ($model)
            {
                return Html::img($model->picture_url);
            }
           ],
           // 'create_time:datetime',
            [
             'attribute'=>'create_time',
             'format'=>['date','php:Y-m-d H:i:s'],
            ],
        ],
    ]) ?>

</div>
