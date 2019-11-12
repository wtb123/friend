<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '添加好友';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?php //echo Html::encode($this->title) ?></h1>

    <p>
        <?php //echo Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
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
              'template'=>'{view}{update}{delete}' ,
                'buttons'=>[
                'update'=>function($url,$model,$key)
                {
                    $options=[
                      'title'=>Yii::t('yii','添加'),
                     'aria-label'=>Yii::t('yii','添加'),
                        'data-confirm'=>Yii::t('yii','你确定申请添加他为好友吗？'),
                        'data-method'=>'post',
                        'data-pjax'=>0,
                    ];
                    return Html::a('<span class="glyphicon glyphicon-plus"></span>'
                    ,$url,$options);
                }],
                ],
            ],]); ?>


</div>
