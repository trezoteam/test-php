<?php

namespace App\controller;

use Src\classes\Render;
use Src\interfaces\InterfaceRender;

class Controller404 extends Render implements InterfaceRender {

    /**
     * Método de renderização
     */
    public function pageRender() {
        $this->setTitle("Página Não Encontrada");
        $this->setDescription("404 Página Não Encontrada");
        $this->setDir("404");

        $this->renderLayout();
    }

}
