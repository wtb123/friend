<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FriendListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Friend Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friend-list-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Friend List', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'friend_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
