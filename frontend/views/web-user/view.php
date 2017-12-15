<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\WebUser */

$this->title = 'Ola: ' . $model->name . '! Você está pronto?';
?>
<div class="web-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'email:email',
        ],
    ]) ?>

    <p>
        <?= Html::a('Iniciar QUIZ', ['answered-question/create', 'web_user_id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

</div>
