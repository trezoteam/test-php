<?php

namespace Src\classes;

/**
 * Classe Responsável por trabalhar as rotas
 *
 * @author Paulo
 */
class Routes {

    use \Src\traits\Url;

    private $url;
    private $routes;
    private $method;
    private $param = [];
    private $obj;

    /**
     * Construtor de Rotas
     * 
     * @param array $routes = Outras rotas (rota => controller)
     */
    public function __construct(array $routes = null) {
        $this->url = $this->getUrl();
        $this->defineDefaultRoutes();

        if ($routes != null) {
            foreach ($routes as $route => $controller) {
                $this->routes[$route] = $controller;
            }
        }

        $this->addController();
    }

    /**
     * Seta o Método
     */
    public function setMethod($method) {
        $this->method = $method;
    }

    /**
     * Retorna o Método
     */
    protected function getMethod() {
        return $this->method;
    }

    /**
     * Seta o Parâmetro
     */
    function setParam($param) {
        $this->param = $param;
    }

    /**
     * Retorna o Parâmetro
     */
    function getParam() {
        return $this->param;
    }

    /**
     * Metodo responsável por retornar a rota
     * 
     * @return string Rota
     */
    public function getRoute() {
        $controller = ($this->url[0] != "dashboard") ? $this->url[0] : $this->url[1];

        if (array_key_exists($controller, $this->routes)) {
            if (file_exists(DIRREQ . "app/controller/" . $this->routes[$controller] . ".php")) {
                return $this->routes[$controller];
            } else {
                return 'Controller404';
            }
        } else {
            return 'Controller404';
        }
    }

    /**
     * Definindo as rotas
     */
    private function defineDefaultRoutes() {
        $this->routes['home'] = 'ControllerHome';
        $this->routes['dashboard'] = 'ControllerDashboard';
        $this->routes['404'] = 'Controller404';
    }

    /**
     * Adiciona o controller dashboard
     */
    private function verifyDashboard() {
        if ($this->url[0] == "dashboard" && !isset($this->url[2])) {
            $this->url[2] = $this->url[1];
            $this->url[1] = $this->url[0];
        }
    }

    /**
     * Adicionando os determinados controllers as rotas
     */
    private function addController() {
        $this->verifyDashboard();
        $method = ($this->url[0] == "dashboard" && isset($this->url[2])) ? $this->url[2] : $this->url[1];

        $nameSpaces = "App\\controller\\{$this->getRoute()}";
        $this->obj = new $nameSpaces;

        if (isset($method)) {
            $this->addMethod();
        }
    }

    /**
     * Setando os métodos
     */
    private function addMethod() {
        $method = ($this->url[0] == "dashboard") ? $this->url[2] : $this->url[1];

        if (method_exists($this->obj, $method)) {
            $this->setMethod("{$method}");
        } else {
            $this->setMethod("pageRender");
        }

        $this->addParam();
        call_user_func_array([$this->obj, $this->getMethod()], $this->getParam());
    }

    /**
     * Setando os parâmetros
     */
    private function addParam() {
        $startParam = ($this->url[0] == "dashboard") ? 2 : 1;

        if (count($this->url > 2)) {
            foreach ($this->url as $key => $value) {
                if ($key > $startParam) {
                    $this->setParam($this->param += [$key => $value]);
                }
            }
        }
    }

}
