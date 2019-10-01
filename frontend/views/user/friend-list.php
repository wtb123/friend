<?php

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '好友列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p align="right">
        <?php //echo Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('添加好友', ['user/index'], ['class' => 'btn btn-success']) ?>
        <?php //echo Html::a('待审核',['application/index'],['class'=>'btn btn-success'])?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //  ['class' => 'yii\grid\SerialColumn'],
            'id',
            'username',
            // 'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'email:email',
            //'status',
            //'created_at',
            //'updated_at',
            //'verification_token',
            'phone_number',
            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view}' ,],
            ],
        ]); ?>


</div>
