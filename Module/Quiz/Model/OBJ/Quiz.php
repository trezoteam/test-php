<?php
namespace Module\Quiz\Model\OBJ;
    
    /**
     *
     * @author anderson-alan
     *
     * Object Quiz
     */
    class Quiz
    {
        /**
         * Variable to store the quiz id.
         * @var int $id.
         */
        private $id;
        
        /**
         * Variable to store the quiz name.
         * @var string $name.
         */
        private $name;
        
        /**
         * Variable to store the quiz description.
         * @var string $description.
         */
        private $description;
        
        /**
         * Variable to store the quiz creation date time.
         * @var string $create_at.
         */
        private $create_at;
        
        /**
         * Variable to store the quiz updated date time.
         * @var string $updated_at.
         */
        private $updated_at;
        
        function __constructor() {
            
        }
        
        /**
         * Get quiz id.
         * @return int|NULL
         */
        public function getId(): ?int {
            return $this->id;
        }
        
        /**
         * Set quiz id.
         * @param int $id
         * @return Quiz
         */
        public function setId(int $id): Quiz {
            $this->id = $id;
            
            return $this;
        }
        
        /**
         * Get quiz name.
         * @return string|NULL
         */
        public function getName(): ?string {
            return $this->name;
        }
        
        /**
         * Set quiz name.
         * @param string $name
         * @return Quiz
         */
        public function setName(string $name): Quiz {
            $this->name = $name;
            
            return $this;
        }
        
        /**
         * Get quiz description.
         * @return string|NULL
         */
        public function getDescription(): ?string {
            return $this->description;
        }
        
        /**
         * Set quiz description.
         * @param string $description.
         * @return Quiz
         */
        public function setDescription(string $description): Quiz {
            $this->description = $description;
            
            return $this;
        }
        
        /**
         * Get quiz creation date and time.
         * @return string|NULL
         */
        public function getCreateAt(): ?string {
            return $this->create_at;
        }
        
        /**
         * Set quiz creation date and time.
         * @param string $create_at
         * @return Quiz
         */
        public function setCreateAt(string $create_at): Quiz {
            $this->create_at = $create_at;
            
            return $this;
        }
        
        /**
         * Get quiz updated date and time.
         * @return string|NULL
         */
        public function getUpdatedAt(): ?string {
            return $this->updated_at;
        }
        
        /**
         * Set quiz updated date and time.
         * @param string $updated_at
         * @return Quiz
         */
        public function setUpdatedAt(string $updated_at): Quiz {
            $this->updated_at = $updated_at;
            
            return $this;
        }
    }
