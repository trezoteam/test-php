<?php

namespace App\controller;

use Src\classes\Render;
use Src\interfaces\InterfaceRender;
use App\model\User;

class ControllerLogin extends Render implements InterfaceRender {

    private $user;

    public function __construct() {
        $this->user = new User();
        $this->user->restoreSession();
        if ($this->getUrl()[1] == 'logout') {
            $this->logOut();
        }

        if (isset($this->user->getUser()['type']) && $this->user->getUser()['type'] == "A") {
            $this->redirectUser();
        }
    }

    /**
     * Método de renderização
     */
    public function pageRender() {
        $this->setTitle("Login");
        $this->setDescription("Acesse sua conta");
        $this->renderLayout();
    }

    /**
     * Método de login
     */
    public function submit() {
        $this->user->setLogin();
        $this->setView("login_message", $this->user->getMessage());
        $this->setView("login_message_class", $this->user->getMessageClass());
        $this->redirectUser();
        $this->pageRender();
    }

    /**
     * Realiza o logout
     */
    private function logOut() {
        if (isset($_SESSION['login'])) {
            unset($_SESSION['login']);
        }
        header("location: " . DIRPAGE);
        return false;
    }

    /**
     * Redireciona o usuário logado
     */
    private function redirectUser() {
        if ($this->user->getLogged() == true) {
            $sendUser = ($this->user->getUser()['type'] == "A") ? DIRPAGE . 'dashboard/' : DIRPAGE;
            header("location: {$sendUser}");
            return false;
        }
    }

}
