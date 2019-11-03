<?php

namespace App\Http\Controllers;

use App\Board;
use App\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class BoardController extends Controller
{
    /**
     * Home page
     */
    public function home()
    {
        // Get all boards
        $boards = Board::all();

        return view('home')->with('boards', $boards);
    }


    /**
     * Show all boards
     */
    public function index()
    {
        // Get all boards
        $boards = Board::all();
        $title = 'Boards';

        return view('boards.boards', compact("boards", "title"));
    }
    
    
    /**
     * Show all SFW only
     */
    public function sfw()
    {
        // Get all boards
        $boards = Board::where('nsfw', '=', 0)->get();
        $title = 'SFW Boards';

        return view('boards.boards', compact("boards", "title"));
    }
    /**
     * Show all NSFW only
     */
    public function nsfw()
    {
        // Get all boards
        $boards = Board::where('nsfw', '=', 1)->get();
        $title = 'NSFW Boards';

        return view('boards.boards', compact("boards", "title"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.create-boards');
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
            'name' => 'required|min:3|max:15|unique:boards,name',
            'link' => 'required|min:1|max:2|unique:boards,link',
            'cover' =>  'nullable|file|mimes:jpeg,png,gif,jpg|max:2048',
            'msg' => 'nullable|min:5',
        ]);

        // Store the file
        $filePath = '';
        if($request->cover){
            $filePath = $request->cover->store('public/files');
            // Remove the public path
            $filePath = explode('/',$filePath);
            $filePath = array_slice($filePath, 1);
            $filePath = implode('/', $filePath);
        }

        // Create new board
        $board = new Board();
        
        $board->name = $request->name;
        $board->link = $request->link;
        $board->msg = $request->msg ? $request->msg : '' ;
        $board->nsfw = $request->nsfw ? 1 : 0;
        $board->cover = $filePath;


        $board->save();
        

        // Flush messages
        Session::flush("success", "Board created successfully");

        return view('admins.create-boards');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Board  $link
     * @return \Illuminate\Http\Response
     */
    public function show($link)
    {
        try{
            // Get the board
            $board = Board::where("link", "=", $link)->firstOrFail();

            // Get the threads
            $threads = Thread::where('board_id', '=', $board->id)
                                ->orderBy('last_action', 'DESC')
                                ->with(['comments' => function($query){
                                    return $query->orderBy('created_at', 'DESC');
                                }])
                                ->paginate(10);
           

            return view("boards.board", compact("board", "threads"));
        } catch(ModelNotFoundException $e){
            return abort(404);
        }
    }

    /**
     * Show thread catalog
     *
     * @param  \App\Board  $link
     * @return \Illuminate\Http\Response
     */
    public function catalog($link)
    {
        try{
            // Get the board
            $board = Board::where("link", "=", $link)->firstOrFail();

            // Get the threads
            $threads = Thread::where('board_id', '=', $board->id)
                                ->orderBy('last_action', 'DESC')
                                ->paginate(10);

            return view("boards.catalog", compact("board", "threads"));
        } catch(ModelNotFoundException $e){
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function edit(Board $board)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Board $board)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board)
    {
        //
    }
}
