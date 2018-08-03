<?php

namespace App\conn;

use App\conn\Conn;

/**
 * Classe responsável por exclusões no banco de dados
 *
 * @author Paulo
 */
class Delete extends Conn {

    private $conn;
    private $result;
    private $error;
    //
    private $delete;
    private $table;
    private $terms;
    private $places;

    public function getError() {
        return $this->error;
    }

    public function getResult() {
        return $this->result;
    }

    public function getRowCount() {
        return $this->delete->rowCount();
    }

    /**
     * Executa uma exclusão no banco de dados
     * 
     * @param STRING $table = Tabela do banco de dados
     * @param STRING $terms = Termos (WHERE coluna = :link AND... OR...)
     * @param STRING $parse = Valores (link={$link}&link2{$link2})
     */
    public function deleteExec($table, $terms, $parse) {
        $this->table = (string) $table;
        $this->terms = (string) $terms;
        parse_str($parse, $this->places);

        $this->getSyntax();
        $this->execute();
    }

    /**
     * Seta novos valores para exclusão
     * 
     * @param type $parse = Valores (link={$link}&link2{$link2})
     */
    public function setPlaces($parse) {
        parse_str($parse, $this->places);
        $this->getSyntax();
        $this->execute();
    }

    /**
     * Cria a sintaxe da query
     */
    private function getSyntax() {
        $this->delete = "DELETE FROM {$this->table} {$this->terms}";
    }

    /**
     * Executa a ação
     */
    private function execute() {
        $this->conn = $this->getConnection();
        $this->delete = $this->conn->prepare($this->delete);

        try {
            $this->delete->execute($this->places);
            $this->result = true;
        } catch (PDOException $e) {
            $this->result = false;
            $this->error = array('messagem' => 'Não foi possível Excluir', 'error' => $e->getMessage(), 'code' => $e->getCode());
        }
    }

}
