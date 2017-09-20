<?php

namespace Application\Entidade;

/**
 * QuestionOption
 */
class QuestionOption
{
    /**
     * @var string
     */
    private $answer;

    /**
     * @var integer
     */
    private $isCorrect;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Application\Entidade\Question
     */
    private $question;


    /**
     * Set answer
     *
     * @param string $answer
     *
     * @return QuestionOption
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set isCorrect
     *
     * @param integer $isCorrect
     *
     * @return QuestionOption
     */
    public function setIsCorrect($isCorrect)
    {
        $this->isCorrect = $isCorrect;

        return $this;
    }

    /**
     * Get isCorrect
     *
     * @return integer
     */
    public function getIsCorrect()
    {
        return $this->isCorrect;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return QuestionOption
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return QuestionOption
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set question
     *
     * @param \Application\Entidade\Question $question
     *
     * @return QuestionOption
     */
    public function setQuestion(\Application\Entidade\Question $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \Application\Entidade\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }
}

