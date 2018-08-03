<?php

namespace App\model;

class Questions {

    use \Src\traits\Post;

    private $post;
    private $data;
    private $answers;
    private $message;
    private $messageClass;

    public function __construct() {
        $this->post = $this->getPost();
        $this->messageClass = "d-block alert-danger";
        $this->message = "Ops, não foi possível realizar esta operação";
        $this->data = $this->post;
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
    public function saveQuestion() {
        if ($this->post == null || $this->verifyReSubmit() == true) {
            $this->messageClass = ($this->post == null) ? null : $this->messageClass;
            return false;
        }

        if ($this->post == null || $this->verifyReSubmit() == true) {
            $this->messageClass = ($this->post == null) ? null : $this->messageClass;
            return false;
        }

        if (!isset($this->post['subject']) || strlen($this->post['subject']) < 20) {
            $this->message = "Sua questão deve conter mais de 20 caracteres";
            return false;
        }

        $this->prepareAnswers();

        $dados = array("subject" => $this->post['subject'], "quiz_id" => $this->post['quiz_id'], 'type' => $this->post['type'], 'updated_at' => date("Y-m-d H:i:s"));
        if (isset($this->post['id']) && $this->post['id'] != null) {
            $acao = new \App\conn\Update();
            $acao->updateExec("questions", $dados, "WHERE id = :id", "id={$this->post['id']}");
            $this->data = $this->post;
        } else {
            $acao = new \App\conn\Insert();
            $dados['created_at'] = $dados['updated_at'];
            $acao->insertExec("questions", $dados);
            $this->post['id'] = $acao->getResult();
            $this->data = $this->post['id'];
        }

        if ((int) $acao->getResult() > 0) {
            $this->messageClass = "d-block alert-success";
            $this->message = "Concluído com sucesso!";
            $this->verifyReSubmit(true);
        }
    }

    /**
     * Prepara as respostas
     */
    private function prepareAnswers() {
        $this->answers = null;
        $corrects = 0;
        foreach ($this->post['answer']as $key => $value) {
            if ($value != null) {
                $corrects = ($this->post['is_correct'][$key] == '1') ? $corrects + 1 : $corrects;
                $this->saveAnswer($this->post['answer_id'][$key], $value, $this->post['is_correct'][$key], $this->post['is_exclude'][$key]);
            }
        }

        $this->post['type'] = ($corrects > 1) ? 'multiple' : 'single';
    }

    /**
     * Salva a resposta
     */
    private function saveAnswer($id, $answer, $correct, $exclude) {
        $data = array('answer' => $answer, 'is_correct' => $correct, 'question_id' => $this->post['id'], 'updated_at' => date("Y-m-d H:i:s"));

        if ($id == null && $exclude == null) {
            $insert = new \App\conn\Insert();
            $data['created_at'] = $data['updated_at'];
            $insert->insertExec("answers", $data);
            $data['id'] = $insert->getResult();
        }

        if ($id != null && $exclude == null) {
            $update = new \App\conn\Update();
            $update->updateExec("answers", $data, "WHERE id = :id", "id={$id}");
        }

        if ($id != null && $exclude != null) {
            $delete = new \App\conn\Delete();
            $delete->deleteExec("answers", "WHERE id = :id", "id={$id}");
        } else {
            $this->answers[] = $data;
        }
    }

    /**
     * Retorna os tópicos
     */
    public function listQuestions($id) {
        $selec = new \App\conn\Select();
        $selec->selectExec("questions", "id,subject,quiz_id", "WHERE quiz_id = :id ORDER BY id ASC", "id={$id}");

        return $selec->getResult();
    }

    /**
     * Retorna as respostas
     */
    public function getAnswers($id) {
        if ($id != null) {
            $select = new \App\conn\Select();
            $select->selectExec("answers", "*", "WHERE question_id = :id ORDER BY id ASC", "id={$id}");
            $this->answers = $select->getResult();
        }

        return $this->answers;
    }

    /**
     * Pegar um tópico específico
     */
    public function getQuestion($id) {
        $select = new \App\conn\Select();
        $select->selectExec("questions", "*", "WHERE id = :id", "id={$id}");
        if ($select->getRowCount() > 0) {
            $this->data = $select->getResult()[0];
        }
    }

    /**
     * Excluir um Quiz
     */
    public function deleteQuestion($id) {
        $delete = new \App\conn\Delete();
        $delete->deleteExec("answers", "WHERE question_id = :id", "id={$id}");
        $delete->deleteExec("questions", "WHERE id = :id", "id={$id}");
    }

    /**
     * Verifica se o formulário está sendo submetido outra vez
     * 
     * @param type $new
     * @return boolean
     */
    private function verifyReSubmit($new = false) {
        $post = null;
        if ($this->post != null) {
            foreach ($this->post as $key => $value) {
                if (!is_array($value)) {
                    $post[$key] = $value;
                }
            }
        }

        if ($new == true) {
            $_SESSION['last_save_quiz'] = $post;
        } else if (isset($_SESSION['last_save_quiz'])) {
            $diff = array_diff($_SESSION['last_save_quiz'], $post);
            if (count($diff) == 1 && isset($diff['id'])) {
                $this->message = "Você já cadastrou essas informações";
                return true;
            }
        }
    }

}
