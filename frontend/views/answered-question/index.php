<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modelsAnsweredQuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Obrigado pela participação';
?>
<div class="answered-question-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('Voltar', ['site/index'], ['class' => 'btn btn-primary']) ?>

</div>
