<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use Image;

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
            'file'  => 'nullable|file|mimes:jpeg,png,gif,jpg|max:2048',
        ]);

        // Store the file
        $filePath1 = '';
        $filePath2 = '';
        if ($request->file) {
            $filePath1 = $request->file->store('public/files');
            // Remove the public path
            // File 1
            $filePath1 = explode('/', $filePath1);
            $filePath1 = array_slice($filePath1, 1);
            $filePath1 = implode('/', $filePath1);
            // File 2
            $filePath2 = explode('/', $filePath2);
            $filePath2 = array_slice($filePath2, 1);
            $filePath2 = implode('/', $filePath2);
            try {

                // Reize the second image
                $img = Image::make($request->file->getRealPath())->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                // Save the resized iamge
                $filePath2 = explode('.', $filePath1);
                $filePath2 = $filePath2[0] . '-small' . '.' . $filePath2[1];
                $img->save('../storage/app/public/' . $filePath2);
            } catch (Exception $e) {
                die("File uploading error");
            }
        }

        // Create new thread
        $thread = new Thread();

        $thread->board_id = $request->board;
        $thread->title = $request->title;
        $thread->name = $request->name ? $request->name : 'Anonymous';
        $thread->password = Hash::make($request->password);
        $thread->content = $request->content;
        $thread->last_action = date('Y-m-d H:i:s');
        $thread->file1 = $filePath1;
        $thread->file2 = $filePath2;
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
        try {
            $thread = Thread::with('comments')->findOrFail($id);
            $board = Board::findOrFail($thread->board_id);

            return view('boards.thread', compact('board', 'thread'));
        } catch (ModelNotFoundException $e) {
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
    public function destroy(Request $request)
    {
        // validate
        $request->validate([
            'thread'    => 'required|numeric',
            'password'  => 'required|min:10|max:20'
        ]);

        try {

            $thread = Thread::findOrFail($request->thread);

            // Check the password
            if (Hash::check($request->password, $thread->password)) {
                // Get the file path
                $filePath1 = $thread->file1;
                $filePath2 = $thread->file2;

                // Delete the hash
                $thread->delete();

                // Delete the file
                Storage::delete('public/' . $filePath1);
                Storage::delete('public/' . $filePath2);


                // Flush
                Session::flash('success', 'Thread has been deleted');
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

// V3rYsTr0nGP@ss#0rd
