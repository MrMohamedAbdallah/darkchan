<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
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
        $request->validate([
            'thread'    => 'required|exists:threads,id',
            'name'  => 'nullable',
            'content'   => 'required',
            'password'   => 'required|min:3|max:20',
        ]);

        // Create new comment
        $comment = new Comment();

        $comment->name      = $request->name ? $request->name : 'Anonymous';
        $comment->content   = $request->content;
        $comment->thread_id = $request->thread;
        $comment->password  = $request->password;
        $comment->file  = '';
        $comment->spoiler = $request->spoiler ? 1 : 0;

        // Save the comment
        $comment->save();

        // Changing the thread last_action value
        DB::table('threads')->where('id', '=', $comment->thread_id)->update([
            'last_action'   => date('Y-m-d H:i:s')
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
