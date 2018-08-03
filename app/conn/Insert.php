<?php

namespace App\conn;

use App\conn\Conn;

/**
 * Classe responsável por inserções no banco de dados
 *
 * @author Paulo
 */
class Insert extends Conn {

    private $conn;
    private $result;
    private $error;
    //
    private $create;
    private $table;
    private $data;

    public function getError() {
        return $this->error;
    }

    public function getResult() {
        return $this->result;
    }

    /**
     * Executa uma inserção no banco de dados
     * @param type $table = Tabela do banco de dados
     * @param array $data = Array atribuitivo (Nome da Coluna => Valor)
     */
    public function insertExec($table, array $data) {
        $this->table = (string) trim($table);
        $this->data = $data;
        $this->getSyntax();
        $this->execute();
    }

    /**
     * Cria a sintaxe da query
     */
    private function getSyntax() {
        $fields = implode(', ', array_keys($this->data));
        $places = ':' . implode(', :', array_keys($this->data));
        $this->create = "INSERT INTO {$this->table} ({$fields}) VALUES ({$places})";
    }

    /**
     * Executa a ação
     */
    private function execute() {
        $this->conn = $this->getConnection();
        $this->create = $this->conn->prepare($this->create);

        try {
            $this->create->execute($this->data);
            $this->result = $this->conn->lastInsertId();
        } catch (PDOException $e) {
            $this->error = array('message' => 'Erro ao Cadastrar', 'error' => $e->getMessage(), 'code' => $e->getCode());
        }
    }

}
