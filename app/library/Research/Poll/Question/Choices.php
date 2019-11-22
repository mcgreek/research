<?php

namespace App\Research\Poll\Question;

abstract class Choices {
    
    /**
     *
     * @var type int Question Id
     */
    private $questionId;

    public function __construct(int $questionId)
    {
        $this->questionId = $questionId;
    }
    
    public function getQuestionId()
    {
        return $this->questionId;
    }
    
    abstract function toString();
}