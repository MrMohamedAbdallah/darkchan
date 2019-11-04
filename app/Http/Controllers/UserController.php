<?php

namespace App\Http\Controllers;

use App\Board;
use App\User;
use Exception;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all users except the current
        $users = User::where('id', '!=', auth()->user()->id)->paginate(10);

        return view('admins.users', compact('users'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            // Get the user with the boards
            $user = User::where('id', $id)->with('boards')->firstOrFail();
            // Get all boards
            $boards = Board::all();
            $user_boards = array_map(function ($obj) {
                return $obj['pivot']['board_id'];
            }, $user->boards->toArray());

            return view('admins.edit-user', compact('user', 'boards', 'user_boards'));
        } catch (Exception $e) {
            // dd($e);
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{

            $request->validate([
                'boards' => 'array|nullable|exists:boards,id'
            ]);
            
            // Get the user with the boards
            $user = User::findOrFail($id);
            $user->boards()->sync($request->boards);


            return redirect()->back();
        } catch (Exception $e) {
            dd($e);
            return abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
