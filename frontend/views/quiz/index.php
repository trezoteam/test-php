<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\QuizSerach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quizzes';
?>
<div class="quiz-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description',
            'created_at',
            'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{web-user/create} ',
                'buttons' => [

                    'web-user/create' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-info-sign"/>', $url, [
                            'title' => Yii::t('app', 'Responder'),
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
