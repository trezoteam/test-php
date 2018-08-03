<?php

namespace App\model;

class User {

    use \Src\traits\Post;
    use \Src\traits\Validation;

    private $logged;
    private $user;
    private $message;
    private $messageClass;
    private $post;

    public function __construct() {
        $this->logged = false;
        $this->messageClass = "d-block alert-danger";
        $this->post = $this->getPost();
    }

    function getLogged() {
        return $this->logged;
    }

    function getUser() {
        return $this->user;
    }

    function getMessage() {
        return $this->message;
    }

    function getMessageClass() {
        return $this->messageClass;
    }

    /**
     * Salva o usuário numa sessão
     */
    private function saveSession() {
        $_SESSION['login'] = $this->user;
    }

    /**
     * Verifica se o usuário está logado
     */
    public function restoreSession() {
        if (isset($_SESSION['login'])) {
            $this->user = $_SESSION['login'];
            $this->logged = true;
        }
    }

    /**
     * Registra o visitante
     */
    public function register() {
        if (!isset($this->post['name']) || strlen($this->post['name']) < 3) {
            $this->message = "Nome Inválido";
            return false;
        }
        if (!isset($this->post['email']) || $this->isValidEmail($this->post['email']) == false) {
            $this->message = "Email Inválido";
            return false;
        }

        $user = array("type" => "U", "name" => $this->post['name'], 'email' => $this->post['email'], 'login_at' => date("Y-m-d H:i:s"));

        $select = new \App\conn\Select();
        $select->selectExec("users", "id", "WHERE email = :email", "email={$this->post['email']}");
        if ($select->getRowCount() < 1) {
            $insert = new \App\conn\Insert();
            $user['register_at'] = $user['login_at'];
            $insert->insertExec("users", $user);
        } else {
            $update = new \App\conn\Update();
            $update->updateExec("users", $user, "WHERE email = :email", "email={$this->post['email']}");
        }

        $this->user = $select->getResult()[0];
        $this->logged = true;
        $this->saveSession();
    }

    /**
     * Valida e realiza o login
     */
    public function setLogin() {
        if (!$this->post == true) {
            $this->messageClass = null;
            return false;
        }
        if (!isset($this->post['email']) || $this->isValidEmail($this->post['email']) == false) {
            $this->message = "Email Inválido";
            return false;
        }
        if (!isset($this->post['pass']) || strlen($this->post['pass']) < 3) {
            $this->message = "Senha Inválida";
            return false;
        }

        $select = new \App\conn\Select;
        $select->selectExec("users", "*", "WHERE email = :email AND pass = :pass", "email={$this->post['email']}&pass={$this->post['pass']}");
        if ($select->getRowCount() < 1) {
            $this->message = "Usuário não encontrado";
            return false;
        }

        $this->user = $select->getResult()[0];
        $this->message = "Logado com sucesso";
        $this->logged = true;
        $this->messageClass = "d-block alert-success";
        $this->saveSession();
    }

}
