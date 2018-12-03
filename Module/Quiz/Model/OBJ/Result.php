<?php
namespace Module\Quiz\Model\OBJ;
    
    use Module\Quiz\Model\OBJ\Participant as OBJ_Participant;
    use Module\Quiz\Model\OBJ\Quiz as OBJ_Quiz;
    
    /**
     *
     * @author anderson-alan
     *
     * Object Result
     */
    class Result
    {
        /**
         * Variable to store the result id.
         * @var int $id.
         */
        private $id;
        
        /**
         * Variable to store the result participant object.
         * @var OBJ_Participant $obj_participant.
         */
        private $obj_participant;
        
        /**
         * Variable to store the result quiz object.
         * @var OBJ_Quiz $obj_quiz.
         */
        private $obj_quiz;
        
        /**
         * Variable to store the result start date time.
         * @var string $started_at.
         */
        private $started_at;
        
        /**
         * Variable to store the result finish date time.
         * @var string $finished_at.
         */
        private $finished_at;
        
        function __constructor() {
            
        }
        
        /**
         * Get result id.
         * @return int|NULL
         */
        public function getId(): ?int {
            return $this->id;
        }
        
        /**
         * Set result id.
         * @param int $id
         * @return Result
         */
        public function setId(int $id): Result {
            $this->id = $id;
            
            return $this;
        }
        
        /**
         * Get result participant id.
         * @return int|NULL
         */
        public function getParticipantId(): ?int {
            if ($this->obj_participant instanceof OBJ_Participant) {
                return $this->obj_participant->getId();
            } else {
                return null;
            }
        }
        
        /**
         * Set result participant id.
         * @param int $participant_id
         * @return Result
         */
        public function setParticipantId(int $participant_id): Result {
            if (!$this->obj_participant instanceof OBJ_Participant) {
                $this->obj_participant = new OBJ_Participant();
            }
            
            $this->obj_participant->setId($participant_id);
            
            return $this;
        }
        
        /**
         * Get result participant object.
         * @return OBJ_Participant|NULL
         */
        public function getParticipant(): ?OBJ_Participant {
            return $this->obj_participant;
        }
        
        /**
         * Set result participant object.
         * @param OBJ_Participant $obj_participant
         * @return Result
         */
        public function setParticipant ($obj_participant): Result {
            $this->obj_participant = $obj_participant;
            
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
         * @return Result
         */
        public function setQuizId(int $quiz_id): Result {
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
         * @return Result
         */
        public function setQuiz(OBJ_Quiz $obj_quiz): Result {
            $this->obj_quiz = $obj_quiz;
            
            return $this;
        }
        
        /**
         * Get result started date and time.
         * @return string|NULL
         */
        public function getStartedAt(): ?string {
            return $this->started_at;
        }
        
        /**
         * Set result started date and time.
         * @param string $started_at
         * @return Result
         */
        public function setStartedAt(string $started_at): Result {
            $this->started_at = $started_at;
            
            return $this;
        }
        
        /**
         * Get result finished date and time.
         * @return string|NULL
         */
        public function getFinishedAt(): ?string {
            return $this->finished_at;
        }
        
        /**
         * Set result finished date and time.
         * @param string $finished_at
         * @return Result
         */
        public function setFinishedAt(string $finished_at): Result {
            $this->finished_at = $finished_at;
            
            return $this;
        }
    }
