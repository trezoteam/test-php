<?php

namespace Src\classes;

use App\model\User;

class Render {

    use \Src\traits\Url;

    private $view;
    private $content;
    //
    private $dir;
    private $title;
    private $description;

    function setContent($content) {
        $this->content = $content;
    }

    public function setTitle($title) {
        $this->title = SITE_TITLE . (($title == null) ? '' : ' | ' . $title);
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setDir($dir) {
        $this->dir = $dir;
    }

    function getContent() {
        return $this->content;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getDir() {
        $dir = ($this->getUrl()[0] == "dashboard" && $this->getUrl()[1] != "pageRender") ? $this->getUrl()[1] : $this->getUrl()[0];
        if ($this->dir == null) {
            $this->dir = $dir;
        }

        return $this->dir;
    }

    /**
     * Armazena conteúdo para ser utilizado na view
     * 
     * @param type $key = Chave do conteúdo
     * @param type $value = Conteúdo
     */
    public function setView($key, $value) {
        $this->view[$key] = $value;
    }

    /**
     * Retorna o conteúdo da view
     * 
     * @param type $key = Chave do conteúdo
     * @return type
     */
    public function getView($key = null) {
        if ($key == null) {
            return $this->view;
        } else if ($key != null && isset($this->view[$key])) {
            return $this->view[$key];
        } else {
            return null;
        }
    }

    /**
     * Adicionar um novo conteúdo
     */
    public function addContent($content = null) {
        $incFile = ($this->getContent() == null) ? 'content' : $this->getContent();
        if ($content != null) {
            $incFile = $content;
        }

        if (file_exists(DIRREQ . "app/view/{$this->getDir()}/{$incFile}.php")) {
            include_once DIRREQ . "app/view/{$this->getDir()}/{$incFile}.php";
        }
    }

    /**
     * Adiciona o dashboard
     */
    public function addDashboard() {
        if ($this->getUrl()[0] != 'dashboard') {
            return false;
        }

        $user = new User();
        $user->restoreSession();

        if ($user->getLogged() == false) {
            header("location: " . DIRPAGE . "login");
            return false;
        }

        $this->setView("user", $user->getUser());

        include_once DIRREQ . 'app/view/Dashboard.php';
        return true;
    }

    /**
     * Renderizar o layout
     */
    public function renderLayout() {
        include_once DIRREQ . 'app/view/Layout.php';
    }

    /**
     * Adicionar novas características no head
     */
    public function addHead() {
        if (file_exists(DIRREQ . "app/view/{$this->getDir()}/head.php")) {
            include DIRREQ . "app/view/{$this->getDir()}/head.php";
        }
    }

    /**
     * Carrega um template HTML
     * 
     * @param type $template
     * @return string
     */
    public function loadTemplate($template) {
        if (file_exists(DIRREQ . "app/view/{$this->getDir()}/{$template}.html")) {
            return file_get_contents(DIRREQ . "app/view/{$this->getDir()}/{$template}.html");
        }
    }

    /**
     * Renderiza o template HTML
     * 
     * @param type $template
     * @param array $dados
     * @return type
     */
    public function renderTemplate($template, array $dados) {
        $keys = explode('&', '{' . implode('}&{', array_keys($dados)) . '}');
        $values = array_values($dados);
        return str_replace($keys, $values, $template);
    }

}
