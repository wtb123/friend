<?php

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use yii\widgets\ListView;
use frontend\components\RctReplyWidget;
use yii\helpers\HtmlPurifier;
use common\models\Comment;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="container">

    <div class="row">

        <div class="col-md-9">

            <ol class="breadcrumb">
                <li><a href="<?= Yii::$app->homeUrl?>">首页</a> </li>
                <li><a href="<?=Yii::$app->homeUrl;?>?r=friend/index">朋友圈</a></li>
            </ol>
            <div class="friend">
                <div class="author">
                    <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                    <em><?= date('Y-m-d H:i:s',$model->create_time)."&nbsp;&nbsp;&nbsp;&nbsp"?></em>
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    <em><?= $model->user->username?></em>
                    <?php if($model->user_id==Yii::$app->user->identity->id):?>
                        <?=Html::a('删除', ['delete','id'=>$model->id], ['class' => 'glyphicon glyphicon-trash',
                            'data'=>[
                                'confirm'=>'您确定要删除吗？',
                                'method'=>'post',
                            ]])
                        ?>
                    <?php endif;?>
                </div>
            </div>
            <br>
            <div class="content">
                <?= HTMLPurifier::process($model->content);?>
            </div>
            <div class="picture">
                <img src="<?=$model->picture_url;?>" style="width: 25%">
            </div>
            <br>
            <div class="nav">
                <?php // Html::a("评论({$model->commentCount})",$model->url.'#comments');?>
            </div>

            <div id="comments">
                <?php if($added) {?>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4>回复成功</h4>
                        <p><?=nl2br($commentModel->content);?></p>
                        <span class="glyphicon glyphicon-time" aria-hidden="true"></span><em><?=date('Y-m-d H:i:s',$model->create_time)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?></em>
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span><em><?=Html::encode($model->user->username);?></em>
                    </div>
                <?php }?>

                <?php if($model->commentCount>=1):?>
                    <h5><?= $model->commentCount.'条评论';?></h5>
                    <?=$this->render('_comment',array(
                        'model'=>$model,
                        'comments'=>$model->comments,
                        'id'=>$model->user_id,
                    ))
                    ;?>
                <?php endif;?>

                <h5>发表评论</h5>
                <?php
                $postComment=new Comment();
                echo $this->render('_guestform',array(
                    'id'=>$model->id,
                    'recentComments'=>$postComment,
                ))
                ;?>
            </div>
        </div>

    </div>
</div>