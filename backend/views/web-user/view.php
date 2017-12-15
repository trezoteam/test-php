<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\WebUser */
/* @var $answeredQuizDataProvider \yii\debug\models\timeline\DataProvider */
/* @var $answeredQuizSearchModel \backend\models\QuizSearch */

$this->title = $model->name;
?>
<div class="web-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'email:email',
        ],
    ]) ?>

    <?php
        echo '<h2>Quizzes respondidos</h2>';

        echo \yii\grid\GridView::widget([
            'dataProvider' => $answeredQuizDataProvider,
            'filterModel' => $answeredQuizSearchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'start_at',
                'finish_at',
                'quiz_id',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{answered-quiz/view}',
                    'buttons' => [

                        'answered-quiz/view' => function ($url) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"/>', $url, [
                            ]);
                        }
                    ],
                ],
            ],
        ]);

    ?>

    <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-primary']) ?>


</div>
