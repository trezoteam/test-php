<?php

use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Trezo - Teste PHP';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Trezo - Teste PHP (Admin Area)</h1>

        <p class="lead">Teste realizado por Lucas Santos Ribeiro</p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Novo Quiz</h2>

                <p>
                    Utilize esta opção pra administrar o Quiz
                </p>

                <p><a class="btn btn-default" href="<?= Url::toRoute('quiz/index') ?>">Clique aqui &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Relatórios Quiz</h2>

                <p>
                    Utilize esta opção pra vizualizar os relatórios
                </p>

                <p><a class="btn btn-default" href="<?= Url::toRoute('web-user/index') ?>">Clique aqui &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>API</h2>

                <p>
                    Utilize esta opção pra ter acesso à documentaçãoda API
                </p>

                <p><a class="btn btn-default" href="<?= Url::toRoute('site/api') ?>">Clique aqui &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
