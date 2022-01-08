<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'subject' => ['string', 'required'],
            'message' => ['string', 'required'],
            'name' => ['string', 'required'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);



        //create the database record for the contact us
       Contact::create([
            'subject' => $request->subject,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'comment_ip' => $request->ip()
        ]);

        return redirect('/#contact')->with('success','Message sent successfully');
        
    }
}
