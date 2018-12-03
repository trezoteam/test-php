<?php

//Inicia o buffer
ob_start();

//Definindo headers
header("Content-Type: text/html; charset=utf-8");

//Incluindo arquivos
require_once '../config/config.php';
require_once '../src/vendor/autoload.php';

//preparando as rotas
$routes['login'] = 'ControllerLogin';
$routes['quiz'] = 'ControllerQuiz';
$routes['questions'] = 'ControllerQuestions';
$routes['answers'] = 'ControllerAnswers';
$route = new \Src\classes\Routes($routes);

//Saida e encerramento do buffer
ob_end_flush();
