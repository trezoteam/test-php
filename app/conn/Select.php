<?php

namespace App\conn;

use App\conn\Conn;

/**
 * Classe responsável por leituras no banco de dados
 *
 * @author Paulo
 */
class Select extends Conn {

    private $conn;
    private $result;
    private $error;
    //
    private $select;
    private $terms;
    private $places;

    public function getError() {
        return $this->error;
    }

    public function getResult() {
        return $this->result;
    }

    public function getRowCount() {
        return $this->select->rowCount();
    }

    /**
     * Executa uma leitura no banco de dados
     * 
     * @param STRING $table = Tabela do banco de dados
     * @param STRING $return = Colunas a serem retornadas
     * @param STRING $terms = Termos (WHERE | ORDER | LIMIT :limit | OFFSET :offset)
     * @param STRING $parse = Valores (link={$link}&link2{$link2})
     */
    public function selectExec($table, $return, $terms = null, $parse = null) {
        if ($parse != null) {
            parse_str($parse, $this->places);
        }
        $this->terms = "SELECT {$return} FROM {$table} {$terms}";

        $this->execute();
    }

    /**
     * Executa uma leitura CUSTOMIZADA no banco de dados
     * 
     * @param type $query
     * @param type $parse
     */
    public function selectCustom($query, $parse = null) {
        $this->terms = (string) $query;
        if (!empty($parse)) {
            parse_str($parse, $this->places);
        }

        $this->execute();
    }

    /**
     * Seta novos valores para leitura
     * 
     * @param type $parse = Valores (link={$link}&link2{$link2})
     */
    public function setPlaces($parse) {
        parse_str($parse, $this->places);
        $this->execute();
    }

    /**
     * Cria a sintaxe da query
     */
    private function getSyntax() {
        if (is_array($this->places)) {
            foreach ($this->places as $bond => $value) {
                if ($bond == 'limit' || $bond == 'offset') {
                    $value = (int) $value;
                }
                $this->select->bindValue(":{$bond}", $value, (is_int($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR));
            }
        }
    }

    /**
     * Executa a ação
     */
    private function execute() {
        $this->conn = $this->getConnection();
        $this->select = $this->conn->prepare($this->terms);
        $this->select->setFetchMode(\PDO::FETCH_ASSOC);
        try {
            $this->getSyntax();
            $this->select->execute();
            $this->result = $this->select->fetchAll();
        } catch (PDOException $e) {
            $this->result = false;
            $this->error = array('messagem' => 'Não foi possível Realizar a Leitura', 'error' => $e->getMessage(), 'code' => $e->getCode());
        }
    }

}
