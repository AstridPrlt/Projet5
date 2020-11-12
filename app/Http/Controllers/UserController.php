<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Image;

class UserController extends Controller
{
    /**
     * Display a listing of all coweerkers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listOfUsers = User::where([['id', '!=', auth()->id()],['admin', false],])->get();

        return view('coweerkers', ['listOfUsers' => $listOfUsers]);
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

        if($authUser->avatar !== 'avatars/defaultAvatar.png') {
        Storage::disk('local')->delete('public/'.$authUser->avatar); //delete the old picture if different than the default avatar picture
        };

        $avatar = $request->file('avatar')->store('avatars', 'public'); //store the new picture
        $image = Image::make(Storage::get('public/'.$avatar))->fit(300)->encode(); //resize the new picture
        Storage::put('public/'.$avatar, $image); //then save it

        $authUser->update(['avatar' => $avatar]); //update the db

        if($authUser->update(['avatar' => $avatar])) {
            return response()->json($authUser->avatar);
        } else {
            return response()->json(['error' => "La photo n'a pas pu être modifiée"]);
        }
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
     * Update the user profile : name, job and description.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:30',
            'job' => 'min:2|max:50',
            'user_description' => 'min:2|max:200'
        ]);

        $authUser = User::find(Auth::user()->id);

        $authUser->name = request('name');
        $authUser->email = request('email');
        $authUser->job = request('job');
        $authUser->user_description = request('user_description');
        $authUser->save();
    }

    /**
     * Update the user ids : email and password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateIds(Request $request, $id)
    {
        $authUser = User::find(Auth::user()->id);

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:60', Rule::unique('users')->ignore($authUser)],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        };

        $authUser->email = request('email');
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
