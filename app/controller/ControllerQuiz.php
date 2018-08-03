<?php

namespace App\controller;

use Src\classes\Render;
use Src\interfaces\InterfaceRender;
use App\model\Quiz;

class ControllerQuiz extends Render implements InterfaceRender {

    use \Src\traits\Url;

    private $quiz;

    public function __construct() {
        $this->quiz = new Quiz();
    }

    /**
     * Método de renderização
     */
    public function pageRender() {
        $this->setTitle("Dashboard - Tópicos");
        $this->setDescription("Página Administrativa - Edição de Tópicos");

        if ($this->getUrl()[0] != "dashboard" && $this->getUrl()[1] == "pageRender") {
            header("location: " . DIRPAGE . "quiz/topicos");
        }

        $this->renderLayout();
    }

    /**
     * Cadastrar Tópicos
     */
    public function cadastrar($param = null) {
        $this->setView("save_url", str_replace("/submit", "", $this->getAtualUrl()) . "/submit/");
        $this->setView("dashboardTitle", 'Cadastro de Tópicos');
        $this->setView("content", "dashboard_cadastro");

        if ($param == 'submit') {
            $this->submitQuiz();
        }

        if ($this->quiz->getData() != null) {
            $this->setView('data', $this->quiz->getData());
        }

        $this->pageRender();
    }

    /**
     * Listar Tópicos
     */
    public function listar() {
        $this->setView("dashboardTitle", 'Lista de Tópicos');
        $this->setView("content", "dashboard_listar");

        $listing = "";
        $listTemplate = $this->loadTemplate("dashboard_listar_item");
        foreach ($this->quiz->listQuiz() as $quiz) {
            $quiz['link_questoes'] = DIRPAGE . "dashboard/questions/listar/{$quiz['id']}";
            $quiz['link_editar'] = DIRPAGE . "dashboard/quiz/editar/{$quiz['id']}";
            $quiz['link_excluir'] = DIRPAGE . "dashboard/quiz/excluir/{$quiz['id']}";
            $listing .= "\n" . $this->renderTemplate($listTemplate, $quiz);
        }

        $this->setView("contentList", $listing);
        $this->pageRender();
    }

    /**
     * Editar Tópico
     * @param type $id
     */
    public function editar($id = null, $param = null) {
        $this->setView("save_url", str_replace("/submit", "", $this->getAtualUrl()) . "/submit/");
        $this->setView("dashboardTitle", 'Editar Tópico');
        $this->setView("content", "dashboard_cadastro");
        $this->quiz->getQuiz($id);

        if ($param == 'submit') {
            $this->submitQuiz();
        }

        if ($this->quiz->getData() != null) {
            $this->setView('data', $this->quiz->getData());
        }

        $this->pageRender();
    }

    /**
     * Submeter formulário
     */
    private function submitQuiz() {
        $this->quiz->saveQuiz();
        $this->setView("mensagem_cadastro_class", $this->quiz->getMessageClass());
        $this->setView("mensagem_cadastro", $this->quiz->getMessage());
    }

    /**
     * Excluir Tópico
     * @param type $id
     */
    public function excluir($id = null) {
        if ($id != null) {
            $this->quiz->deleteQuiz($id);
            header("location: " . DIRPAGE . "dashboard/quiz/listar");
        }
    }

}
