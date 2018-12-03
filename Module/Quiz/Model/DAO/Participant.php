<?php
namespace Module\Quiz\Model\DAO;
    
    use Module\Quiz\Model\OBJ\Participant as OBJ_Participant;
    use Module\Quiz\Model\Util\Conection;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    /**
     * 
     * @author anderson-alan
     * 
     * Design Pattern: Data Access Object - DAO
     * Participant
     */
    class Participant
    {
        function __construct()
        {
            
        }
        
        /**
         * Inserts a new row on the table Participant.
         * @param OBJ_Participant $obj_participant
         * @return bool
         */
        public static function insert(OBJ_Participant $obj_participant): bool
        {
            try {
                $sql = 'INSERT INTO participant (id, name, email, create_at) 
                        VALUES (:id, :name, :email, :crt_at);';
                
                $p_sql = Conection::Connect()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_participant->getId(), PDO::PARAM_INT);
                $p_sql->bindValue(':name', $obj_participant->getName(), PDO::PARAM_STR);
                $p_sql->bindValue(':email', $obj_participant->getEmail(), PDO::PARAM_STR);
                $p_sql->bindValue(':crt_at', $obj_participant->getCreateAt(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Update a existing row on the table Participant.
         * @param OBJ_Participant $obj_participant
         * @return bool
         */
        public static function update(OBJ_Participant $obj_participant): bool
        {
            try {
                $sql = 'UPDATE participant SET
                        id = :id,
                        name = :name,
                        email = :email,
                        create_at = :crt_at 
                        WHERE id = :id';

                $p_sql = Conection::Connect()->prepare($sql);

                $p_sql->bindValue(':id', $obj_participant->getId(), PDO::PARAM_INT);
                $p_sql->bindValue(':name', $obj_participant->getName(), PDO::PARAM_STR);
                $p_sql->bindValue(':email', $obj_participant->getEmail(), PDO::PARAM_STR);
                $p_sql->bindValue(':crt_at', $obj_participant->getCreateAt(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Delete a existing row on the table Participant.
         * @param int $id
         * @return bool
         */
        public static function delete(int $id): bool
        {
            try {
                $sql = 'DELETE FROM participant WHERE id = :id';
                
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
         * @return OBJ_Participant|boolean
         */
        public static function searchById(int $id)
        {
            try {
                $sql = 'SELECT id, name, email, create_at FROM participant WHERE id = :id';
                
                $p_sql = Conection::Connect()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::fillParticipant($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Fill an array with all Participant rows found by search.
         * @param array $rows
         * @return array
         */
        public static function fillArrayParticipant(array $rows): array
        {
            $participants = [];
            
            foreach ($rows as $row) {
                $obj_participant = new OBJ_Participant();
                
                if (isset($row['id'])) {
                    $obj_participant->setId($row['id']);
                }
                
                if (isset($row['name'])) {
                    $obj_participant->setName($row['name']);
                }
                
                if (isset($row['email'])) {
                    $obj_participant->setEmail($row['email']);
                }
                
                if (isset($row['create_at'])) {
                    $obj_participant->setCreateAt($row['create_at']);
                }
                
                $participants[] = $obj_participant;
            }
            
            return $participants;
        }
        
        /**
         * Fill an object with the Participant row found by search.
         * @param array $row
         * @return OBJ_Participant
         */
        public static function fillParticipant(array $row): OBJ_Participant
        {
            $obj_participant = new OBJ_Participant();
            
            if (isset($row['id'])) {
                $obj_participant->setId($row['id']);
            }
            
            if (isset($row['name'])) {
                $obj_participant->setName($row['name']);
            }
            
            if (isset($row['email'])) {
                $obj_participant->setEmail($row['email']);
            }
            
            if (isset($row['create_at'])) {
                $obj_participant->setCreateAt($row['create_at']);
            }
            
            return $obj_participant;
        }
    }
