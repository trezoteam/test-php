<?php

namespace App\controller;

use Src\classes\Render;
use Src\interfaces\InterfaceRender;
use App\model\Questions;

class ControllerQuestions extends Render implements InterfaceRender {

    use \Src\traits\Url;

    private $questions;

    public function __construct() {
        $this->questions = new Questions();
    }

    /**
     * Método de renderização
     */
    public function pageRender() {
        $this->setTitle("Dashboard - Questões");
        $this->setDescription("Página Administrativa - Edição de Questões");
        $this->renderLayout();
    }

    /**
     * Cadastrar Questões
     */
    public function cadastrar($quiz = null, $param = null) {
        if ($quiz == null) {
            header("location: " . DIRPAGE . "404");
            return false;
        }

        $this->setView("save_url", str_replace("/submit", "", $this->getAtualUrl()) . "/submit/");
        $this->setView("quiz_id", $quiz);
        $this->setView("dashboardTitle", 'Cadastro de Questões');
        $this->setView("content", "dashboard_cadastro");

        if ($param == 'submit') {
            $this->submitQuestion();
        }

        $data = $this->questions->getData();
        if ($data != null && is_array($data)) {
            $this->setView('data', $data);
        } else if ($data != null && !is_array($data)) {
            header("location: " . DIRPAGE . "dashboard/questions/editar/{$data}");
            return false;
        }

        $this->pageRender();
    }

    /**
     * Listar Questões
     */
    public function listar($id = null) {
        $this->setView("dashboardTitle", 'Lista de Questões');
        $this->setView("content", "dashboard_listar");
        $this->setView("quiz_id", $id);

        $listing = "";
        $listTemplate = $this->loadTemplate("dashboard_listar_item");
        foreach ($this->questions->listQuestions($id) as $question) {
            $question['link_editar'] = DIRPAGE . "dashboard/questions/editar/{$question['id']}";
            $question['link_excluir'] = DIRPAGE . "dashboard/questions/excluir/{$question['id']}/{$question['quiz_id']}";
            $question['name'] = (strlen($question['subject']) > 60) ? substr($question['subject'], 0, 60) . '...' : $question['subject'];

            $listing .= "\n" . $this->renderTemplate($listTemplate, $question);
        }

        $this->setView("contentList", $listing);
        $this->listAnswers($id);
        $this->pageRender();
    }

    /**
     * Editar Questão
     * @param type $id
     */
    public function editar($id = null, $param = null) {
        if ($id == null) {
            header("location: " . DIRPAGE . "404");
            return false;
        }

        $this->setView("save_url", str_replace("/submit", "", $this->getAtualUrl()) . "/submit/");
        $this->setView("dashboardTitle", 'Editar Questão');
        $this->setView("content", "dashboard_cadastro");
        $this->questions->getQuestion($id);

        if ($param == 'submit') {
            $this->submitQuestion();
        }

        if ($this->questions->getData() != null) {
            $this->setView('data', $this->questions->getData());
        }

        $this->listAnswers($id);
        $this->pageRender();
    }

    /**
     * Submeter formulário
     */
    private function submitQuestion() {
        $this->questions->saveQuestion();
        $this->setView("mensagem_cadastro_class", $this->questions->getMessageClass());
        $this->setView("mensagem_cadastro", $this->questions->getMessage());
    }

    /**
     * Listar as respostas
     */
    private function listAnswers($id = null) {
        $answers = $this->questions->getAnswers($id);
        if ($answers != null) {
            $list = "";
            $template = $this->loadTemplate("dashboard_questions");
            foreach ($answers as $answer) {
                $answer['is_correct_class'] = ($answer['is_correct'] == '1') ? 'answer-correct' : '';
                $list .= "\n" . $this->renderTemplate($template, $answer);
            }

            $this->setView("listAnswers", $list);
        }
    }

    /**
     * Excluir Tópico
     * @param type $id
     */
    public function excluir($id = null, $question = null) {
        if ($id != null) {
            $this->questions->deleteQuestion($id);
            header("location: " . DIRPAGE . "dashboard/questions/listar/{$question}");
        }
    }

}
