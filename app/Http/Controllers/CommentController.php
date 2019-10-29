<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


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
            'file'  => 'nullable|file|mimes:jpeg,png,gif,jpg|max:2048',
        ]);

        // Store the file
        $filePath = '';
        if($request->file){
            $filePath = $request->file->store('public/files');
            // Remove the public path
            $filePath = explode('/',$filePath);
            $filePath = array_slice($filePath, 1);
            $filePath = implode('/', $filePath);
        }



        // Create new comment
        $comment = new Comment();

        $comment->name      = $request->name ? $request->name : 'Anonymous';
        $comment->content   = $request->content;
        $comment->thread_id = $request->thread;
        $comment->password  = Hash::make($request->password);
        $comment->file  = $filePath;
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
    public function destroy(Request $request)
    {
        // validate
        $request->validate([
            'comment'    => 'required|numeric',
            'password'  => 'required|min:10|max:20'
        ]);

        try {

            $comment = Comment::findOrFail($request->comment);

            // Check the password
            if (Hash::check($request->password, $comment->password)) {
                // Get the file path
                $filePath = $comment->file;

                // Delete the hash
                $comment->delete();

                // Delete the file
                Storage::delete('public/' . $filePath);


                // Flush
                Session::flash('success', 'Comment has been deleted');
                return redirect()->route('boards');
            } else {
                // Flush
                Session::flash('fail', 'Password is wrong');
                return back();
            }
        } catch (ModelNotFoundException $e) {
            return abort(400);
        }
    }
}
