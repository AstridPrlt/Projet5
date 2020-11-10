<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show() {
        return view('contact/contact');
    }

    public function store() {
        $contactData = request()->validate([
            'prenom' => 'required',
            'nom' => 'required',
            'email' => 'required|email',
            'message' => 'required|min:10|max:500'
        ]);

        Mail::to('webcreation@astrid-perillat.com')->send(new ContactMail($contactData));

        return redirect('contact')->with('message', 'Votre message a été envoyé');

    }
}
