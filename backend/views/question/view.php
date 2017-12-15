<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Question */
/* @var $answerSearchModel backend\models\AnswerSearch */
/* @var $answerDataProvider yii\data\ActiveDataProvider */

$this->title = 'Pergunta: ' . $model->id . ' do Quiz: ' . $model->quiz_id;
?>
<div class="question-view">

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
            'subject',
            [
                'attribute' => 'type',
                'value' => function($model) {
                    if($model->type) {
                        return 'Múltipla Escolha';
                    }
                    return 'Discursiva';
                }
            ],
            'created_at',
            'updated_at',
            'quiz_id',
        ],
    ]) ?>

    <?php
    if($model->type)
    {
        echo '    
            <h2>Respostas</h2>
            <p>';
        echo Html::a('Nova Resposta', ['answer/create', 'question_id' => $model->id], ['class' => 'btn btn-primary']);
        echo '</p>';
        echo GridView::widget([
            'dataProvider' => $answerDataProvider,
            'filterModel' => $answerSearchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'answer',
                'is_correct:boolean',
                'created_at',
                'updated_at',
                // 'question_id',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{answer/view} {answer/update} {answer/delete}',
                    'buttons' => [

                        'answer/view' => function ($url) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"/>', $url, [
                            ]);
                        },
                        'answer/update' => function ($url) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"/>', $url, [
                            ]);
                        },
                        'answer/delete' => function ($url) {
                            return Html::a('<span class="glyphicon glyphicon-trash"/>', $url, [
                                    'data-method' => 'post',
                                    'data-confirm' => 'Are you sure to delete this item?'
                            ]);
                        },
                    ],
                ],
            ],
        ]);
    }


    ?>

    <?= Html::a('Voltar', ['quiz/view?id=' . $model->quiz_id], ['class' => 'btn btn-primary']) ?>


</div>
