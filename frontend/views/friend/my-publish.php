<?php

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '朋友圈';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friend-index">

    <h1><?php //echo  Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('发朋友圈', ['upload'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('我的发布', ['my-publish'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'=>$searchModel,
        'columns' => [
            //   ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'user_id',
            [
                'attribute'=>'user_id',
                'value'=>'user.username',
            ],
            'content',
            //'picture_url',
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
                // 'value'=>date('Y-m-d H:i:s',$model->create_time),
            ],
            // 'picture_url',
            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view}{delete}'],
        ],
    ]); ?>


</div>
