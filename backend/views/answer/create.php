<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Answer */

$this->title = 'Nova Resposta';
?>
<div class="answer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
