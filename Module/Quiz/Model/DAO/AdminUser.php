<?php
namespace Module\Quiz\Model\DAO;
    
    use Module\Quiz\Model\OBJ\AdminUser as OBJ_AdminUser;
    use Module\Quiz\Model\Util\Conection;
    use \PDO;
    use \PDOException;
    use \Exception;
    
    /**
     * 
     * @author anderson-alan
     * 
     * Design Pattern: Data Access Object - DAO
     * AdminUser
     */
    class AdminUser
    {
        function __construct()
        {
            
        }
        
        /**
         * Inserts a new row on the table AdminUser.
         * @param OBJ_AdminUser $obj_adminuser
         * @return bool
         */
        public static function insert(OBJ_AdminUser $obj_adminuser): bool
        {
            try {
                $sql = 'INSERT INTO admin_user (id, user_name, password, create_at) 
                        VALUES (:id, :name, :pass, :crt_at);';
                
                $p_sql = Conection::Connect()->prepare($sql);
                
                $p_sql->bindValue(':id', $obj_adminuser->getId(), PDO::PARAM_INT);
                $p_sql->bindValue(':name', $obj_adminuser->getUserName(), PDO::PARAM_STR);
                $p_sql->bindValue(':pass', $obj_adminuser->getPassword(), PDO::PARAM_STR);
                $p_sql->bindValue(':crt_at', $obj_adminuser->getCreateAt(), PDO::PARAM_STR);
                
                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Update a existing row on the table AdminUser.
         * @param OBJ_AdminUser $obj_adminuser
         * @return bool
         */
        public static function update(OBJ_AdminUser $obj_adminuser): bool
        {
            try {
                $sql = 'UPDATE admin_user SET
                        id = :id,
                        user_name = :name,
                        password = :pass,
                        create_at = :crt_at 
                        WHERE id = :id';

                $p_sql = Conection::Connect()->prepare($sql);

                $p_sql->bindValue(':id', $obj_adminuser->getId(), PDO::PARAM_INT);
                $p_sql->bindValue(':name', $obj_adminuser->getUserName(), PDO::PARAM_STR);
                $p_sql->bindValue(':pass', $obj_adminuser->getPassword(), PDO::PARAM_STR);
                $p_sql->bindValue(':crt_at', $obj_adminuser->getCreateAt(), PDO::PARAM_STR);

                return $p_sql->execute();
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Delete a existing row on the table AdminUser.
         * @param int $id
         * @return bool
         */
        public static function delete(int $id): bool
        {
            try {
                $sql = 'DELETE FROM admin_user WHERE id = :id';
                
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
         * @return OBJ_AdminUser|boolean
         */
        public static function searchById(int $id)
        {
            try {
                $sql = 'SELECT id, user_name, password, create_at FROM admin_user WHERE id = :id';
                
                $p_sql = Conection::Connect()->prepare($sql);
                $p_sql->bindValue(':id', $id, PDO::PARAM_INT);
                $p_sql->execute();
                
                return self::fillAdminUser($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Returns the row where the user name is the same as past at parameter.
         * @param string $user_name
         * @return OBJ_AdminUser|boolean
         */
        public static function searchByUserName(string $user_name)
        {
            /**
             * The user name on DB is Unique, ther can't be more than one.
             */
            try {
                $sql = 'SELECT id, user_name, password, create_at FROM admin_user WHERE user_name = :name';
                
                $p_sql = Conection::Connect()->prepare($sql);
                $p_sql->bindValue(':name', $user_name, PDO::PARAM_STR);
                $p_sql->execute();
                
                return self::fillAdminUser($p_sql->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException | Exception $e) {
                return false;
            }
        }
        
        /**
         * Fill an array with all AdminUser rows found by search.
         * @param array $rows
         * @return array
         */
        public static function fillArrayAdminUser(array $rows): array
        {
            $admin_users = [];
            
            foreach ($rows as $row) {
                $obj_adminuser = new OBJ_AdminUser();
                
                if (isset($row['id'])) {
                    $obj_adminuser->setId($row['id']);
                }
                
                if (isset($row['user_name'])) {
                    $obj_adminuser->setUserName($row['user_name']);
                }
                
                if (isset($row['password'])) {
                    $obj_adminuser->setPassword($row['password']);
                }
                
                if (isset($row['create_at'])) {
                    $obj_adminuser->setCreateAt($row['create_at']);
                }
                
                $admin_users[] = $obj_adminuser;
            }
            
            return $admin_users;
        }
        
        /**
         * Fill an object with the AdminUser row found by search.
         * @param array $row
         * @return OBJ_AdminUser
         */
        public static function fillAdminUser(array $row): OBJ_AdminUser
        {
            $obj_adminuser = new OBJ_AdminUser();
            
            if (isset($row['id'])) {
                $obj_adminuser->setId($row['id']);
            }
            
            if (isset($row['user_name'])) {
                $obj_adminuser->setUserName($row['user_name']);
            }
            
            if (isset($row['password'])) {
                $obj_adminuser->setPassword($row['password']);
            }
            
            if (isset($row['create_at'])) {
                $obj_adminuser->setCreateAt($row['create_at']);
            }
            
            return $obj_adminuser;
        }
    }
