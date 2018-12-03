<?php
namespace Module\Quiz\Model\DAO;
    
    use Module\Quiz\Model\OBJ\Type as OBJ_Type;
    use Module\Quiz\Model\Util\Conection;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    /**
     * 
     * @author anderson-alan
     * 
     * Design Pattern: Data Access Object - DAO
     * Type
     */
    class Type
    {
        function __construct()
        {
            
        }
        
        /**
         * Inserts a new row on the table Type.
         * @param OBJ_Type $obj_type
         * @return bool
         */
        public static function insert(OBJ_Type $obj_type): bool
        {
            try {
                $sql = 'INSERT INTO type (id, description) 
                        VALUES (:id, :desc);';
                
                $p_sql = Conection::Connect()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_type->getId(), PDO::PARAM_INT);
                $p_sql->bindValue(':desc', $obj_type->getDescription(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Update a existing row on the table Type.
         * @param OBJ_Type $obj_type
         * @return bool
         */
        public static function update(OBJ_Type $obj_type): bool
        {
            try {
                $sql = 'UPDATE type SET
                        id = :id,
                        description = :desc 
                        WHERE id = :id';

                $p_sql = Conection::Connect()->prepare($sql);

                $p_sql->bindValue(':id', $obj_type->getId(), PDO::PARAM_INT);
                $p_sql->bindValue(':desc', $obj_type->getDescription(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Delete a existing row on the table Type.
         * @param int $id
         * @return bool
         */
        public static function delete(int $id): bool
        {
            try {
                $sql = 'DELETE FROM type WHERE id = :id';
                
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
         * @return OBJ_Type|boolean
         */
        public static function searchById(int $id)
        {
            try {
                $sql = 'SELECT id, description FROM type WHERE id = :id';
                
                $p_sql = Conection::Connect()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::fillType($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Fill an array with all Type rows found by search.
         * @param array $rows
         * @return array
         */
        public static function fillArrayType(array $rows): array
        {
            $types = [];
            
            foreach ($rows as $row) {
                $obj_type = new OBJ_Type();
                
                if (isset($row['id'])) {
                    $obj_type->setId($row['id']);
                }
                
                if (isset($row['description'])) {
                    $obj_type->setDescription($row['description']);
                }
                
                $types[] = $obj_type;
            }
            
            return $types;
        }
        
        /**
         * Fill an object with the Type row found by search.
         * @param array $row
         * @return OBJ_Type
         */
        public static function fillType(array $row): OBJ_Type
        {
            $obj_type = new OBJ_Type();
            
            if (isset($row['id'])) {
                $obj_type->setId($row['id']);
            }
            
            if (isset($row['description'])) {
                $obj_type->setDescription($row['description']);
            }
            
            return $obj_type;
        }
    }
