<?php
use yii\helpers\Html;
?>
<div class="friend">
    <div class="author">
        <span class="glyphicon glyphicon-user" style="color: rgb(54, 219, 60);" aria-hidden="true"></span><em><?=Html::encode($model->user->username)."&nbsp;&nbsp;&nbsp;&nbsp;";?></em>
        <span class="glyphicon glyphicon-time" aria-hidden="true"></span><em><?= date('Y-m-d H:i:s',$model->create_time)?></em>
    </div>
    <div class="content">
     <p><a href="<?= $model->url;?>"><?=Html::encode($model->content);?></a></p>
    </div>
    <div class="picture">
       <img src="<?=$model->picture_url;?>" style="width: 30%">
    </div>
    <div class="comment">
        <?=Html::a("评论({$model->commentCount})",$model->url.'#comments');?>
    </div>
    <br><br>
</div>
