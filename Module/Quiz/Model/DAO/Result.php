<?php
namespace Module\Quiz\Model\DAO;
    
    use Module\Quiz\Model\DAO\Participant as DAO_Participant;
    use Module\Quiz\Model\DAO\Quiz as DAO_Quiz;
    use Module\Quiz\Model\OBJ\Participant as OBJ_Participant;
    use Module\Quiz\Model\OBJ\Quiz as OBJ_Quiz;
    use Module\Quiz\Model\OBJ\Result as OBJ_Result;
    use Module\Quiz\Model\Util\Conection;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    /**
     * 
     * @author anderson-alan
     * 
     * Design Pattern: Data Access Object - DAO
     * Result
     */
    class Result
    {
        function __construct()
        {
            
        }
        
        /**
         * Inserts a new row on the table Result.
         * @param OBJ_Result $obj_result
         * @return bool
         */
        public static function insert(OBJ_Result $obj_result): bool
        {
            try {
                $sql = 'INSERT INTO result (id, participant_id, quiz_id, started_at, finished_at) 
                        VALUES (:id, :part_id, :quiz_id, :strt, :fnsh);';
                
                $p_sql = Conection::Connect()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_result->getId(), PDO::PARAM_INT);
                $p_sql->bindValue(':part_id', $obj_result->getParticipantId(), PDO::PARAM_INT);
                $p_sql->bindValue(':quiz_id', $obj_result->getQuizId(), PDO::PARAM_INT);
                $p_sql->bindValue(':strt', $obj_result->getStartedAt(), PDO::PARAM_STR);
                $p_sql->bindValue(':fnsh', $obj_result->getFinishedAt(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Update a existing row on the table Result.
         * @param OBJ_Result $obj_result
         * @return bool
         */
        public static function update(OBJ_Result $obj_result): bool
        {
            try {
                $sql = 'UPDATE result SET
                        id = :id,
                        participant_id = :part_id,
                        quiz_id = :quiz_id,
                        started_at = :strt,
                        finished_at = :fnsh 
                        WHERE id = :id';
                
                $p_sql = Conection::Connect()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_result->getId(), PDO::PARAM_INT);
                $p_sql->bindValue(':part_id', $obj_result->getParticipantId(), PDO::PARAM_INT);
                $p_sql->bindValue(':quiz_id', $obj_result->getQuizId(), PDO::PARAM_INT);
                $p_sql->bindValue(':strt', $obj_result->getStartedAt(), PDO::PARAM_STR);
                $p_sql->bindValue(':fnsh', $obj_result->getFinishedAt(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Delete a existing row on the table Result.
         * @param int $id
         * @return bool
         */
        public static function delete(int $id): bool
        {
            try {
                $sql = 'DELETE FROM result WHERE id = :id';
                
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
         * @return OBJ_Result|boolean
         */
        public static function searchById(int $id)
        {
            try {
                $sql = 'SELECT id, participant_id, quiz_id, started_at, finished_at FROM result WHERE id = :id';
                
                $p_sql = Conection::Connect()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::fillResult($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Fill an array with all Result rows found by search.
         * @param array $rows
         * @return array
         */
        public static function fillArrayResult(array $rows): array
        {
            $results = [];
            
            foreach ($rows as $row) {
                $obj_result = new OBJ_Result();
                
                if (isset($row['id'])) {
                    $obj_result->setId($row['id']);
                }
                
                if (isset($row['participant_id'])) {
                    $participant = DAO_Participant::searchById($row['participant_id']);
                    
                    /**
                     * Validates if the new search return error from database.
                     * In case of error, it just sets the Id to the Participant.
                     */
                    if ($participant instanceof OBJ_Participant) {
                        $obj_result->setParticipant($participant);
                    } else {
                        $obj_result->setParticipantId($row['participant_id']);
                    }
                }
                
                if (isset($row['quiz_id'])) {
                    $quiz = DAO_Quiz::searchById($row['quiz_id']);
                    
                    /**
                     * Validates if the new search return error from database.
                     * In case of error, it just sets the Id to the Quiz.
                     */
                    if ($quiz instanceof OBJ_Quiz) {
                        $obj_result->setQuiz($participant);
                    } else {
                        $obj_result->setQuizId($row['quiz_id']);
                    }
                }
                
                if (isset($row['started_at'])) {
                    $obj_result->setStartedAt($row['started_at']);
                }
                
                if (isset($row['finished_at'])) {
                    $obj_result->setFinishedAt($row['finished_at']);
                }
                
                $results[] = $obj_result;
            }
            
            return $results;
        }
        
        /**
         * Fill an object with the Result row found by search.
         * @param array $row
         * @return OBJ_Result
         */
        public static function fillResult(array $row): OBJ_Result
        {
            $obj_result = new OBJ_Result();
            
            if (isset($row['id'])) {
                $obj_result->setId($row['id']);
            }
            
            if (isset($row['participant_id'])) {
                $participant = DAO_Participant::searchById($row['participant_id']);
                
                /**
                 * Validates if the new search return error from database.
                 * In case of error, it just sets the Id to the Participant.
                 */
                if ($participant instanceof OBJ_Participant) {
                    $obj_result->setParticipant($participant);
                } else {
                    $obj_result->setParticipantId($row['participant_id']);
                }
            }
            
            if (isset($row['quiz_id'])) {
                $quiz = DAO_Quiz::searchById($row['quiz_id']);
                
                /**
                 * Validates if the new search return error from database.
                 * In case of error, it just sets the Id to the Quiz.
                 */
                if ($quiz instanceof OBJ_Quiz) {
                    $obj_result->setQuiz($quiz);
                } else {
                    $obj_result->setQuizId($row['quiz_id']);
                }
            }
            
            if (isset($row['started_at'])) {
                $obj_result->setStartedAt($row['started_at']);
            }
            
            if (isset($row['finished_at'])) {
                $obj_result->setFinishedAt($row['finished_at']);
            }
            
            return $obj_result;
        }
    }
