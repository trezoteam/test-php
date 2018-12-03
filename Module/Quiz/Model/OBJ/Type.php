<?php
namespace Module\Quiz\Model\OBJ;
    
    /**
     *
     * @author anderson-alan
     *
     * Object Type of question: bool or multi
     */
    class Type
    {
        /**
         * Variable to store the type id.
         * @var int $id.
         */
        private $id;
        
        /**
         * Variable to store the type description.
         * @var string $description.
         */
        private $description;
        
        function __constructor() {
            
        }
        
        /**
         * Get type id.
         * @return int|NULL
         */
        public function getId(): ?int {
            return $this->id;
        }
        
        /**
         * Set type id.
         * @param int $id
         * @return Type
         */
        public function setId(int $id): Type {
            $this->id = $id;
            
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
         * Set type description.
         * @param string $description.
         * @return Type
         */
        public function setDescription(string $description): Type {
            $this->description = $description;
            
            return $this;
        }
    }
