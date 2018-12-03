<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Answer */

$this->title = 'Resposta: ' . $model->id . ' da Pergunta: ' . $model->question_id;
?>
<div class="answer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'answer',
            'is_correct:boolean',
            'created_at',
            'updated_at',
            'question_id',
        ],
    ]) ?>

    <?= Html::a('Voltar', ['question/view?id=' . $model->question_id], ['class' => 'btn btn-primary']) ?>

</div>
