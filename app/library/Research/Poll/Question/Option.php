<?php

namespace App\Research\Poll\Question;

use App\Choice;
use App\Research\Poll\Question\Choices;

class Option extends Choices {

    public function __construct(int $questionId)
    {
        parent::__construct($questionId);
    }
    
    public function toString() 
    {
        $choices = new Choice();
        
        $results = $choices->where('question_id', $this->getQuestionId())
                        ->orderBy('choice_order_number', 'asc')
                        ->get();
        
        return view('poll.question.option', ['choice_data' => $results])->render();
        
        /**
            $view = View::make('my_view', ['name' => 'Rishabh']);
            $contents = (string) $view;
            // or
            $contents = $view->render();
         */
    }
}