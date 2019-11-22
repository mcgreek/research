<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParticipantPoll extends Model
{
	protected $fillable = [
		'poll_id', 'participant_id', 'completed'
	];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }
}
