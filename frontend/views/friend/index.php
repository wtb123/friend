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
<div class="container">
    <?php //Html::a('发朋友圈', ['upload'], ['class' => 'btn btn-success']) ?>
    <div class="row">

        <div class="col-md-9">
            <?= ListView::widget([
                'id'=>'friendlist',
                'dataProvider'=>$dataProvider,
                'itemView'=>'_listitem',//子视图，显示一个朋友圈内容.
                'layout'=>'{items}{pager}',
                'pager'=>[
                    'maxButtonCount'=>3,
                    'nextPageLabel'=>Yii::t('app','下一页'),
                    'prevPageLabel'=>Yii::t('app','上一页'),
                ],
            ])?>
        </div>
        <div class="col-md-3">
        </div>
<!--搜索框功能，暂时还没有实现
        <div class="col-md-3">

            <div class="searchbox">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>查找朋友圈
                    </li>
                    <li class="list-group-item">
                        <form class="form-inline" action="index.php?r=friend/index" id="w0" method="get">
                            <div class="form-group">
                                <input type="text" class="form-control" name="FriendSearch[id]" id="w0input" placeholder="按用户">
                            </div>
                            <button type="submit" class="btn btn-default">搜索</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

-->
    </div>
</div>

