<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Quiz */
/* @var $questionSearchModel backend\models\QuestionSearch */
/* @var $questionDataProvider yii\data\ActiveDataProvider */

$this->title = 'Quiz: ' . $model->name;
?>
<div class="quiz-view">

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
            'name',
            'description',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <h2>Perguntas</h2>
    <p>
        <?= Html::a('Nova Pergunta', ['question/create', 'quiz_id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $questionDataProvider,
        'filterModel' => $questionSearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'subject',
            [
                'attribute' => 'type',
                'value' => function($model) {
                    if($model->type)
                        return 'Múltipla Escolha';
                    return 'Discursiva';
                }
            ],
            'created_at',
            'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{question/view} {question/update} {question/delete}',
                'buttons' => [

                    'question/view' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"/>', $url, [
                        ]);
                    },
                    'question/update' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"/>', $url, [
                        ]);
                    },
                    'question/delete' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-trash"/>', $url, [
                            'data-method' => 'post',
                            'data-confirm' => 'Are you sure to delete this item?'
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

    <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-primary']) ?>

</div>
