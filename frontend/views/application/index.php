<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ApplicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '申请列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="application-index">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <p>
        <?php //echo Html::a('Create Application', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
           // 'user_id',
            //'friend_id',
            [
             'attribute'=>'friend_id',
             'value'=>'friend.username',
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view}{update}{delete}',
                'buttons'=>[
                    'update'=>function($url,$model,$key)
                    {
                        $options=[
                            'title'=>Yii::t('yii','添加'),
                            'aria-label'=>Yii::t('yii','添加'),
                            'data-confirm'=>Yii::t('yii','你确定添加他为好友吗？'),
                            'data-method'=>'post',
                            'data-pjax'=>0,
                        ];
                        return Html::a('<span class="glyphicon glyphicon-check"></span>'
                            ,$url,$options);
                    },
                    'delete'=>function($url,$model,$key)
                    {
                        $options=[
                            'title'=>Yii::t('yii','拒绝'),
                            'aria-label'=>Yii::t('yii','拒绝'),
                            'data-confirm'=>Yii::t('yii','你确定拒绝他为好友吗？'),
                            'data-method'=>'post',
                            'data-pjax'=>0,
                        ];
                        return Html::a('<span class="glyphicon glyphicon-remove"></span>'
                            ,$url,$options);
                    },
                    ],
            ],
        ],
    ]); ?>


</div>
