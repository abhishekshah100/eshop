<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    public function store(Request $request){
    	$request->validate([
            'contact_name' => 'required|string|max:100',
            'contact_email' => 'required|string|email|max:100',
            'contact_no' => 'required|numeric|regex:/[7-9]{1}[0-9]{9}/|digits:10',
            'contact_message' => 'required|string|min:10',
        ]);
        Contact::create($request->all());
        return redirect()->route('contact')
                        ->with('success','Thank You for sharing the details. We will get back to you soon');
    }

    public function showadmin(){
        return view('admin.pages.contact')->with('contact', Contact::all());
    }

    public function destroy(Contact $contact){
        Contact::destroy($contact->id);
        return redirect()->back()->with('success','Contact has been deleted');
    }
}
