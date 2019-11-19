<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<?php foreach($comments as $comment):?>
<div class="comment">

    <div class="row">
        <div class="col-md-9">
            <div class="comment_detail">
                <p class="bg-info">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <em><?=Html::encode($comment->user->username);?></em>
                    <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                    <em><?= date('Y-m-d H:i:s',$comment->create_time);?></em>

                    <?php //用户只能删除自己的评论或者自己发布的朋友圈的评论 ;?>
                    <?php  if( ($comment->user_id==Yii::$app->user->identity->id) || ($id==Yii::$app->user->identity->id) ):?>
                    <?= Html::a("<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden='true'>&times;</span></button>",['comment/delete','id'=>$comment->id,'friend_id'=>$model->id],['data'=>
                        [
                            'confirm'=>'您确定删除这条评论吗？',
                            'method'=>'post',
                        ],
                    ])?>
                    <?php endif ?>

                <br>
                <?= nl2br($comment->content);?>
                </p>
            </div>

        </div>

    </div>

</div>
<?php endforeach;?>
