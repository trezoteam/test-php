<?php
namespace Module\Quiz\Model\DAO;
    
    use Module\Quiz\Model\OBJ\Quiz as OBJ_Quiz;
    use Module\Quiz\Model\Util\Conection;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    /**
     * 
     * @author anderson-alan
     * 
     * Design Pattern: Data Access Object - DAO
     * Quiz
     */
    class Quiz
    {
        function __construct()
        {
            
        }
        
        /**
         * Inserts a new row on the table Quiz.
         * @param OBJ_Quiz $obj_quiz
         * @return bool
         */
        public static function insert(OBJ_Quiz $obj_quiz): bool
        {
            try {
                $sql = 'INSERT INTO quiz (id, name, description, create_at, updated_at) 
                        VALUES (:id, :name, :desc, :crt_at, :upd_at);';
                
                $p_sql = Conection::Connect()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_quiz->getId(), PDO::PARAM_INT);
                $p_sql->bindValue(':name', $obj_quiz->getName(), PDO::PARAM_STR);
                $p_sql->bindValue(':desc', $obj_quiz->getDescription(), PDO::PARAM_STR);
                $p_sql->bindValue(':crt_at', $obj_quiz->getCreateAt(), PDO::PARAM_STR);
                $p_sql->bindValue(':upd_at', $obj_quiz->getUpdatedAt(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Update a existing row on the table Quiz.
         * @param OBJ_Quiz $obj_quiz
         * @return bool
         */
        public static function update(OBJ_Quiz $obj_quiz): bool
        {
            try {
                $sql = 'UPDATE quiz SET
                        id = :id,
                        name = :name,
                        description = :desc,
                        create_at = :crt_at,
                        updated_at = :upd_at 
                        WHERE id = :id';

                $p_sql = Conection::Connect()->prepare($sql);

                $p_sql->bindValue(':id', $obj_quiz->getId(), PDO::PARAM_INT);
                $p_sql->bindValue(':name', $obj_quiz->getName(), PDO::PARAM_STR);
                $p_sql->bindValue(':desc', $obj_quiz->getDescription(), PDO::PARAM_STR);
                $p_sql->bindValue(':crt_at', $obj_quiz->getCreateAt(), PDO::PARAM_STR);
                $p_sql->bindValue(':upd_at', $obj_quiz->getUpdatedAt(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Delete a existing row on the table Quiz.
         * @param int $id
         * @return bool
         */
        public static function delete(int $id): bool
        {
            try {
                $sql = 'DELETE FROM quiz WHERE id = :id';
                
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
         * @return OBJ_Quiz|boolean
         */
        public static function searchById(int $id)
        {
            try {
                $sql = 'SELECT id, name, description, create_at, updated_at FROM quiz WHERE id = :id';
                
                $p_sql = Conection::Connect()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::fillQuiz($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Fill an array with all Quiz rows found by search.
         * @param array $rows
         * @return array
         */
        public static function fillArrayQuiz(array $rows): array
        {
            $quizzes = [];
            
            foreach ($rows as $row) {
                $obj_quiz = new OBJ_Quiz();
                
                if (isset($row['id'])) {
                    $obj_quiz->setId($row['id']);
                }
                
                if (isset($row['name'])) {
                    $obj_quiz->setName($row['name']);
                }
                
                if (isset($row['description'])) {
                    $obj_quiz->setDescription($row['description']);
                }
                
                if (isset($row['create_at'])) {
                    $obj_quiz->setCreateAt($row['create_at']);
                }
                
                if (isset($row['updated_at'])) {
                    $obj_quiz->setUpdatedAt($row['updated_at']);
                }
                
                $quizzes[] = $obj_quiz;
            }
            
            return $quizzes;
        }
        
        /**
         * Fill an object with the Quiz row found by search.
         * @param array $row
         * @return OBJ_Quiz
         */
        public static function fillQuiz(array $row): OBJ_Quiz
        {
            $obj_quiz = new OBJ_Quiz();
            
            if (isset($row['id'])) {
                $obj_quiz->setId($row['id']);
            }
            
            if (isset($row['name'])) {
                $obj_quiz->setName($row['name']);
            }
            
            if (isset($row['description'])) {
                $obj_quiz->setDescription($row['description']);
            }
            
            if (isset($row['create_at'])) {
                $obj_quiz->setCreateAt($row['create_at']);
            }
            
            if (isset($row['updated_at'])) {
                $obj_quiz->setUpdatedAt($row['updated_at']);
            }
            
            return $obj_quiz;
        }
    }
