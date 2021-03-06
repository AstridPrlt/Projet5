<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Support\Facades\DB;

class UserRepository {

    public function usersIndex()
    {
        $usersIndex = User::where([['id', '!=', auth()->id()],['admin', false],['invisible', 0]])->get();
        return $usersIndex;
    }

    public function usersIndexForAdmin() {
        $allUsersExceptAuth = User::where('id', '!=', auth()->id())->get();
        return $allUsersExceptAuth;
    }

    public function authContactsIds() {
        $authContacts = DB::table('contacts')->where('user_id', Auth::user()->id)->pluck('followed_user_id');
        return $authContacts;
    }

    public function addContactToAuth($contactId) {
        $user = Auth::user();
        $user->contacts()->attach($contactId);
        return "Contact ajouté";
    }

    public function removeContactToAuth($contactId) {
        $user = Auth::user();
        $user->contacts()->detach($contactId);
        return "Contact supprimé";
    }

    public function userContacts()
    {
        // $showMyContacts = Auth::user()->contacts->all();
        $visible = DB::table('users')->where('invisible', 0);
        $showMyContacts = DB::table('contacts')->where('user_id', Auth::user()->id)->joinSub($visible, 'visible', function ($join) {$join->on('contacts.followed_user_id', '=', 'visible.id');})->get();
        return $showMyContacts;
    }


    public function updateAvatar(Request $request)
    {
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

    public function updateUserProfile()
    {
        $authUser = User::find(Auth::user()->id);

        $authUser->name = request('name');
        $authUser->email = request('email');
        $authUser->job = request('job');
        $authUser->user_description = request('user_description');
        $authUser->save();

        return response()->json($authUser);
    }

    public function updateUserIds($authUser)
    {
        $authUser->email = request('email');
        $authUser->password = Hash::make(request('password'));
        $authUser->save();
        return response()->json($authUser);
    }

    public function makeUserInvisible()
    {
        $authUser = User::find(Auth::user()->id);
        $authUser->invisible = 1;
        $authUser->save();

        if($authUser->update(['invisible' => 1])) {
            return response()->json($authUser);
        } else {
            return response()->json(['error' => "La requête n'a pas fonctionné"]);
        }
    }

    public function makeUserVisible()
    {
        $authUser = User::find(Auth::user()->id);
        $authUser->invisible = 0;
        $authUser->save();

        if($authUser->update(['invisible' => 0])) {
            return response()->json($authUser);
        } else {
            return response()->json(['error' => "La requête n'a pas fonctionné"]);
        }
    }

    public function destroyUser($id)
    {
        $userToDelete = User::find($id);
        //delete the old picture if different than the default avatar picture
        if($userToDelete->avatar !== 'avatars/defaultAvatar.png') {
            Storage::disk('local')->delete('public/'.$userToDelete->avatar);
        };
        //delete booking in event_user table for the given event
        $userToDelete->events()->detach();
        //delete relationship with other users
        $userToDelete->contacts()->detach();
        $userIsFollowed = DB::table('contacts')->where('followed_user_id', $userToDelete->id)->delete();

        if(Auth::user()->admin == 0) { // if it's done by the user himself
            $userToDelete->delete();
            return ['redirect' => route('deleteUserConfirm')];
        } else { //if it's done by the admin
            $userToDelete->delete();
            return response()->json($id);
        }
    }
}
