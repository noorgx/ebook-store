<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'telephone' => 'nullable|string',
        'subject' => 'required|string',
        'message' => 'required|string',
    ]);

    $contact = new Contact();
    $contact->name = $request->input('name');
    $contact->email = $request->input('email');
    $contact->telephone = $request->input('telephone');
    $contact->subject = $request->input('subject');
    $contact->message = $request->input('message');
    $contact->save();

    // Redirect the user back to the contact form with a success message
    session()->flash('success_message', 'Thank you for contacting us!');
    return redirect()->route('contact')->with('success', 'Thank you for contacting us!');
}
}
