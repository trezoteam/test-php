<?php
namespace Module\Quiz\Model\DAO;
    
    use Module\Quiz\Model\DAO\Result as DAO_Result;
    use Module\Quiz\Model\DAO\Option as DAO_Option;
    use Module\Quiz\Model\DAO\Question as DAO_Question;
    use Module\Quiz\Model\OBJ\Result as OBJ_Result;
    use Module\Quiz\Model\OBJ\Option as OBJ_Option;
    use Module\Quiz\Model\OBJ\Question as OBJ_Question;
    use Module\Quiz\Model\OBJ\Answered as OBJ_Answered;
    use Module\Quiz\Model\Util\Conection;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    /**
     * 
     * @author anderson-alan
     * 
     * Design Pattern: Data Access Object - DAO
     * Answered
     */
    class Answered
    {
        function __construct()
        {
            
        }
        
        /**
         * Inserts a new row on the table Answered.
         * @param OBJ_Answered $obj_answered
         * @return bool
         */
        public static function insert(OBJ_Answered $obj_answered): bool
        {
            try {
                $sql = 'INSERT INTO answered (result_id, option_id, question_id) 
                        VALUES (:rslt_id, :optn_id, :qstn_id);';
                
                $p_sql = Conection::Connect()->prepare($sql);
                
                $p_sql->bindValue(':rslt_id', $obj_answered->getResultId(), PDO::PARAM_INT);
                $p_sql->bindValue(':optn_id', $obj_answered->getOptionId(), PDO::PARAM_INT);
                $p_sql->bindValue(':qstn_id', $obj_answered->getQuestionId(), PDO::PARAM_INT);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Update a existing row on the table Answered.
         * @param OBJ_Answered $obj_answered, int $old_option_id
         * @return bool
         */
        public static function update(OBJ_Answered $obj_answered, int $old_option_id): bool
        {
            try {
                $sql = 'UPDATE answered SET
                        result_id = :rslt_id,
                        option_id = :optn_id,
                        question_id = :qstn_id 
                        WHERE result_id = :rslt_id AND option_id = :old_optn_id';

                $p_sql = Conection::Connect()->prepare($sql);

                $p_sql->bindValue(':rslt_id', $obj_answered->getResultId(), PDO::PARAM_INT);
                $p_sql->bindValue(':optn_id', $obj_answered->getOptionId(), PDO::PARAM_INT);
                $p_sql->bindValue(':qstn_id', $obj_answered->getQuestionId(), PDO::PARAM_INT);
                $p_sql->bindValue(':old_optn_id', $old_option_id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Delete a existing row on the table Answered.
         * @param int $result_id, int $option_id
         * @return bool
         */
        public static function delete(int $result_id, int $option_id): bool
        {
            try {
                $sql = 'DELETE FROM answered WHERE result_id = :rslt_id AND option_id = :optn_id';
                
                $p_sql = Conection::Connect()->prepare($sql);
                
                $p_sql->bindValue(':rslt_id', $result_id, PDO::PARAM_INT);
                $p_sql->bindValue(':optn_id', $option_id, PDO::PARAM_INT);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Returns the row where the id is the same as past at parameter.
         * @param int $result_id
         * @return OBJ_Answered|boolean
         */
        public static function searchByResultIdOptionId(int $result_id, int $option_id)
        {
            try {
                $sql = 'SELECT result_id, option_id, question_id FROM answered WHERE result_id = :rslt_id AND option_id = :optn_id';
                
                $p_sql = Conection::Connect()->prepare($sql);
                
                $p_sql->bindValue(':rslt_id', $result_id, PDO::PARAM_INT);
                $p_sql->bindValue(':optn_id', $option_id, PDO::PARAM_INT);
                
                $p_sql->execute();
                
                return self::fillAnswered($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Returns the rows where the id is the same as past at parameter.
         * @param int $result_id
         * @return array|OBJ_Answered[]|boolean
         */
        public static function searchAllByResultId(int $result_id)
        {
            try {
                $sql = 'SELECT result_id, option_id, question_id FROM answered WHERE result_id = :rslt_id';
                
                $p_sql = Conection::Connect()->prepare($sql);
                $p_sql->bindValue(':rslt_id', $result_id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::fillArrayAnswered($p_sql->fetchAll(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Fill an array with all Answered rows found by search.
         * @param array $rows
         * @return array
         */
        public static function fillArrayAnswered(array $rows): array
        {
            $answereds = [];
            
            foreach ($rows as $row) {
                $obj_answered = new OBJ_Answered();
                
                if (isset($row['result_id'])) {
                    $result = DAO_Result::searchById($row['result_id']);
                    
                    /**
                     * Validates if the new search return error from database.
                     * In case of error, it just sets the Id to the Result.
                     */
                    if ($result instanceof OBJ_Result) {
                        $obj_answered->setResult($result);
                    } else {
                        $obj_answered->setResultId($row['result_id']);
                    }
                }
                
                if (isset($row['option_id'])) {
                    $option = DAO_Option::searchById($row['option_id']);
                    
                    /**
                     * Validates if the new search return error from database.
                     * In case of error, it just sets the Id to the Option.
                     */
                    if ($option instanceof OBJ_Option) {
                        $obj_answered->setOption($option);
                    } else {
                        $obj_answered->setOptionId($row['option_id']);
                    }
                }
                
                if (isset($row['question_id'])) {
                    $question = DAO_Question::searchById($row['question_id']);
                    
                    /**
                     * Validates if the new search return error from database.
                     * In case of error, it just sets the Id to the Question.
                     */
                    if ($question instanceof OBJ_Question) {
                        $obj_answered->setQuestion($question);
                    } else {
                        $obj_answered->setQuestionId($row['question_id']);
                    }
                }
                
                $answereds[] = $obj_answered;
            }
            
            return $answereds;
        }
        
        /**
         * Fill an object with the Answered row found by search.
         * @param array $row
         * @return OBJ_Answered
         */
        public static function fillAnswered(array $row): OBJ_Answered
        {
            $obj_answered = new OBJ_Answered();
            
            if (isset($row['id'])) {
                $obj_answered->setId($row['id']);
            }
            
            if (isset($row['user_name'])) {
                $obj_answered->setUserName($row['user_name']);
            }
            
            if (isset($row['password'])) {
                $obj_answered->setPassword($row['password']);
            }
            
            if (isset($row['create_at'])) {
                $obj_answered->setCreateAt($row['create_at']);
            }
            
            return $obj_answered;
        }
    }
