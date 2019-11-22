<?php

namespace App\Http\Controllers\Admin;

use App\Poll;
use App\Research;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PollController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $researches = (new Research())->all()->keyBy('id');
        $polls = (new Poll())->orderBy('created_at', 'desc')->get();
                
        
        return view('admin.poll.index', compact('researches', 'polls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $research = new Research();
        
        $researches = $research->all()->pluck('title', 'id');
        
        return view('admin.poll.create', compact('researches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        try {
            $poll = Poll::create([
                'research_id' => request('research_id'),
                'token' => Poll::generateToken(),
                'is_anonymus' => (int)request('is_anonymus'),
                'allow_sharing' => (int)request('allow_sharing'),
                'parent_poll_id' => null
            ]);
        } catch (\Illuminate\Database\QueryException $exception) {
            return view('admin.poll.error', ['content' => $exception->getMessage()]);
        }

        return redirect('/admin/poll/' . $poll->id);

/*
        $poll = new Poll();
        $poll->research_id = $request->post('research');
        $poll->token = $poll->generateToken();
        $poll->is_anonymus = (int)$request->post('is_anonymus');
        $poll->allow_sharing = (int)$request->post('allow_sharing');
        $poll->parent_poll_id = null;
        $res = $poll->save();
*/
        if ($res === true) {
            //return redirect()->action(
            //    'ResearchController@show', ['id' => $poll->id]
            //);
            //return redirect()->route('admin.research.show', ['id' => $poll->id]);
            return redirect('/admin/poll/'.$poll->id);
        } else {
            die('asdasdas');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function show(Poll  $poll)
    {
        return view('admin.poll.show', compact('poll'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function edit(Poll $poll)
    {
        $researches = Research::all()->pluck('title', 'id');

        return view('admin.poll.edit', compact('poll', 'researches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function update(Poll $poll)
    {
        $poll->token = request('token');
        $poll->research_id = request('research_id');
        $poll->is_anonymus = request('is_anonymus') == "1" ? 1 : 0;
        $poll->allow_sharing = request('allow_sharing') == "1" ? 1 : 0;

        $poll->save();

        return redirect('/admin/poll/' . $id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll)
    {
        // @todo do this later...

        return response()->json([
            'result' => 'OK'
        ]);
    }
    
    /**
     * Share poll with selected people
     */
    public function share()
    {
        
    }

    public function error()
    {
        return view('admin.poll.error');
    }
}
