<?php

namespace App\model;

use App\model\User;

class Quiz {

    use \Src\traits\Post;

    private $user;
    private $post;
    private $data;
    private $message;
    private $messageClass;

    public function __construct() {
        $this->user = new User();
        $this->user->restoreSession();
        $this->post = $this->getPost();
        $this->data = $this->post;
        $this->messageClass = "d-block alert-danger";
        $this->message = "Ops, não foi possível realizar esta operação";
    }

    public function getData() {
        return $this->data;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getMessageClass() {
        return $this->messageClass;
    }

    /**
     * Cria e atualiza um tópico
     */
    public function saveQuiz() {
        if ($this->post == null || $this->verifyReSubmit() == true) {
            $this->messageClass = ($this->post == null) ? null : $this->messageClass;
            return false;
        }

        if (!isset($this->post['name']) || strlen($this->post['name']) < 5) {
            $this->message = "O título do seu tópico deve conter mais de 5 caracteres";
            return false;
        }

        if (!isset($this->post['description']) || strlen($this->post['description']) < 20) {
            $this->message = "A descrição do seu tópico deve conter mais de 20 caracteres";
            return false;
        }

        $dados = array("name" => $this->post['name'], "description" => $this->post['description'], 'updated_at' => date("Y-m-d H:i:s"));
        if (isset($this->post['id']) && $this->post['id'] != null) {
            $acao = new \App\conn\Update();
            $acao->updateExec("quiz", $dados, "WHERE id = :id", "id={$this->post['id']}");
            $this->data = $this->post;
        } else {
            $acao = new \App\conn\Insert();
            $dados['created_at'] = $dados['updated_at'];
            $acao->insertExec("quiz", $dados);
            $this->post['id'] = $acao->getResult();
            $this->data = null;
        }

        if ((int) $acao->getResult() > 0) {
            $this->messageClass = "d-block alert-success";
            $this->message = "Concluído com sucesso!";
            $this->verifyReSubmit(true);
        }
    }

    /**
     * Retorna os tópicos
     */
    public function listQuiz() {
        $selec = new \App\conn\Select();
        $selec->selectExec("quiz", "id,name", "ORDER BY id ASC");

        return $selec->getResult();
    }

    /**
     * Retorna as questões do tópico
     */
    public function listQuestions($id) {
        $selec = new \App\conn\Select();
        $selec->selectExec("questions", "id,subject", "WHERE quiz_id = :id ORDER BY id ASC", "id={$id}");

        return $selec->getResult();
    }

    /**
     * Retorna as respostas
     */
    public function listAnswers($id) {
        $selec = new \App\conn\Select();
        $selec->selectExec("answers", "id,answer", "WHERE question_id = :id ORDER BY id ASC", "id={$id}");

        return $selec->getResult();
    }

    /**
     * Pegar um tópico específico
     */
    public function getQuiz($id) {
        $select = new \App\conn\Select();
        $select->selectExec("quiz", "*", "WHERE id = :id", "id={$id}");

        if ($select->getRowCount() > 0) {
            $this->data = $select->getResult()[0];
        }
    }

    /**
     * Salvar Respostas do usuário
     */
    public function saveAnswers() {
        if ($this->post == null) {
            return false;
        }

        $answered = [];
        $newAnswer = [];
        $insert = new \App\conn\Insert();
        $selct = new \App\conn\Select;
        foreach ($this->post['question_answer'] as $key => $value) {
            if ($value != null) {
                $selct->selectExec('answers', "id", "WHERE question_id = :id AND is_correct IS NULL", "id={$this->post['question_id'][$key]}");

                $data['user'] = $this->user->getUser()['id'];
                $data['quiz_id'] = $this->post['id'];
                $data['question_id'] = $this->post['question_id'][$key];
                $data['answer'] = $value;
                $data['is_correct'] = ($selct->getRowCount() == 1) ? 1 : null;
                $data['started_at'] = $this->post['started'];
                $data['completed_at'] = date("Y-m-d H:i:s");

                $selct->selectExec("user_answers", "id", "WHERE user = :user AND question_id = :question_id", "user={$data['user']}&question_id={$data['question_id']}");
                if ($selct->getRowCount() < 1) {
                    $insert->insertExec("user_answers", $data);
                    $newAnswer[] = $data['question_id'];
                } else {
                    $answered[] = $data['question_id'];
                }
            }
        }

        $this->messageClass = "d-block alert-success";
        $this->message = "Respostas anotadas com sucesso!<br>";
        if (count($newAnswer) > 0) {
            $this->message .= "<br>Questões respondidas: <b>" . implode($newAnswer, ", ") . "</b>";
        }
        if (count($answered) > 0) {
            $this->message .= "<br>Você já respondeu anteriormente as questões: <b>" . implode($answered, ", ") . "</b>";
        }
    }

    /**
     * Excluir um Quiz
     */
    public function deleteQuiz($id) {
        $select = new \App\conn\Select();
        $delete = new \App\conn\Delete();

        $select->selectExec("questions", "id", "WHERE quiz_id = :id", "id={$id}");
        if ($select->getRowCount() > 0) {
            foreach ($select->getResult() as $question) {
                $delete->deleteExec("answers", "WHERE question_id = :id", "id={$question['id']}");
            }
        }

        $delete->deleteExec("quiz", "WHERE id = :id", "id={$id}");
        $delete->deleteExec("questions", "WHERE quiz_id = :id", "id={$id}");
    }

    /**
     * Verifica se o formulário está sendo submetido outra vez
     * 
     * @param type $new
     * @return boolean
     */
    private function verifyReSubmit($new = false) {
        if ($new == true) {
            $_SESSION['last_save_quiz'] = $this->post;
        } else if (isset($_SESSION['last_save_quiz'])) {
            $diff = array_diff($_SESSION['last_save_quiz'], $this->post);
            if (count($diff) == 1 && isset($diff['id'])) {
                $this->message = "Você já cadastrou essas informações";
                return true;
            }
        }
    }

}
