<?php

use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Trezo - Teste PHP';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Trezo - Teste PHP</h1>

        <p class="lead">Teste realizado por Lucas Santos Ribeiro</p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
            </div>
            <div class="col-lg-8">
                <h2>Escolher um Quiz</h2>

                <p>
                    Utilize esta opção pra selecionar um Quiz
                </p>

                <p><a class="btn btn-default" href="<?= Url::toRoute('quiz/index') ?>">Clique aqui &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
