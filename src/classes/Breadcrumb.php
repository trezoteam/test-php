<?php

namespace Src\classes;

/**
 * Classe responsável por montar os breadcrumbs
 *
 * @author Paulo
 */
class Breadcrumb {

    use \Src\traits\Url;

    private $before;
    private $after;
    private $active;

    /**
     * Construtor do breadcrumb
     */
    public function __construct() {
        $this->before = "<li class='breadcrumb-item'>";
        $this->after = "</li>";
        $this->active = "<li class='breadcrumb-item active' aria-current='page'>";
    }

    /**
     * Definir tags específicas para o breadcrumb
     * @param type $before (tag principal, exibida antes do link)
     * @param type $after (fechamento da tag principal, exibida apos o link)
     * @param type $active (tag principal quando a página em questão estiver ativa, exibida antes do link)
     */
    public function setBreadcrumbTags($before, $after, $active) {
        $this->before = $before;
        $this->after = $after;
        $this->active = $active;
    }

    /**
     * Retorna o breadcrumb
     */
    public function getBreadcrumb() {
        $url = $this->getUrl();
        $entradas = '';
        $links = '';

        for ($i = 0; $i < count($url); $i++) {
            $entradas .= str_replace(" ", "+", $url[$i]) . '/';

            $links .= "\n";
            $links .= ($i == count($url) - 1) ? $this->active : $this->before;
            $links .= "<a href='" . DIRPAGE . $entradas . "'>{$url[$i]}</a>";
            $links .= $this->after;
        }

        return $links;
    }

}
