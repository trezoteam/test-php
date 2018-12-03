<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Quiz */

$this->title = 'Alterar Quiz: ' . $model->name;
?>
<div class="quiz-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
