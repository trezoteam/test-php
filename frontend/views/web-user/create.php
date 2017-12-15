<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\WebUser */
/* @var $quiz_id int */

$this->title = 'Forneça seu Nome e E-mail';
?>
<div class="web-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'quiz_id' => $quiz_id
    ]) ?>

</div>
