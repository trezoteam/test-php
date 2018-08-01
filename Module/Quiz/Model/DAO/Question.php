<?php
namespace Module\Quiz\Model\DAO;
    
    use Module\Quiz\Model\DAO\Quiz as DAO_Quiz;
    use Module\Quiz\Model\DAO\Type as DAO_Type;
    use Module\Quiz\Model\OBJ\Quiz as OBJ_Quiz;
    use Module\Quiz\Model\OBJ\Type as OBJ_Type;
    use Module\Quiz\Model\OBJ\Question as OBJ_Question;
    use Module\Quiz\Model\Util\Conection;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    /**
     * 
     * @author anderson-alan
     * 
     * Design Pattern: Data Access Object - DAO
     * Question
     */
    class Question
    {
        function __construct()
        {
            
        }
        
        /**
         * Inserts a new row on the table Question.
         * @param OBJ_Question $obj_question
         * @return bool
         */
        public static function insert(OBJ_Question $obj_question): bool
        {
            try {
                $sql = 'INSERT INTO question (id, quiz_id, type_id, subject, created_at, updated_at) 
                        VALUES (:id, :quiz_id, :type_id, :sbjct, :crt_at, :upd_at);';
                
                $p_sql = Conection::Connect()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_question->getId(), PDO::PARAM_INT);
                $p_sql->bindValue(':quiz_id', $obj_question->getQuizId(), PDO::PARAM_INT);
                $p_sql->bindValue(':type_id', $obj_question->getTypeId(), PDO::PARAM_INT);
                $p_sql->bindValue(':sbjct', $obj_question->getSubject(), PDO::PARAM_STR);
                $p_sql->bindValue(':crt_at', $obj_question->getCreateAt(), PDO::PARAM_STR);
                $p_sql->bindValue(':upd_at', $obj_question->getUpdatedAt(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Update a existing row on the table Question.
         * @param OBJ_Question $obj_question
         * @return bool
         */
        public static function update(OBJ_Question $obj_question): bool
        {
            try {
                $sql = 'UPDATE question SET
                        id = :id,
                        quiz_id = :quiz_id,
                        type_id = :type_id,
                        subject = :sbjct,
                        created_at = :crt_at,
                        updated_at = :upd_at 
                        WHERE id = :id';

                $p_sql = Conection::Connect()->prepare($sql);

                $p_sql->bindValue(':id', $obj_question->getId(), PDO::PARAM_INT);
                $p_sql->bindValue(':quiz_id', $obj_question->getQuizId(), PDO::PARAM_INT);
                $p_sql->bindValue(':type_id', $obj_question->getTypeId(), PDO::PARAM_INT);
                $p_sql->bindValue(':sbjct', $obj_question->getSubject(), PDO::PARAM_STR);
                $p_sql->bindValue(':crt_at', $obj_question->getCreateAt(), PDO::PARAM_STR);
                $p_sql->bindValue(':upd_at', $obj_question->getUpdatedAt(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Delete a existing row on the table Question.
         * @param int $id
         * @return bool
         */
        public static function delete(int $id): bool
        {
            try {
                $sql = 'DELETE FROM question WHERE id = :id';
                
                $p_sql = Conection::Connect()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Returns the row where the id is the same as past at parameter.
         * @param int $id
         * @return OBJ_Question|boolean
         */
        public static function searchById(int $id)
        {
            try {
                $sql = 'SELECT id, quiz_id, type_id, subject, created_at, updated_at FROM question WHERE id = :id';
                
                $p_sql = Conection::Connect()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::fillQuestion($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Fill an array with all Question rows found by search.
         * @param array $rows
         * @return array
         */
        public static function fillArrayQuestion(array $rows): array
        {
            $questions = [];
            
            foreach ($rows as $row) {
                $obj_question = new OBJ_Question();
                
                if (isset($row['id'])) {
                    $obj_question->setId($row['id']);
                }
                
                if (isset($row['quiz_id'])) {
                    $quiz = DAO_Quiz::searchById($row['quiz_id']);
                    
                    /**
                     * Validates if the new search return error from database.
                     * In case of error, it just sets the Id to the Quiz.
                     */
                    if ($quiz instanceof OBJ_Quiz) {
                        $obj_question->setQuiz($participant);
                    } else {
                        $obj_question->setQuizId($row['quiz_id']);
                    }
                }
                
                if (isset($row['type_id'])) {
                    $type = DAO_Type::searchById($row['type_id']);
                    
                    /**
                     * Validates if the new search return error from database.
                     * In case of error, it just sets the Id to the Type.
                     */
                    if ($type instanceof OBJ_Type) {
                        $obj_question->setType($participant);
                    } else {
                        $obj_question->setTypeId($row['type_id']);
                    }
                }
                
                if (isset($row['subject'])) {
                    $obj_question->setSubject($row['subject']);
                }
                
                if (isset($row['created_at'])) {
                    $obj_question->setCreateAt($row['created_at']);
                }
                
                if (isset($row['updated_at'])) {
                    $obj_question->setUpdatedAt($row['updated_at']);
                }
                
                $questions[] = $obj_question;
            }
            
            return $questions;
        }
        
        /**
         * Fill an object with the Question row found by search.
         * @param array $row
         * @return OBJ_Question
         */
        public static function fillQuestion(array $row): OBJ_Question
        {
            $obj_question = new OBJ_Question();
            
            if (isset($row['id'])) {
                $obj_question->setId($row['id']);
            }
            
            if (isset($row['quiz_id'])) {
                $quiz = DAO_Quiz::searchById($row['quiz_id']);
                
                /**
                 * Validates if the new search return error from database.
                 * In case of error, it just sets the Id to the Quiz.
                 */
                if ($quiz instanceof OBJ_Quiz) {
                    $obj_question->setQuiz($participant);
                } else {
                    $obj_question->setQuizId($row['quiz_id']);
                }
            }
            
            if (isset($row['type_id'])) {
                $type = DAO_Type::searchById($row['type_id']);
                
                /**
                 * Validates if the new search return error from database.
                 * In case of error, it just sets the Id to the Type.
                 */
                if ($type instanceof OBJ_Type) {
                    $obj_question->setType($participant);
                } else {
                    $obj_question->setTypeId($row['type_id']);
                }
            }
            
            if (isset($row['subject'])) {
                $obj_question->setSubject($row['subject']);
            }
            
            if (isset($row['created_at'])) {
                $obj_question->setCreateAt($row['created_at']);
            }
            
            if (isset($row['updated_at'])) {
                $obj_question->setUpdatedAt($row['updated_at']);
            }
            
            return $obj_question;
        }
    }
