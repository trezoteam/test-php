<?php

namespace App\controller;

use Src\classes\Render;
use Src\interfaces\InterfaceRender;
use App\model\User;
use \App\model\Quiz;

class ControllerHome extends Render implements InterfaceRender {

    use \Src\traits\Url;

    private $user;
    private $quiz;

    public function __construct() {
        $this->user = new User;
        $this->user->restoreSession();
        $this->quiz = new Quiz();

        if ($this->user->getLogged() == true && $this->getUrl()[1] == "pageRender") {
            header("location: " . DIRPAGE . "home/topicos");
            return false;
        } else if ($this->getUrl()[1] == "pageRender") {
            header("location: " . DIRPAGE . "home/start");
            return false;
        }
    }

    /**
     * Método de renderização
     */
    public function pageRender() {
        $this->setTitle("Início");
        $this->setDescription("Página Inicial");
        $this->renderLayout();
    }

    /**
     * Login do usuário
     */
    public function start() {
        $this->setView("content", "content_home");
        $this->pageRender();
    }

    /**
     * Iniciando o quiz
     */
    public function topicos() {
        $this->verifyUser();
        $listing = "";
        $listTemplate = $this->loadTemplate("listar_item");
        foreach ($this->quiz->listQuiz() as $quiz) {
            $quiz['link'] = DIRPAGE . "home/topico/{$quiz['id']}";
            $listing .= "\n" . $this->renderTemplate($listTemplate, $quiz);
        }

        $this->setView("content", "content_quiz");
        $this->setView("topicTitle", "Escolha o tópico que deseja responder.");
        $this->setView("topicList", $listing);
        $this->pageRender();
    }

    /**
     * Listando questões do tópico
     */
    public function topico($id = null, $param = null) {
        $this->verifyUser();
        $this->quiz->getQuiz($id);
        $quiz = $this->quiz->getData();

        if (count($quiz) < 1) {
            header("location: " . DIRPAGE . "home/topicos");
            return false;
        }

        $listing = "";
        $listTemplate = $this->loadTemplate("listar_questions");
        foreach ($this->quiz->listQuestions($id) as $question) {
            $question['answers'] = $this->respostas($question['id']);
            $listing .= "\n" . $this->renderTemplate($listTemplate, $question);
        }

        if ($param == "submit") {
            $this->quiz->saveAnswers();
            $this->setView("mensagem_class", $this->quiz->getMessageClass());
            $this->setView("mensagem", $this->quiz->getMessage());
        }

        $this->setView("content", "content_quiz");
        $this->setView("quizSave", DIRPAGE . str_replace("/submit", "", $this->getAtualUrl()) . "/submit/");
        $this->setView("quizId", $id);
        $this->setView("quizStart", date("Y-m-d H:i:s"));
        $this->setView("topicTitle", $quiz['name']);
        $this->setView("topicDescription", $quiz['description']);
        $this->setView("questionsList", $listing);
        $this->pageRender();
    }

    /**
     * Listando as respostas
     */
    private function respostas($question) {
        $answers = "";
        foreach ($this->quiz->listAnswers($question) as $answer) {
            $answers .= "<li class='text-secondary py-2 mb-2 px-2 rounded' data-id='{$answer['id']}'><span>{$answer['answer']}</span></li>";
        }

        return $answers;
    }

    /**
     * Verifica se o usuário pode acessar o quiz
     */
    private function verifyUser() {
        if ($this->user->getLogged() == false) {
            header("location: " . DIRPAGE . "home/start");
            return false;
        }
    }

    /**
     * Acesso do usuário
     */
    public function submit() {
        $this->user->register();
        $this->setView("login_message", $this->user->getMessage());
        $this->setView("login_message_class", $this->user->getMessageClass());

        if ($this->user->getLogged() == true) {
            header("location: " . DIRPAGE . "home/topicos");
            return false;
        }

        $this->pageRender();
    }

}
