<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Answer */

$this->title = 'Alterar Resposta: ' . $model->id;
?>
<div class="answer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
