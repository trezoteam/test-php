<?php
namespace Module\Quiz\Model\DAO;
    
    use Module\Quiz\Model\DAO\Question as DAO_Question;
    use Module\Quiz\Model\OBJ\Question as OBJ_Question;
    use Module\Quiz\Model\OBJ\Option as OBJ_Option;
    use Module\Quiz\Model\Util\Conection;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    /**
     * 
     * @author anderson-alan
     * 
     * Design Pattern: Data Access Object - DAO
     * Option
     */
    class Option
    {
        function __construct()
        {
            
        }
        
        /**
         * Inserts a new row on the table Option.
         * @param OBJ_Option $obj_option
         * @return bool
         */
        public static function insert(OBJ_Option $obj_option): bool
        {
            try {
                $sql = 'INSERT INTO option (id, question_id, answer, is_correct, create_at, updated_at) 
                        VALUES (:id, :qstn_id, :answer, :is_crt, :crt_at, :upd_at);';
                
                $p_sql = Conection::Connect()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_option->getId(), PDO::PARAM_INT);
                $p_sql->bindValue(':qstn_id', $obj_option->getQuestionId(), PDO::PARAM_INT);
                $p_sql->bindValue(':answer', $obj_option->getAnswer(), PDO::PARAM_STR);
                $p_sql->bindValue(':is_crt', $obj_option->getIsCorrect(), PDO::PARAM_BOOL);
                $p_sql->bindValue(':crt_at', $obj_option->getCreateAt(), PDO::PARAM_STR);
                $p_sql->bindValue(':upd_at', $obj_option->getUpdatedAt(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Update a existing row on the table Option.
         * @param OBJ_Option $obj_option
         * @return bool
         */
        public static function update(OBJ_Option $obj_option): bool
        {
            try {
                $sql = 'UPDATE option SET
                        id = :id,
                        question_id = :qstn_id,
                        answer = :answer,
                        is_correct = :is_crt,
                        create_at = :crt_at,
                        updated_at = :upd_at 
                        WHERE id = :id';

                $p_sql = Conection::Connect()->prepare($sql);

                $p_sql->bindValue(':id', $obj_option->getId(), PDO::PARAM_INT);
                $p_sql->bindValue(':qstn_id', $obj_option->getQuestionId(), PDO::PARAM_INT);
                $p_sql->bindValue(':answer', $obj_option->getAnswer(), PDO::PARAM_STR);
                $p_sql->bindValue(':is_crt', $obj_option->getIsCorrect(), PDO::PARAM_BOOL);
                $p_sql->bindValue(':crt_at', $obj_option->getCreateAt(), PDO::PARAM_STR);
                $p_sql->bindValue(':upd_at', $obj_option->getUpdatedAt(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Delete a existing row on the table Option.
         * @param int $id
         * @return bool
         */
        public static function delete(int $id): bool
        {
            try {
                $sql = 'DELETE FROM option WHERE id = :id';
                
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
         * @return OBJ_Option|boolean
         */
        public static function searchById(int $id)
        {
            try {
                $sql = 'SELECT id, question_id, answer, is_correct, create_at, updated_at FROM option WHERE id = :id';
                
                $p_sql = Conection::Connect()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::fillOption($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Fill an array with all Option rows found by search.
         * @param array $rows
         * @return array
         */
        public static function fillArrayOption(array $rows): array
        {
            $options = [];
            
            foreach ($rows as $row) {
                $obj_option = new OBJ_Option();
                
                if (isset($row['id'])) {
                    $obj_option->setId($row['id']);
                }
                
                if (isset($row['question_id'])) {
                    $question = DAO_Question::searchById($row['question_id']);
                    
                    /**
                     * Validates if the new search return error from database.
                     * In case of error, it just sets the Id to the Question.
                     */
                    if ($question instanceof OBJ_Question) {
                        $obj_option->setQuestion($question);
                    } else {
                        $obj_option->setQuestionId($row['question_id']);
                    }
                }
                
                if (isset($row['answer'])) {
                    $obj_option->setAnswer($row['answer']);
                }
                
                if (isset($row['is_correct'])) {
                    $obj_option->setIsCorrect($row['is_correct']);
                }
                
                if (isset($row['create_at'])) {
                    $obj_option->setCreateAt($row['create_at']);
                }
                
                if (isset($row['updated_at'])) {
                    $obj_option->setUpdatedAt($row['updated_at']);
                }
                
                $options[] = $obj_option;
            }
            
            return $options;
        }
        
        /**
         * Fill an object with the Option row found by search.
         * @param array $row
         * @return OBJ_Option
         */
        public static function fillOption(array $row): OBJ_Option
        {
            $obj_option = new OBJ_Option();
            
            if (isset($row['id'])) {
                $obj_option->setId($row['id']);
            }
            
            if (isset($row['question_id'])) {
                $question = DAO_Question::searchById($row['question_id']);
                
                /**
                 * Validates if the new search return error from database.
                 * In case of error, it just sets the Id to the Question.
                 */
                if ($question instanceof OBJ_Question) {
                    $obj_option->setQuestion($question);
                } else {
                    $obj_option->setQuestionId($row['question_id']);
                }
            }
            
            if (isset($row['answer'])) {
                $obj_option->setAnswer($row['answer']);
            }
            
            if (isset($row['is_correct'])) {
                $obj_option->setIsCorrect($row['is_correct']);
            }
            
            if (isset($row['create_at'])) {
                $obj_option->setCreateAt($row['create_at']);
            }
            
            if (isset($row['updated_at'])) {
                $obj_option->setUpdatedAt($row['updated_at']);
            }
            
            return $obj_option;
        }
    }
