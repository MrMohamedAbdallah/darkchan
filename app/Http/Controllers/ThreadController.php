<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Board;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the "create thread" request
        $request->validate([
            'board'  => 'required|exists:boards,id',
            'title' => 'required|max:64',
            'name'  => 'nullable|min:3',
            'password'  => 'required|min:10|max:20',
            'content'  => 'required|min:10',
        ]);

        // Create new thread
        $thread = new Thread();

        $thread->board_id = $request->board;
        $thread->title = $request->title;
        $thread->name = $request->name ? $request->name : 'Anonymous';
        $thread->password = $request->password;
        $thread->content = $request->content;
        $thread->last_action = date('Y-m-d H:i:s');
        $thread->file = '';
        $thread->spoiler = $request->spoiler ? 1 : 0;

        // Save
        $thread->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $thread = Thread::with('comments')->findOrFail($id);
            $board = Board::findOrFail($thread->board_id);

            return view('boards.thread', compact('board', 'thread'));
        } catch (ModelNotFoundException $e){
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        //
    }
}
