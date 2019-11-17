<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div style="margin-bottom: 20px">
<div class="friend-padded">
    <div class="author">
        <span class="glyphicon glyphicon-user" style="color: rgb(54, 219, 60);" aria-hidden="true"></span><em><?=Html::encode($model->user->username)."&nbsp;&nbsp;&nbsp;&nbsp;";?></em>
        <span class="glyphicon glyphicon-time" aria-hidden="true"></span><em><?= date('Y-m-d H:i:s',$model->create_time)?></em>
    </div>
    <div class="content">
     <p><a href="<?= $model->url;?>" style="color:black"><?=Html::encode($model->content);?></a></p>
    </div>
    <div class="picture">
        <img src="<?=$model->picture_url;?>" style="width:280px;max-height:200px">
    </div>

    <div class="comment">
        <?=Html::a("评论({$model->commentCount})",$model->url.'#comments');?>
    </div>

</div>

<div class="widget-footer" style="background-color:#fafafa;width:522px;height:38.2px;padding:8px;">
    <div class="footer-detail">
        <?php if(Yii::$app->user->id ==$model->user->id): ?>
            <a href="<?= Url::toRoute(['/home/feed/update']) ?>">
                <span class="glyphicon glyphicon-edit"></span> <?= '编辑' ?>
            </a>
            <span class="item-line"></span>
            <a href="<?= Url::toRoute(['/home/feed/delete']) ?>" data-clicklog="delete" onclick="return false;" title="<?= Yii::t('app', 'Are you sure to delete it?') ?>">
                <span class="glyphicon glyphicon-trash"></span> <?= '删除' ?>
            </a>
            <span class="item-line"></span>
        <?php endif ?>
        <a href="<?= Url::toRoute(['/home/feed/delete']) ?>" data-clicklog="delete" onclick="return false;" title="<?= Yii::t('app', 'Are you sure to delete it?') ?>">
            <span class="glyphicon glyphicon-comment"></span> <?= '评论' ?>
        </a>
    </div>
</div>

</div>

