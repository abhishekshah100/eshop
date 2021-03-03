<?php

namespace App\Http\Controllers;
use App\admin_credentials;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
    	$request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
       $verify = admin_credentials::where('email',$request->email)->where('account_verify_status','1')->first();
        if($verify)
        {
        		if(Hash::check($request->password, $verify->password))
        		{
                    if($verify->role=='1')
                    {
        			    $request->session()->put('admin_auth',$verify);
        			    return redirect()->route('dashboard')->with('success','Welcome Back.');
                    }
                    else
                    if($verify->role=='2')
                    {
                        $request->session()->put('vendor_auth', $verify);
                        return redirect()->route('vendor-request-product')->with('success','Welcome Back.');
                    }
        		}
        		else
        		{
        			return redirect()->back()
                        ->with('danger','Sorry, the password you entered does not match.');
        		}
        }
        else
        {
        	return back()
                        ->with('danger','Please enter a valid email address');	
        }
    }

    public function logout(){
        if(session()->has('admin_auth'))
        {
            session()->forget('admin_auth');
            return redirect()->route('admin-login')->with('success','You have been logged Out');
        }
        else
        if(session()->has('vendor_auth'))
        {
            session()->forget('vendor_auth');
            return redirect()->route('vendor-login')->with('success','You have been logged Out');
        }
    }
}
