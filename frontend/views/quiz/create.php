<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Quiz */

$this->title = 'Create Quiz';
?>
<div class="quiz-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
