<?php
namespace Module\Quiz\Model\OBJ;
    
    use Module\Quiz\Model\OBJ\Quiz as OBJ_Quiz;
    use Module\Quiz\Model\OBJ\Type as OBJ_Type;
    
    /**
     *
     * @author anderson-alan
     *
     * Object Question
     */
    class Question
    {
        /**
         * Variable to store the question id.
         * @var int $id.
         */
        private $id;
        
        /**
         * Variable to store the result quiz object.
         * @var OBJ_Quiz $obj_quiz.
         */
        private $obj_quiz;
        
        /**
         * Variable to store the result type object.
         * @var OBJ_Type $obj_type.
         */
        private $obj_type;
        
        /**
         * Variable to store the question subject.
         * @var string $subject.
         */
        private $subject;
        
        /**
         * Variable to store the question creation date time.
         * @var string $create_at.
         */
        private $create_at;
        
        /**
         * Variable to store the question updated date time.
         * @var string $updated_at.
         */
        private $updated_at;
        
        function __constructor() {
            
        }
        
        /**
         * Get question id.
         * @return int|NULL
         */
        public function getId(): ?int {
            return $this->id;
        }
        
        /**
         * Set question id.
         * @param int $id
         * @return Question
         */
        public function setId(int $id): Question {
            $this->id = $id;
            
            return $this;
        }
        
        /**
         * Get result quiz id.
         * @return int|NULL
         */
        public function getQuizId(): ?int {
            if ($this->obj_quiz instanceof OBJ_Quiz) {
                return $this->obj_quiz->getId();
            } else {
                return null;
            }
        }
        
        /**
         * Set result quiz id.
         * @param int $quiz_id
         * @return Question
         */
        public function setQuizId(int $quiz_id): Question {
            if (!$this->obj_quiz instanceof OBJ_Quiz) {
                $this->obj_quiz = new OBJ_Quiz();
            }
            
            $this->obj_quiz->setId($quiz_id);
            
            return $this;
        }
        
        /**
         * Get result quiz object.
         * @return OBJ_Quiz|NULL
         */
        public function getQuiz(): ?OBJ_Quiz {
            return $this->obj_quiz;
        }
        
        /**
         * Set result quiz object.
         * @param OBJ_Quiz $obj_quiz
         * @return Question
         */
        public function setQuiz(OBJ_Quiz $obj_quiz): Question {
            $this->obj_quiz = $obj_quiz;
            
            return $this;
        }
        
        /**
         * Get result type id.
         * @return int|NULL
         */
        public function getTypeId(): ?int {
            if ($this->obj_type instanceof OBJ_Type) {
                return $this->obj_type->getId();
            } else {
                return null;
            }
        }
        
        /**
         * Set result type id.
         * @param int $type_id
         * @return Question
         */
        public function setTypeId(int $type_id): Question {
            if (!$this->obj_type instanceof OBJ_Type) {
                $this->obj_type = new OBJ_Type();
            }
            
            $this->obj_type->setId($type_id);
            
            return $this;
        }
        
        /**
         * Get result type object.
         * @return OBJ_Type|NULL
         */
        public function getType(): ?OBJ_Type {
            return $this->obj_type;
        }
        
        /**
         * Set result type object.
         * @param OBJ_Type $obj_type
         * @return Question
         */
        public function setType(OBJ_Type $obj_type): Question {
            $this->obj_type = $obj_type;
            
            return $this;
        }
        
        /**
         * Get question subject.
         * @return string|NULL
         */
        public function getSubject(): ?string {
            return $this->subject;
        }
        
        /**
         * Set question subject.
         * @param string $subject.
         * @return Question
         */
        public function setSubject(string $subject): Question {
            $this->subject = $subject;
            
            return $this;
        }
        
        /**
         * Get question creation date and time.
         * @return string|NULL
         */
        public function getCreateAt(): ?string {
            return $this->create_at;
        }
        
        /**
         * Set question creation date and time.
         * @param string $create_at
         * @return Question
         */
        public function setCreateAt(string $create_at): Question {
            $this->create_at = $create_at;
            
            return $this;
        }
        
        /**
         * Get question updated date and time.
         * @return string|NULL
         */
        public function getUpdatedAt(): ?string {
            return $this->updated_at;
        }
        
        /**
         * Set question updated date and time.
         * @param string $updated_at
         * @return Question
         */
        public function setUpdatedAt(string $updated_at): Question {
            $this->updated_at = $updated_at;
            
            return $this;
        }
    }
