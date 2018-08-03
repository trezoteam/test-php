<?php

//Iniciando sessão
session_start();

//Timezone
date_default_timezone_set("Brazil/East");

//Definições do Projeto
define("INTERNAL_FOLDER", "test-php/");
define("SITE_TITLE", "QUIZ Trezo");
define("SITE_AUTHOR", "Paulo Sérgio");

//Diretórios
define("DIRPAGE", "http://{$_SERVER['HTTP_HOST']}/" . INTERNAL_FOLDER);
define("DIRREQ", $_SERVER['DOCUMENT_ROOT'] . ((substr($_SERVER['DOCUMENT_ROOT'], -1) == "/") ? "" : "/") . INTERNAL_FOLDER);

define("DIRIMG", DIRPAGE . "public/img/");
define("DIRJS", DIRPAGE . "public/js/");
define("DIRCSS", DIRPAGE . "public/css/");

//Banco de dados
define("HOST", "localhost");
define("DBSA", "quiz");
define("USER", "root");
define("PASS", "");
