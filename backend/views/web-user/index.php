<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\WebUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Web Users';
?>
<div class="web-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'email:email',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} ',
                'buttons' => [

                    'view' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"/>', $url, [
                            'title' => Yii::t('app', 'Visualizar'),
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
