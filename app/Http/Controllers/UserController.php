<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Image;

use App\Repositories\UserRepository;

class UserController extends Controller
{
    public function __construct()
    {
        $this->userRequest = new UserRepository();
    }
    /**
     * Display a listing of all coweerkers on coweerkers page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listOfUsers = $this->userRequest->usersIndex();
        return view('coweerkers', ['listOfUsers' => $listOfUsers]);
    }

    /**
     * Store the user avatar in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAvatar(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|image|mimes:png,jpg,jpeg,gif,svg',
        ]);

        $updateAvatar = $this->userRequest->updateAvatar($request);
        return $updateAvatar;
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
     * Update the user profile : name, job and description.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:30',
            'job' => 'min:2|max:50',
            'user_description' => 'min:2|max:200'
        ]);

        $updateUserProfile = $this->userRequest->updateUserProfile();
        return $updateUserProfile;
    }

    /**
     * Update the user ids : email and password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateIds(Request $request)
    {
        $authUser = User::find(Auth::user()->id);

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:60', Rule::unique('users')->ignore($authUser)],
        ]);

        $updateUserIds = $this->userRequest->updateUserIds($validator, $authUser);
        return $updateUserIds;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userToDelete = User::find($id);
        //delete the old picture if different than the default avatar picture
        if($userToDelete->avatar !== 'avatars/defaultAvatar.png') {
            Storage::disk('local')->delete('public/'.$userToDelete->avatar);
        };
        //delete booking in event_user table for the given event
        $userToDelete->events()->detach();

        $userToDelete->delete();
        return ['redirect' => route('deleteUserConfirm')];
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
