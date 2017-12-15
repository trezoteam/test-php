<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AnsweredQuestion */

$this->title = $model->id;
?>
<div class="answered-question-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'answer',
            'question_id',
            'answered_quiz_id',
        ],
    ]) ?>

    <?= Html::a('Voltar', ['answered-quiz/view?id=' . $model->answered_quiz_id], ['class' => 'btn btn-primary']) ?>


</div>
