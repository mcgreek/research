<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Participant;

class Poll extends Model
{
	protected $fillable = [
		'research_id', 'token', 'is_anonymus', 'allow_sharing', 'parent_poll_id'
	];
    /**
     * Generate and return poll access token
     * 
     * @return string
     */
    public static function generateToken()
    {
        return md5(uniqid(rand(), true));
    }

    /**
     * Create user based on poll settings
     * 
     * @param Request $request
     * @return Participant|null
     */
    public function setUpParticipant(Request $request)
    {
        $participant = null;

        if ($this->is_anonymus) {
            // generate user
            $participant = Participant::create([
                'email' => md5(uniqid(rand(), true)) . "@localhost.local"
            ]);

            if (!$participant) {
                return null;
            }
        } else if ($request->isMethod('post')) {
            $form = request()->validate([
                'email' => 'email'
            ]);

            $participant = Participant::firstOrCreate($form);
        }

        return $participant;
    }

    /**
     * Related research
     * 
     * @return 
     */
    public function research()
    {
        return $this->belongsTo(Research::class);
    }

    public function participantPoll()
    {
        return $this->hasMany(ParticipantPoll::class);
    }

    /**
     * Check if user already participated
     * 
     * @param  int    $participantId participant id
     * @return bool                [description]
     */
    public function isParticipated(int $participantId)
    {
        return (
            $this->participantPoll()
                ->where("participant_id","=",$participantId)
                ->get()
                ->count() == 1
            );
    }

    /**
     * Record user participation
     * 
     * @param  int    $participantId participant id
     * @return [type]                [description]
     */
    public function recordParticipation(int $participantId)
    {
        return ParticipantPoll::create([
            'poll_id' => $this->id,
            'participant_id' => $participantId,
            'completed' => 0
        ]);
    }

    /**
     * Create a poll and link it using parent_poll_id
     * 
     * @return [type] [description]
     */
    public function createChild()
    {
        return self::create([
            'research_id' => $this->research_id,
            'token' => self::generateToken(),
            'is_anonymus' => $this->is_anonymus,
            'allow_sharing' => $this->allow_sharing,
            'parent_poll_id' => $this->id
        ]);
    }
}
