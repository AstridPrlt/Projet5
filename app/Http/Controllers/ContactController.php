<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\ContactUsersMail;

class ContactController extends Controller
{
    //contact form to contact the Cowee admin
    public function showContactForm() {
        return view('contact/contact');
    }

    public function sendContactForm() {
        $contactData = request()->validate([
            'prenom' => 'required',
            'nom' => 'required',
            'email' => 'required|email',
            'message' => 'required|min:10|max:500'
        ]);

        Mail::to('webcreation@astrid-perillat.com')->send(new ContactMail($contactData));

        return redirect('contact')->with('message', 'Votre message a été envoyé');

    }


    //contact form for users to contact eachothers
    public function showUsersContact($userId)
    {
        $userToContact = User::find($userId);
        $authUser = Auth::user();

        return view('contact/contactUsers', ['userToContact' => $userToContact, 'authUser' => $authUser]);
    }

    public function sendUsersContact($userId) {

        $userToContact = User::find($userId);

        $contactData = request()->validate([
            'message' => 'required|min:5|max:800',
            'senderName' => 'required',
            'senderJob' => 'required',
            'senderDescription' => 'required',
            'contactName' => 'required'
        ]);

        Mail::to('webcreation@astrid-perillat.com')->send(new ContactUsersMail($contactData));

        return redirect('contactUsers/'.$userToContact->id)->with('message', 'Votre message a été envoyé');

    }
}
