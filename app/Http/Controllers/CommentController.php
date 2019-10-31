<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

// Reize the comment image
use Image;


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
        $filePath1 = '';
        $filePath2 = '';
        if($request->file){
            $filePath1 = $request->file->store('public/files');
            // Remove the public path
            // File 1
            $filePath1 = explode('/',$filePath1);
            $filePath1 = array_slice($filePath1, 1);
            $filePath1 = implode('/', $filePath1);
            // File 2
            $filePath2 = explode('/',$filePath2);
            $filePath2 = array_slice($filePath2, 1);
            $filePath2 = implode('/', $filePath2);
            try{

                // Reize the second image
                $img = Image::make($request->file->getRealPath())->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                // Save the resized iamge
                $filePath2 = explode('.', $filePath1);
                $filePath2 = $filePath2[0] . '-small' . '.' . $filePath2[1];
                $img->save('../storage/app/public/' . $filePath2);
            } catch(Exception $e){
                die("File uploading error");
            }
            
        }



        // Create new comment
        $comment = new Comment();

        $comment->name      = $request->name ? $request->name : 'Anonymous';
        $comment->content   = $request->content;
        $comment->thread_id = $request->thread;
        $comment->password  = Hash::make($request->password);
        $comment->file1  = $filePath1;
        $comment->file2  = $filePath2;
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
                $filePath1 = $comment->file1;
                $filePath2 = $comment->file2;

                // Delete the hash
                $comment->delete();

                // Delete the file
                Storage::delete('public/' . $filePath1);
                Storage::delete('public/' . $filePath2);


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
