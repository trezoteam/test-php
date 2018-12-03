<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AnsweredQuiz */
/* @var $answeredQuestiondataProvider \yii\debug\models\timeline\DataProvider */
/* @var $answeredQuestionSearchModel \backend\models\QuestionSearch */

$this->title = 'Quiz respondido: ' . $model->id;
?>
<div class="answered-quiz-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'start_at',
            'finish_at',
            'quiz_id',
            'web_user_id',
        ],
    ]) ?>

    <?php
    echo '<h2>Respostas do Quiz respondido</h2>';

    echo \yii\grid\GridView::widget([
        'dataProvider' => $answeredQuestiondataProvider,
        'filterModel' => $answeredQuestionSearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'answer',
            'question_id',
            'answered_quiz_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{answered-question/view}',
                'buttons' => [

                    'answered-question/view' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"/>', $url, [
                        ]);
                    }
                ],
            ],
        ],
    ]);

    ?>
    <?= Html::a('Voltar', ['web-user/view?id=' . $model->web_user_id], ['class' => 'btn btn-primary']) ?>


</div>
