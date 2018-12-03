<?php

namespace App\conn;

use App\conn\Conn;

/**
 * Classe responsável por atualizações no banco de dados
 *
 * @author Paulo
 */
class Update extends Conn {

    private $conn;
    private $result;
    private $error;
    //
    private $update;
    private $table;
    private $data;
    private $terms;
    private $places;

    public function getError() {
        return $this->error;
    }

    public function getResult() {
        return $this->result;
    }

    public function getRowCount() {
        return $this->update->rowCount();
    }

    /**
     * Executa uma atualização no banco de dados
     * 
     * @param STRING $table = Tabela do banco de dados
     * @param ARRAY $data = Array atribuitivo (Nome da Coluna => Valor)
     * @param STRING $terms = Termos (WHERE coluna = :link AND... OR...)
     * @param STRING $parse = Valores (link={$link}&link2{$link2})
     */
    public function updateExec($table, array $data, $terms, $parse) {
        $this->table = (string) $table;
        $this->data = $data;
        $this->terms = (string) $terms;
        parse_str($parse, $this->places);

        $this->getSyntax();
        $this->execute();
    }

    /**
     * Seta novos valores para o update
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
        $place = [];
        foreach ($this->data as $key => $value) {
            $place[] = $key . ' = :' . $key;
        }
        $places = implode(', ', $place);
        $this->update = "UPDATE {$this->table} SET {$places} {$this->terms}";
    }

    /**
     * Executa a ação
     */
    private function execute() {
        $this->conn = $this->getConnection();
        $this->update = $this->conn->prepare($this->update);

        try {
            $this->update->execute(array_merge($this->data, $this->places));
            $this->result = true;
        } catch (PDOException $e) {
            $this->result = false;
            $this->error = array('messagem' => 'Não foi possível Atualizar', 'error' => $e->getMessage(), 'code' => $e->getCode());
        }
    }

}
