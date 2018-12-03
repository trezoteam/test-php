<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Answer;

/* @var $this yii\web\View */
/* @var $model frontend\models\AnsweredQuestion */
/* @var $form yii\widgets\ActiveForm */
/* @var $questions [\frontend\models\Question] */
/* @var $answered_quiz \frontend\models\AnsweredQuiz */
/* @var $models [frontend\models\AnsweredQuestion] */
?>

<div class="answered-question-form">

    <?php $form = ActiveForm::begin();
    $i = 0;
    foreach ($models as $index => $model) {

        if($i <= count($questions))
        {
            if (!$questions[$i]->type) {
                echo $form->field($model, "[$index]answer")->label('ola')->label($questions[$i]->subject);

            } else {
                echo $form->field($model, "[$index]answer")
                    ->radioList(ArrayHelper::map(Answer::findAllByQuestionId($questions[$i]->id), 'id', 'answer'),
                        ['separator' => '<br>'])
                    ->label($questions[$i]->subject);
            }
            echo $form->field($model, "[$index]question_id")->hiddenInput(['value' => $questions[$i]->id])->label(false);
            echo $form->field($model, "[$index]answered_quiz_id")->hiddenInput(['value' => $answered_quiz->id])->label(false);
            $i++;
        }
    }
    ?>
    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
