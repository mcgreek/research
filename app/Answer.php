<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	protected $fillable = [
		'participant_poll_id', 'question_id', 'answer'
	];
}
