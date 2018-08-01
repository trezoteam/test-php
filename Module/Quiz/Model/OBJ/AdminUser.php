<?php
namespace Module\Quiz\Model\OBJ;
    
    /**
     * 
     * @author anderson-alan
     *
     * Object AdminUser
     * For now its a static table in DB.
     */
    class AdminUser
    {
        /**
         * Variable to store the administrator user id.
         * @var int $id.
         */
        private $id;
        
        /**
         * Variable to store the administrator user name.
         * @var string $user_name.
         */
        private $user_name;
        
        /**
         * Variable to store the administrator user password.
         * @var string $password.
         */
        private $password;
        
        /**
         * Variable to store the administrator user creation date time.
         * @var string $create_at.
         */
        private $create_at;
        
        function __constructor() {
            
        }
        
        /**
         * Get user id.
         * @return int|NULL
         */
        public function getId(): ?int {
            return $this->id;
        }
        
        /**
         * Set user id.
         * @param int $id
         * @return AdminUser
         */
        public function setId(int $id): AdminUser {
            $this->id = $id;
            
            return $this;
        }
        
        /**
         * Get user name.
         * @return string|NULL
         */
        public function getUserName(): ?string {
            return $this->user_name;
        }
        
        /**
         * Set user name.
         * @param string $user_name
         * @return AdminUser
         */
        public function setUserName(string $user_name): AdminUser {
            $this->user_name = $user_name;
            
            return $this;
        }
        
        /**
         * Get user password.
         * @return string|NULL
         */
        public function getPassword(): ?string {
            return $this->password;
        }
        
        /**
         * Set user password.
         * @param string $password
         * @return AdminUser
         */
        public function setPassword(string $password): AdminUser {
            $this->password = $password;
            
            return $this;
        }
        
        /**
         * Get user creation date and time.
         * @return string|NULL
         */
        public function getCreateAt(): ?string {
            return $this->create_at;
        }
        
        /**
         * Set user creation date and time.
         * @param string $create_at
         * @return AdminUser
         */
        public function setCreateAt(string $create_at): AdminUser {
            $this->create_at = $create_at;
            
            return $this;
        }
    }
