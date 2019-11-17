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
            <!--暂时用不了，待研究
            <a href="<?php // Url::toRoute(['friend/delete','id'=>$model->id],true) ?>" data-clicklog="delete" onclick="return false;" data="confirm:'你确定要删除它吗？';method:post">
                <span class="glyphicon glyphicon-trash"></span> <?php // '删除' ?>
            </a>
            -->
            <?= Html::a('删除',['delete','id'=>$model->id],['class'=>'glyphicon glyphicon-trash','data'=>
             [
               'confirm'=>'您确定删除它吗？',
               'method'=>'post',
             ],
             ])?>
            <span class="item-line"></span>
        <?php endif ?>
        <a href="<?= Url::toRoute(['/home/feed/delete']) ?>" data-clicklog="delete" onclick="return false;" title="<?= Yii::t('app', 'Are you sure to delete it?') ?>">
            <span class="glyphicon glyphicon-comment"></span> <?= '评论' ?>
        </a>
    </div>
</div>

</div>

