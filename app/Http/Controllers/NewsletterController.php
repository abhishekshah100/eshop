<?php

namespace App\Http\Controllers;

use App\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function adminindex(){
    	$all_newsletter=Newsletter::latest()->get();

    	return view('admin.pages.newsletter',compact('all_newsletter'));
    }

    public function destroy(Newsletter $newsletter){
        Newsletter::destroy($newsletter->id);
        return redirect()->back()->with('success','Newsletter has been deleted');
    }
}
