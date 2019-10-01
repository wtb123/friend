<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FriendSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '朋友圈';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friend-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'content',
            //'picture_url:url',
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
             'value'=>date('Y:m:d H:i:s',$model->create_time),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
