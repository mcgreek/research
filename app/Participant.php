<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = ['email'];

    public function participantPoll()
    {
        return $this->hasMany(ParticipantPoll::class);
    }

    /**
     * Get participant polls
     * 
     * @return [type] [description]
     */
    public function polls()
    {
        return $this->participantPoll()->with('poll');
    }
}
