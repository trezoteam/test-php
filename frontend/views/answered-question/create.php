<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\AnsweredQuestion */
/* @var $answered_quiz frontend\models\AnsweredQuiz */
/* @var $questions [frontend\models\Question] */

$this->title = 'Responda ao Quiz';
?>
<div class="answered-question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $models,
        'questions' => $questions,
        'answered_quiz' => $answered_quiz,
    ]) ?>

</div>
