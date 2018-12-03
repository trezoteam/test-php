<?php

namespace App\model;

class Dashboard {

    private $data;
    private $select;

    public function __construct() {
        $this->select = new \App\conn\Select();
    }

    function getData() {
        return $this->data;
    }

    /**
     * Pega as estatísticas básicas
     */
    public function prepareStatistics() {
        $this->data = null;
        $this->select->selectExec("users", "id");
        $this->data['usuarios'] = $this->select->getRowCount();

        $this->select->selectExec("quiz", "id");
        $this->data['topicos'] = $this->select->getRowCount();

        $this->select->selectExec("questions", "id");
        $this->data['questoes'] = $this->select->getRowCount();

        $this->select->selectExec("answers", "id");
        $this->data['respostas'] = $this->select->getRowCount();

        $this->select->selectExec("user_answers", "id");
        $this->data['respostas_usuarios'] = $this->select->getRowCount();

        $this->select->selectExec("user_answers", "id", "WHERE is_correct IS NOT NULL");
        $this->data['respostas_acertos'] = $this->select->getRowCount();
        $this->data['respostas_erros'] = $this->data['respostas_usuarios'] - $this->data['respostas_acertos'];
    }

    /**
     * Pegar as questões que não tem uma resposta definida
     */
    public function verifyUndefinedAnswers() {
        $this->data = null;
        $answers = [];

        $select = $this->select;
        $select->selectExec("answers", "id,question_id", "GROUP BY question_id");
        if ($select->getRowCount() > 0) {
            foreach ($select->getResult()as $id) {
                $select->selectExec("answers", "*", "WHERE question_id = :id AND is_correct IS NOT NULL LIMIT 1", "id={$id['question_id']}");
                if ($select->getRowCount() < 1) {
                    $answers[] = $id['question_id'];
                }
            }
        }

        $this->getUndefinedAnswers($answers);
    }

    /**
     * Pegar os usuários
     */
    public function getUsers() {
        $this->select->selectExec("users", "id, name");
        $this->data = $this->select->getResult();

        foreach ($this->data as $key => $value) {
            $userData = $this->getUserStatistics($value['id']);
            $this->data[$key]['topicos'] = $userData['topicos'];
            $this->data[$key]['respostas'] = $userData['respostas'];
            $this->data[$key]['acertos'] = $userData['acertos'];
        }
    }

    /**
     * Pega as estatísticas do usuário
     */
    public function getUserStatistics($id) {
        $userData = [];

        $this->select->selectExec("user_answers", "id", "WHERE user = :user GROUP BY quiz_id", "user={$id}");
        $userData['topicos'] = $this->select->getRowCount();
        $this->select->selectExec("user_answers", "id", "WHERE user = :user", "user={$id}");
        $userData['respostas'] = $this->select->getRowCount();
        $this->select->selectExec("user_answers", "id", "WHERE user = :user AND is_correct IS NOT NULL", "user={$id}");
        $userData['acertos'] = $this->select->getRowCount();

        return $userData;
    }

    /**
     * Pegar um usuário específico
     */
    public function getUser($id) {
        $this->select->selectExec("users", "*", "WHERE id = :id", "id={$id}");
        $this->data = ($this->select->getRowCount() > 0) ? $this->select->getResult()[0] : null;
    }

    /**
     * Pegar as respostas do usuário
     */
    public function getUserAnswers($id) {
        $query = "SELECT A.*, T.name, Q.subject, R.answer FROM user_answers A, quiz T, questions Q, answers R WHERE A.user = :user AND T.id = A.quiz_id AND Q.id = A.question_id AND R.id = A.answer";
        $this->select->selectCustom($query, "user={$id}");
        $this->data = $this->select->getResult();
    }

    /**
     * Pega os dados das questões sem resposta definida
     */
    private function getUndefinedAnswers($data) {
        if (count($data) < 1) {
            return false;
        }

        $ids = implode($data, ',');
        $this->select->selectExec("questions", "*", "WHERE id IN({$ids})");
        $this->data = $this->select->getResult();
    }

}
