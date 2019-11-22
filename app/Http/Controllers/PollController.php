<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use App\Poll;
use App\Screen;
use App\Research;
use App\ResearchScreen;
use App\Question;
use App\Answer;
use App\Participant;
use App\ParticipantPoll;
use App\Mail\PollShare;

/**
 * enter -> user -> startPoll -> start -> screen -> ... -> screen ->end -> share
 */
class PollController extends Controller
{
    /**
     * User wants to enter the poll. Check details and show poll
     * 
     * @param string $token poll token
     * 
     * @return \Illuminate\Http\Response
     */
    public function enter(string $token)
    {
        \Session::flush();
        
        $polls = new Poll();

        $poll = $polls->where('token', $token)->get()->first();

        if ($poll === null) {
            return redirect('/poll/error/')->withCookie(cookie('token', ''));
        }

        \Session::put('poll_id', $poll->id);
        
        return redirect('/poll/user/')->withCookie(cookie('token', $token));
    }
    
    public function storeUser(Request $request)
    {
        $pollId = \Session::get('poll_id');
        $poll = Poll::find($pollId);
        
        $participant = $poll->setUpParticipant($request);

        if ($participant === null) {
            return redirect('/poll/error');
        }

        return $this->startPoll($poll, $participant);
    }

    public function user(Request $request)
    {
        $pollId = \Session::get('poll_id');

        $poll = Poll::find($pollId);

        try {
            $participant = $poll->setUpParticipant($request);
        } catch(\Exception $e) {
            return redirect('/poll/error');
        }

        if ($participant === null) {
            return view('poll.user');
        }

        return $this->startPoll($poll, $participant);
    }
    
    /**
     * Check, prepare and start poll
     * 
     * @param  Poll        $poll        [description]
     * @param  Participant $participant [description]
     * @return [type]                   [description]
     */
    private function startPoll(Poll $poll, Participant $participant)
    {
        $participated = $poll->isParticipated($participant->id);
        
        if ($participated) {
            return view('poll.error', ['content' => __('poll.error.participated')]);
        }

        try {
            $participantPoll = $poll->recordParticipation($participant->id);
        } catch(QueryException $qe) {
            return redirect('/poll/error/')->withCookie(cookie('token', ''));
        }
        
        \Session::put('participant_poll_id', $participantPoll->id);
        
        return redirect('/poll/start/');
    }
    
    /**
     * Check any poll start up settings
     * 
     * @return \Illuminate\Http\Response
     */
    public function start()
    {
        $token = \Cookie::get('token');
        
        if (!$token) {
            return view('poll.error', ['content' => __('poll.error.token-not-found')]);
        }
        
        $poll = Poll::where('token', $token)->get()->first();

        if ($poll === null) {
            return view('poll.error', ['content' => __('poll.error.wrong-token')]);
        }

        $researchScreens = ResearchScreen::where('research_id', $poll->research_id)
                ->orderBy('screen_order_number', 'asc')
                ->get()->map->screen_id;

        if ($researchScreens->count() < 1) {
            return view('poll.error', ['content' => __('poll.error.no-screens')]);
        }
        
        \Session::put('poll_screens', json_encode($researchScreens->all()));
        
        return redirect('/poll/screen/');
    }
    
    /**
     * Generic error
     *
     * @return [type] [description]
     */
    public function error()
    {
        return view('poll.error');
    }
    
    /**
     * Show poll screen with questions
     * 
     * @return [type] [description]
     */
    public function screen()
    {
        $poolScreens = json_decode(\Session::get('poll_screens'));
        
        if (!is_array($poolScreens) || count($poolScreens) < 1) {
            return view('poll.error', ['content' => __('poll.error.generic')]);
        }
        
        $currentScreenId = array_shift($poolScreens);
        
        \Session::put('poll_screens', json_encode($poolScreens));
        
        $screen = Screen::find($currentScreenId);

        $questions = (new Question())->getForScreen($currentScreenId);

        $questionAnswers = [];
        foreach ($questions as $question) {
            $className = "\\App\\Research\\Poll\\Question\\" . ucfirst($question->question_type);
            $questionAnswers[$question->id] = new $className($question->id);
        }

        return view('poll.screen', compact('questions', 'screen', 'questionAnswers', 'currentScreenId'));
    }
    
    /**
     * Answer submission
     * 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        $participantPollId = \Session::get('participant_poll_id');
        
        $questions = (new Question())->getForScreen($request->post('screen_id'));
        
        foreach($questions as $question) {
            $answerData = $request->post('question_' . $question->id);

            Answer::create([
                'participant_poll_id' => $participantPollId,
                'question_id' => $question->id,
                'answer' => $answerData
            ]);
        }
        
        ParticipantPoll::where('id', $participantPollId)
          ->update(['completed' => 1]);
        
        $poolScreens = json_decode(\Session::get('poll_screens'));
        
        if (is_array($poolScreens) && count($poolScreens) > 0) {
            return redirect('/poll/screen/');
        }
        
        return redirect('/poll/end/');
    }
    
    /**
     * Show results or end of poll message
     */
    public function end()
    {
        $participantPollId = \Session::get('participant_poll_id');

        $participantPoll = ParticipantPoll::find($participantPollId);

        $poll = Poll::find($participantPoll->poll_id);
        
        return view('poll.end', ['allow_sharing' => $poll->allow_sharing]);
    }
    
    /**
     * Share poll with others
     * 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function share(Request $request)
    {
        $emails = explode(PHP_EOL, $request->post('emails'));
        
        $participantPollId = \Session::get('participant_poll_id');

        try{
            $participantPoll = ParticipantPoll::findOrFail($participantPollId);

            $currentPoll = Poll::findOrFail($participantPoll->poll_id);
        } catch (ModelNotFoundException $e) {
            return view('poll.error', ['content' => __('poll.error.notfound')]);
        }
        
        try{
            $newPoll = $currentPoll->createChild();
        } catch(QueryException $qe) {
            return view('poll.error', ['content' => __('poll.error.create')]);
        }

        foreach ($emails as $email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                /**
                 * todo 
                 * 1) add to the Queue
                 */
               
               \Mail::to($email)->send(
                    new PollShare($newPoll)
               );
            }
        }
        
        return view('poll.share');
    }
}
