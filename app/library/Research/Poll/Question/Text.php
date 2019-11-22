<?php

namespace App\Research\Poll\Question;

use App\Choice;
use App\Research\Poll\Question\Choices;

class Text extends Choices {
    public function __construct(int $questionId)
    {
        parent::__construct($questionId);
    }
    
    public function toString() 
    {
        $choices = new Choice();
        
        $result = $choices->where('question_id', $this->getQuestionId())
                        ->orderBy('choice_order_number', 'asc')
                        ->get()->first();
        
        return view('poll.question.text', ['choice_data' => $result])->render();
        
        /**
            $view = View::make('my_view', ['name' => 'Rishabh']);
            $contents = (string) $view;
            // or
            $contents = $view->render();
         */
    }
}