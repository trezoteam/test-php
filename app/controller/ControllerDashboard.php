<?php

namespace App\controller;

use Src\classes\Render;
use Src\interfaces\InterfaceRender;
use App\model\Dashboard;

class ControllerDashboard extends Render implements InterfaceRender {

    use \Src\traits\Url;

    private $dashboard;

    public function __construct() {
        $this->dashboard = new Dashboard();
    }

    /**
     * Método de renderização
     */
    public function pageRender() {
        $this->setTitle("Dashboard");
        $this->setDescription("Página Administrativa");

        if ($this->getUrl()[1] == 'pageRender') {
            $this->start();
        }

        $this->renderLayout();
    }

    /**
     * Visão Geral
     */
    private function start() {
        $this->setView("dashboardTitle", "Visão Geral");
        $this->statistics();
        $this->undefinedAnswers();
        $this->listUsers();
    }

    /**
     * Ver tópicos que o usuário respondeu
     */
    public function usuario($id = null) {
        $this->dashboard->getUser($id);
        $user = $this->dashboard->getData();

        if ($user == null) {
            header("location: " . DIRPAGE . "dashboard");
            return false;
        }

        $this->setView("dashboardTitle", "Estatísticas do Usuário");
        $this->setView("content", "user");
        $this->setView("userName", $user['name']);
        $this->setView("userStatistics", $this->dashboard->getUserStatistics($user['id']));

        $this->dashboard->getUserAnswers($id);
        $data = $this->dashboard->getData();

        $listing = "";
        $listTemplate = $this->loadTemplate("user_respostas");
        if (count($data) > 0) {
            foreach ($data as $res) {
                $res['correct'] = ($res['is_correct'] == "1") ? "<i class='ion-checkmark text-success h3 d-block'></i>" : "<i class='ion-alert text-danger h3 d-block'></i>";
                $res['correct'] .= "<span class='d-block mt-2'>Início: " . date("d/m/y H:i", strtotime($res['started_at'])) . "</span>";
                $res['correct'] .= "<span class='d-block mt-2'>Término: " . date("d/m/y H:i", strtotime($res['completed_at'])) . "</span>";

                $listing .= "\n" . $this->renderTemplate($listTemplate, $res);
            }
            $this->setView("userListaRespostas", $listing);
        }

        $this->pageRender();
    }

    /**
     * Pega as estatísticas Básicas
     */
    private function statistics() {
        $this->dashboard->prepareStatistics();
        $data = $this->dashboard->getData();

        $this->setView("totalUsuarios", $data['usuarios']);
        $this->setView("totalTopicos", $data['topicos']);
        $this->setView("totalQuestoes", $data['questoes']);
        $this->setView("totalRespostas", $data['respostas']);
        $this->setView("totalRespostasUsuarios", $data['respostas_usuarios']);
        $this->setView("totalRespostasCertas", $data['respostas_acertos']);
        $this->setView("totalRespostasErradas", $data['respostas_erros']);
    }

    /**
     * Pega a lista de questões sem resposta definida
     */
    private function undefinedAnswers() {
        $this->dashboard->verifyUndefinedAnswers();
        $questions = $this->dashboard->getData();

        if (count($questions) < 1) {
            return false;
        }

        $listing = "";
        $listTemplate = $this->loadTemplate("dashboard_listar_item");
        foreach ($questions as $question) {
            $question['link_editar'] = DIRPAGE . "dashboard/questions/editar/{$question['id']}";
            $question['link_excluir'] = DIRPAGE . "dashboard/questions/excluir/{$question['id']}/{$question['quiz_id']}";
            $question['name'] = (strlen($question['subject']) > 60) ? substr($question['subject'], 0, 60) . '...' : $question['subject'];
            $listing .= "\n" . $this->renderTemplate($listTemplate, $question);
        }

        $this->setView("respostasIndefinidas", $listing);
    }

    /**
     * Listar usuários e respostas
     */
    private function listUsers() {
        $this->dashboard->getUsers();
        $users = $this->dashboard->getData();

        $listing = "";
        foreach ($users as $user) {
            $listing .= "<li class='border-top'><a href='" . DIRPAGE . "dashboard/dashboard/usuario/{$user['id']}' class='text-dark'>{$user['name']} <span class='text-secondary'>- {$user['topicos']} Tópicos | {$user['respostas']} Respostas | {$user['acertos']} Acertos</span></a></li>";
        }

        $this->setView("respostasUsuarios", $listing);
    }

}
