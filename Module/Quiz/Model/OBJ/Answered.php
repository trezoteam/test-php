<?php
namespace Module\Quiz\Model\OBJ;
    
    use Module\Quiz\Model\OBJ\Result as OBJ_Result;
    use Module\Quiz\Model\OBJ\Option as OBJ_Option;
    use Module\Quiz\Model\OBJ\Question as OBJ_Question;
    
    /**
     *
     * @author anderson-alan
     *
     * Object Answered
     */
    class Answered
    {
        /**
         * Variable to store the answered result object.
         * @var OBJ_Result $obj_result.
         */
        private $obj_result;
        
        /**
         * Variable to store the answered $option object.
         * @var OBJ_Option $obj_option.
         */
        private $obj_option;
        
        /**
         * OBJ_Question must be added to now if this question was answered or not.
         * If we just use the option to now the answer, then the result will show as an error if the model 
         * don't find the right answer in the list.
         * 
         * Variable to store the answered question object.
         * @var OBJ_Question $obj_question.
         */
        private $obj_question;
        
        function __constructor() {
            
        }
        
        /**
         * Get answered result id.
         * @return int|NULL
         */
        public function getResultId(): ?int {
            if ($this->obj_result instanceof OBJ_Result) {
                return $this->obj_result->getId();
            } else {
                return null;
            }
        }
        
        /**
         * Set answered result id.
         * @param int $result_id
         * @return Answered
         */
        public function setResultId(int $result_id): Answered {
            if (!$this->obj_result instanceof OBJ_Result) {
                $this->obj_result = new OBJ_Result();
            }
            
            $this->obj_result->setId($result_id);
            
            return $this;
        }
        
        /**
         * Get answered result object.
         * @return OBJ_Result|NULL
         */
        public function getResult(): ?OBJ_Result {
            return $this->obj_result;
        }
        
        /**
         * Set answered result object.
         * @param OBJ_Result $obj_result
         * @return Answered
         */
        public function setResult(OBJ_Result $obj_result): Answered {
            $this->obj_result = $obj_result;
            
            return $this;
        }
        
        /**
         * Get answered option id.
         * @return int|NULL
         */
        public function getOptionId(): ?int {
            if ($this->obj_option instanceof OBJ_Option) {
                return $this->obj_option->getId();
            } else {
                return null;
            }
        }
        
        /**
         * Set answered option id.
         * @param int $option_id
         * @return Answered
         */
        public function setOptionId(int $option_id): Answered {
            if (!$this->obj_option instanceof OBJ_Option) {
                $this->obj_option = new OBJ_Option();
            }
            
            $this->obj_option->setId($option_id);
            
            return $this;
        }
        
        /**
         * Get answered option object.
         * @return OBJ_Option|NULL
         */
        public function getOption(): ?OBJ_Option {
            return $this->obj_option;
        }
        
        /**
         * Set answered option object.
         * @param OBJ_Option $obj_option
         * @return Answered
         */
        public function setOption(OBJ_Option $obj_option): Answered {
            $this->obj_option = $obj_option;
            
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
         * @return OBJ_Option
         */
        public function setQuestionId(int $question_id): OBJ_Option {
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
         * @return OBJ_Option
         */
        public function setQuestion(OBJ_Question $obj_question): OBJ_Option {
            $this->obj_question = $obj_question;
            
            return $this;
        }
    }
