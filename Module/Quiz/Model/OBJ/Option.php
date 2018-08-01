<?php
namespace Module\Quiz\Model\OBJ;
    
    use Module\Quiz\Model\OBJ\Question as OBJ_Question;
    
    /**
     *
     * @author anderson-alan
     *
     * Object Option
     */
    class Option
    {
        /**
         * Variable to store the option id.
         * @var int $id.
         */
        private $id;
        
        /**
         * Variable to store the option question object.
         * @var OBJ_Question $obj_question.
         */
        private $obj_question;
        
        /**
         * Variable to store the option $answer.
         * @var string $answer.
         */
        private $answer;
        
        /**
         * Variable to store the option $is correct.
         * @var boolean $is_correct.
         */
        private $is_correct;
        
        /**
         * Variable to store the option creation date time.
         * @var string $create_at.
         */
        private $create_at;
        
        /**
         * Variable to store the option updated date time.
         * @var string $updated_at.
         */
        private $updated_at;
        
        function __constructor() {
            
        }
        
        /**
         * Get option id.
         * @return int|NULL
         */
        public function getId(): ?int {
            return $this->id;
        }
        
        /**
         * Set option id.
         * @param int $id
         * @return Option
         */
        public function setId(int $id): Option {
            $this->id = $id;
            
            return $this;
        }
        
        /**
         * Get option question id.
         * @return int|NULL
         */
        public function getQuestionId(): ?int {
            if ($this->obj_question instanceof OBJ_Question) {
                return $this->obj_question->getId();
            } else {
                return null;
            }
        }
        
        /**
         * Set option question id.
         * @param int $question_id
         * @return Option
         */
        public function setQuestionId(int $question_id): Option {
            if (!$this->obj_question instanceof OBJ_Question) {
                $this->obj_question = new OBJ_Question();
            }
            
            $this->obj_question->setId($question_id);
            
            return $this;
        }
        
        /**
         * Get option question object.
         * @return OBJ_Question|NULL
         */
        public function getQuestion(): ?OBJ_Question {
            return $this->obj_question;
        }
        
        /**
         * Set option question object.
         * @param OBJ_Question $obj_question
         * @return Option
         */
        public function setQuestion(OBJ_Question $obj_question): Option {
            $this->obj_question = $obj_question;
            
            return $this;
        }
        
        /**
         * Get option answer.
         * @return string|NULL
         */
        public function getAnswer(): ?string {
            return $this->answer;
        }
        
        /**
         * Set option answer.
         * @param string $answer.
         * @return Option
         */
        public function setAnswer(string $answer): Option {
            $this->answer = $answer;
            
            return $this;
        }
        
        /**
         * Get option is correct.
         * @return bool|NULL
         */
        public function getIsCorrect(): ?bool {
            return $this->is_correct;
        }
        
        /**
         * Set option is correct.
         * @param bool $is_correct
         * @return Option
         */
        public function setIsCorrect(bool $is_correct): Option {
            $this->is_correct = $is_correct;
            
            return $this;
        }
        
        /**
         * Get option creation date and time.
         * @return string|NULL
         */
        public function getCreateAt(): ?string {
            return $this->create_at;
        }
        
        /**
         * Set option creation date and time.
         * @param string $create_at
         * @return Option
         */
        public function setCreateAt(string $create_at): Option {
            $this->create_at = $create_at;
            
            return $this;
        }
        
        /**
         * Get option updated date and time.
         * @return string|NULL
         */
        public function getUpdatedAt(): ?string {
            return $this->updated_at;
        }
        
        /**
         * Set option updated date and time.
         * @param string $updated_at
         * @return Option
         */
        public function setUpdatedAt(string $updated_at): Option {
            $this->updated_at = $updated_at;
            
            return $this;
        }
    }
