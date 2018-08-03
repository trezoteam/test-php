<?php

namespace App\conn;

/**
 * Classe responsável pela conexão com o Banco de Dadossd
 *
 * @author Paulo
 */
abstract class Conn {

    private $Connect;

    protected function getConnection() {
        if ($this->Connect == null) {
            try {
                $dsn = 'mysql:host=' . HOST . ';dbname=' . DBSA;
                $options = [\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
                $this->Connect = new \PDO($dsn, USER, PASS, $options);
            } catch (\PDOException $e) {
                return $e->getMessage();
            }
        }

        $this->Connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $this->Connect;
    }

}
