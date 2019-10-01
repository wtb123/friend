<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Friend */

$this->title = '创建朋友圈';
$this->params['breadcrumbs'][] = ['label' => '朋友圈', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friend-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php var_dump('hello world!');exit(0);?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
