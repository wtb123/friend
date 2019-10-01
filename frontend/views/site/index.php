<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

use yii\helpers\Html; ?>
<div class="site-index">

    <div class="jumbotron">
        <h1>欢迎来到一个低配版的朋友圈！</h1>

        <p class="lead">It's worth a try.</p>
        <?= Html::a('点击可注册', ['site/signup'], ['class' => 'btn btn-lg btn-success']) ?>
    </div>


</div>
