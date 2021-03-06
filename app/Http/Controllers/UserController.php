<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Support\Facades\DB;

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
        $coweerkers = $this->userRequest->usersIndex();

        if (Auth::user()) { //if the user is authentified, check if he already has favorite contacts -> return an array of these users id
            $authContacts = $this->userRequest->authContactsIds();
            if(empty($authContacts)) { //if user has no favorites contacts
                $authContacts = json_encode("Pas de contacts favoris");
            }
            return view('coweerkers', ['coweerkers' => $coweerkers, 'authContacts' => $authContacts]);
        } else {
            $authContacts = json_encode("Pas de contacts favoris");
            return view('coweerkers', ['coweerkers' => $coweerkers, 'authContacts' => $authContacts]);
        }
    }

    /**
     * Add a favorite contact to auth user list.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeContact(Request $request) {

        $contactId = $request->userId;

        $addContact = $this->userRequest->addContactToAuth($contactId);

        return response()->json($contactId);
    }

    /**
     * Remove a favorite contact to auth user list.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeContact($userId) {

        $removeContact = $this->userRequest->removeContactToAuth($userId);

        return response()->json($userId);
    }

    /**
     * Show the user all its favorite contacts, in his profile page.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function showMyContacts()
    {
        $myContacts = $this->userRequest->userContacts();
        return response()->json($myContacts);
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
            'job' => 'min:2|max:50|nullable',
            'user_description' => 'min:2|max:200|nullable'
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
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($authUser)],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        } else {
            $updateUserIds = $this->userRequest->updateUserIds($authUser);
            return $updateUserIds;
        }
    }


    /**
     * Permit the user to be invisible from other users.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function makeInvisible(Request $request)
        {
            $userInvisible = $this->userRequest->makeUserInvisible();
            return $userInvisible;
        }

    /**
     * Permit the user to return to be visible from other users.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function makeVisible(Request $request)
    {
        $userVisible = $this->userRequest->makeUserVisible();
        return $userVisible;
    }


    /**
     * Destroy the user (made by user).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroyUser = $this->userRequest->destroyUser($id);
        return $destroyUser;
    }


    //******ADMIN*********

    /**
     * Retrieve the list of all users to admin
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin ()
    {
        $listOfUsers =  $this->userRequest->usersIndexForAdmin();
        return $listOfUsers;
    }

}
