<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;

class UserController extends Controller
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
        //
    }

    /**
     * Store the user avatar in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAvatar(Request $request, $id)
    {
        $this->validate($request, [
            'avatar' => 'required|image|mimes:png,jpg,jpeg,gif,svg',
        ]);

        $authUser = User::find(Auth::user()->id);

        Storage::disk('local')->delete('public/'.$authUser->avatar); //delete the old picture
        $avatar = $request->file('avatar')->store('avatars', 'public');//store the new picture

        $authUser->update(['avatar' => $avatar]); //update the db

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the Auth user details
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAuth()
    {
        $authUser = Auth::user();
        return response()->json($authUser);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $authUser = User::find(Auth::user()->id);

        $authUser->name = request('name');
        $authUser->email = request('email');
        $authUser->job = request('job');
        $authUser->user_description = request('user_description');
        $authUser->save();
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
