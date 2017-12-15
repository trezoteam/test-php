<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\WebUser */
/* @var $form yii\widgets\ActiveForm */
/* @var $quiz_id int */
?>

<div class="web-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= Html::hiddenInput('quiz_id', $quiz_id) ?>

    <div class="form-group">
        <?= Html::submitButton('Criar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
