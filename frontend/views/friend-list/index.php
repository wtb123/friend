<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '好友列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friend-list-index">

    <p align="right">
        <?= Html::a('添加好友', ['user/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('待审核',['application/index'],['class'=>'btn btn-success'])?>
    </p>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user_id',
          [
             'attribute'=>'user_id',
             'value'=>'user.username',
            ],
            [
                'attribute'=>'friend_id',
                'value'=>'friend.username',
            ],
            //'friend_id',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view}{delete}'],
        ],
    ]); ?>


</div>
