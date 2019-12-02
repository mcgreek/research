<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Participant;

class ParticipantController extends BasicController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $participants = (new Participant())->all()->keyBy('id');
                
        
        return view('admin.participant.index', compact('participants'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Participant  $participant)
    {
    	$participantPolls = $participant->polls;

        return view('admin.participant.show', compact('participantPolls', 'participant'));
    }
}
