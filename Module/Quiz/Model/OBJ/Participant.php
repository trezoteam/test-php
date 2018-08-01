<?php
namespace Module\Quiz\Model\OBJ;
    
    /**
     *
     * @author anderson-alan
     *
     * Object Participant
     */
    class Participant
    {
        /**
         * Variable to store the participant id.
         * @var int $id.
         */
        private $id;
        
        /**
         * Variable to store the participant name.
         * @var string $name.
         */
        private $name;
        
        /**
         * Variable to store the participant email.
         * @var string $email.
         */
        private $email;
        
        /**
         * Variable to store the participant creation date time.
         * @var string $create_at.
         */
        private $create_at;
        
        function __constructor() {
            
        }
        
        /**
         * Get participant id.
         * @return int|NULL
         */
        public function getId(): ?int {
            return $this->id;
        }
        
        /**
         * Set participant id.
         * @param int $id
         * @return Participant
         */
        public function setId(int $id): Participant {
            $this->id = $id;
            
            return $this;
        }
        
        /**
         * Get participant name.
         * @return string|NULL
         */
        public function getName(): ?string {
            return $this->name;
        }
        
        /**
         * Set participant name.
         * @param string $name
         * @return Participant
         */
        public function setName(string $name): Participant {
            $this->name = $name;
            
            return $this;
        }
        
        /**
         * Get participant email.
         * @return string|NULL
         */
        public function getEmail(): ?string {
            return $this->email;
        }
        
        /**
         * Set participant email.
         * @param string $email.
         * @return Participant
         */
        public function setEmail(string $email): Participant {
            $this->email = $email;
            
            return $this;
        }
        
        /**
         * Get participant creation date and time.
         * @return string|NULL
         */
        public function getCreateAt(): ?string {
            return $this->create_at;
        }
        
        /**
         * Set participant creation date and time.
         * @param string $create_at
         * @return Participant
         */
        public function setCreateAt(string $create_at): Participant {
            $this->create_at = $create_at;
            
            return $this;
        }
    }