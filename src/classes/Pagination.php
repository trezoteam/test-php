<?php

namespace Src\classes;

use \App\conn\Select;

/**
 * Classe responsável por criar a paginação
 *
 * @author Paulo
 */
class Pagination {

    private $limit;
    private $offset;
    private $results;
    //
    private $page;
    private $pages;
    private $link;
    private $maxLinks;
    private $pager;
    //
    private $before;
    private $after;

    /**
     * Setar a página atual
     * 
     * @param int $page
     */
    function setPage($page) {
        $this->page = $page;
    }

    /**
     * Setar o link base para apontamento das páginas
     * 
     * @param type $link
     */
    function setLink($link) {
        $this->link = $link;
    }

    /**
     * Setar máximo de links para serem exibidos
     * @param type $maxLinks
     */
    function setMaxLinks($maxLinks) {
        $this->maxLinks = $maxLinks;
    }

    /**
     * Setar a tag que envolve o conteúdo
     * @param type $before = Abertura da tag (<li...)
     * @param type $after = Fechamento da tag (</li...)
     */
    function setTag($before, $after) {
        $this->before = $before;
        $this->after = $after;
    }

    /**
     * Retorna o limite para utilizar na query de resultados
     */
    function getLimit() {
        return $this->limit;
    }

    /**
     * Retorna o offset para utilizar na query de resultados
     */
    function getOffset() {
        return $this->offset;
    }

    /**
     * Retorna a quantidade de resultados existentes no banco de dados
     */
    function getResults() {
        return $this->results;
    }

    /**
     * Retorna a quantidade de páginas
     */
    function getPages() {
        return $this->pages;
    }

    /**
     * Retorna o pager (links das páginas)
     */
    function getPager() {
        return $this->pager;
    }

    /**
     * Iniciar nova paginação
     * 
     * @param type $link = Link base para apontamento das páginas
     * @param type $maxLinks = Máximo de links para serem exibidos
     */
    public function __construct($link = null, $maxLinks = null) {
        $this->link = (string) $link;
        $this->maxLinks = ((int) $maxLinks ? $maxLinks : 2);
        $this->pager = '';

        $this->before = "<li>";
        $this->after = "</li>";
    }

    /**
     * Preparar a paginação
     * 
     * @param int $page = Página Atual
     * @param int $limit = Resultados por página
     */
    public function paginationPrepare($page = null, $limit = null) {
        $this->page = ($page == null) ? 1 : (int) $page;
        $this->limit = ($limit == null) ? 10 : (int) $limit;
        $this->offset = ($this->page * $this->limit) - $this->limit;
    }

    /**
     * Criar a paginação
     * 
     * @param type $table = Tabela
     * @param type $return = Dados para retorno
     * @param type $terms = Termos da busca
     * @param type $places = Valores da busca
     */
    public function paginationExecute($table, $return = '*', $terms = null, $places = null) {
        $select = new Select();
        $select->selectExec($table, $return, $terms, $places);
        $this->results = $select->getRowCount();

        if ($this->results > $this->limit) {
            $this->pages = (int) ceil($this->results / $this->limit);
            $this->createPagination();
        }
    }

    /**
     * Adicionar nova página ao pager
     */
    private function addPages($link, $class = null) {
        $title = ($link == 1) ? "Primeira Página" : ($link == $this->pages ? "Última Página" : $link);
        $this->pager .= "\n{$this->before}<a href='{$this->link}{$link}' class='{$class}'>{$title}</a>{$this->after}";
    }

    /**
     * Cria os links das páginas
     */
    private function createPagination() {
        for ($i = $this->page - $this->maxLinks; $i <= $this->page - 1; $i ++) {
            if ($i >= 1) {
                $this->addPages($i);
            }
        }

        $this->addPages($this->page, "active");

        for ($x = $this->page + 1; $x <= $this->page + $this->maxLinks; $x ++) {
            if ($x <= $this->pages) {
                $this->addPages($x);
            }
        }
    }

}
