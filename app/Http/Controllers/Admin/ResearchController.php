<?php

namespace App\Http\Controllers\Admin;

use App\Research;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResearchController extends Controller
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
        $researches = (new Research())->all();

        return view('admin.research.index', compact('researches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.research.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $form = request()->validate([
            'title' => ['required', 'min:10', 'max:255']
        ]);

        try {
            $poll = Research::create($form);
        } catch (\Illuminate\Database\QueryException $exception) {
            return view('admin.poll.error', ['content' => $exception->getMessage()]);
        }

        return redirect('/admin/research/' . $poll->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function show(Research $research)
    {
        return view('admin.research.show', compact('research'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function edit(Research $research)
    {
        return view('admin.research.edit', compact('research'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function update(Research $research)
    {
        $research->update(request('title'));

        return redirect('/admin/research/' . $research->id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function destroy(Research $research)
    {
        //@todo delete from multiple tables
    }
}
